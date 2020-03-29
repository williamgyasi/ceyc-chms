<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Department;
use App\Fellowship;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password'              => ['required', 'string', 'min:8'],
            'fellowship_id'         =>  'required',
            'department_id'         =>  'nullable',
            'lastname'              =>  'required',
            'firstname'             =>  'required',
            'othernames'            =>  'nullable',
            'phone'                 =>  'required',
            'alt_phone'             =>  'nullable',
            'email'                 =>  'required',
            'dob'                   =>  'required',
            'gender'                =>  'required',
            'residential_address'   =>  'required',
            'digital_address'       =>  'nullable',
            'fellowship_id'         =>  'required',
            'department_id'         =>  'nullable',
            'school'                =>  'nullable',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $role = Role::whereName('Member')->get();

//        $randomPassword = bin2hex(random_bytes(5));
        $randomPassword = 'ceycp@ssword1234';

        $user = User::create([
            // 'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($randomPassword),
            'fellowship_id'     => $data['fellowship_id'],
            'lastname'          => $data['lastname'],
            'firstname'         => $data['firstname'],
            'phone'             => $data['phone'],
            'alt_phone'         => $data['alt_phone'],
            'dob'               => $data['dob'],
            'residential_address' => $data['residential_address'],
            'digital_address'   =>  $data['digital_address'],
            'school'            => $data['school'],
            'work'              => $data['work'],
            'gender'            => $data['gender'],
        ]);

        $user->roles()->attach($role);

        return $user;
    }

    public function showRegistrationForm()
    {
        $fellowships = Fellowship::all();

        $departments = Department::all();

        return view('auth.register',
            compact('fellowships', 'departments'));
    }
}
