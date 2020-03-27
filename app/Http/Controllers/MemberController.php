<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Member;
use App\Department;
use App\Fellowship;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $members = Member::with('fellowship', 'department')->get();

        return view('pages.members.index', compact('members'));
    }

    /**
     *
     * Show the form for creating a new resource.
     * Get all Fellowships and departments and pass
     *  them to the view
     *
     * @return Response
     */
    public function create()
    {
        $fellowships = Fellowship::all();

        $departments = Department::all();

        $cells = Cell::all();

        return view('pages.members.create',
            compact('fellowships', 'departments', 'cells'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validate($request , [
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

        $member = Member::create($validatedAttributes);

        if ($member->save()) {

            $request->session()->flash('success', ' ' .$member->firstname.'  ' .$member->lastname . ' Details Successfully Added To Portal.');

            return redirect()->route('members.index');

        } else {

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Member $member
     * @return Response
     */
    public function show(Member $member)
    {
        return view('pages.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Member $member
     * @return Response
     */
    public function edit(Member $member)
    {
        $fellowships = Fellowship::all();

        $departments = Department::all();

        $cells = Cell::all();

        return view('pages.members.edit',
            compact('member', 'fellowships', 'departments', 'cells'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Member $member
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Member $member)
    {
        $validatedAttributes = $this->validate($request , [
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
        ]);

        if ($member->update($validatedAttributes)) {

            $request->session()->flash('success', ' ' .$member->firstname.'  ' .$member->lastname . ' Details Successfully Edited.');

            return redirect()->route('members.index');

        } else {

            return redirect()->back()->wthError()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Member $member
     * @return Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
