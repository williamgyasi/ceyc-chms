<?php

namespace App\Http\Controllers;

use App\Member;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $departments = Department::all();

        return view('pages.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $members = Member::all();

        return view('pages.departments.create', compact('members'));
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
     * @param Department $department
     * @return Response
     */
    public function show(Department $department)
    {
        return view('pages.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Response
     */
    public function edit(Department $department)
    {
        $members = Member::all();

        return view('pages.departments.edit', compact('department', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return Response
     * @throws ValidationException
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
     * @param Department $department
     * @return Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
