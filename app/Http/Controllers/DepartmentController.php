<?php

namespace App\Http\Controllers;

use App\Member;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();

        return view('pages.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        
        return view('pages.departments.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validate($request, [
            'name'      =>  'required',
            'leader'    =>  'nullable'
        ]);

        $department = Department::create($validatedAttributes);

        if ($department->save()) {
            
            $request->session()->flash('success', ' ' .$department->name.' Department Successfully Added To Portal.');

            return redirect()->route('departments.index');

        } else {
            
            return redirect()->back()->wthError()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('pages.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $members = Member::all();

        return view('pages.departments.edit', compact('department', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validatedAttributes = $this->validate($request, [
            'name'      =>  'required',
            'leader'    =>  'nullable'
        ]);

        if ($department->update($validatedAttributes)) {
            
            $request->session()->flash('success', ' ' .$department->name.' Department Successfully Edited.');

            return redirect()->route('departments.index');

        } else {
            
            return redirect()->back()->wthError()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
