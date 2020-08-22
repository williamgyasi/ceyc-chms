<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class SetPasswordAfterRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showUpdatePasswordForm()
    {
        return view('auth.password-update');
    }


    public function updatePassword(Request $request)
    {
        $validatedPassword = request()->validate([
            'password' => ['required', 'string', 'min:10']
        ]);
        
        $user = User::whereId(auth()->user()->id)->first();
        $user->update([
            'password' => Hash::make($validatedPassword['password']),
            'default_password_reset_at' => Carbon::now()
        ]);
        
        return redirect()->route('home');
    }
}
