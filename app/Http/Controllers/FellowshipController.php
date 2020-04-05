<?php

namespace App\Http\Controllers;

use App\Member;
use App\Fellowship;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class FellowshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fellowships = Fellowship::all();

        return view('pages.fellowships.index',
            compact('fellowships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $members = Member::all();

        return view('pages.fellowships.create',
            compact('members'));
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

        $fellowship = Fellowship::create($validatedAttributes);

        if ($fellowship->save()) {

            $request->session()->flash('success', ' ' .$fellowship->name.' Fellowship Successfully Added To Portal.');

            return redirect()->route('fellowships.index');

        } else {

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * Display a total of all meembers and all cells belonging
     * to the specific fellowships to be displayed
     *
     * @param Fellowship $fellowship
     * @return Response
     */
    public function show(Fellowship $fellowship)
    {
        return $fellowship;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Fellowship $fellowship
     * @return Response
     */
    public function edit(Fellowship $fellowship)
    {
        $members = Member::all();

        return view('pages.fellowships.edit',
            compact('fellowship', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Fellowship $fellowship
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Fellowship $fellowship)
    {
        $validatedAttributes = $this->validate($request, [
            'name'      =>  'required',
            'leader'    =>  'nullable'
        ]);

        if ($fellowship->update($validatedAttributes)) {

            $request->session()->flash('success', ' ' .$fellowship->name.' Fellowship Successfully Updated.');

            return redirect()->route('fellowships.index');

        } else {

            return redirect()->back()->wthError()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fellowship $fellowship
     * @return Response
     */
    public function destroy(Fellowship $fellowship)
    {
        //
    }
}
