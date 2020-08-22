<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Member;
use App\Fellowship;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CellController extends Controller
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
        $cells = Cell::with('fellowship')->get();

        return view('pages.cells.index', compact('cells'));
    }

    /**
     * Show the form for creating a new Cell.
     *
     * Get all fellowships form the database and pass to the view
     * to allow user to attach a cell to a fellowship
     *
     * @return Response
     */
    public function create()
    {
        $fellowships = Fellowship::all();

        $members = Member::with('fellowship')->get();

        return view('pages.cells.create', compact('fellowships', 'members'));
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
        $validateAttributes = $this->validate($request, [
            'fellowship_id' =>  'required',
            'name'          =>  'required',
            'leader'        =>  'required',
        ]);

        $cell = Cel +l::create($validateAttributes);

        if ($cell->save()) {

            $request->session()->flash('success', ' ' .$cell->name.' Cell Successfully Added To Portal.');

            return redirect()->route('cells.index');

        } else {

            return redirect()->back()->wthError()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Cell $cell
     * @return void
     */
    public function show(Cell $cell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cell $cell
     * @return Response
     */
    public function edit(Cell $cell)
    {
        $fellowships = Fellowship::all();

        $members = Member::with('fellowship')->get();

        return view('pages.cells.edit', compact('fellowships', 'members', 'cell'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Cell $cell
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Cell $cell)
    {
        $validateAttributes = $this->validate($request, [
            'fellowship_id' =>  'required',
            'name'          =>  'required',
            'leader'        =>  'required',
        ]);

        if ($cell->update($validateAttributes)) {

            $request->session()->flash('success', ' ' .$cell->name.' Cell Successfully Updated.');

            return redirect()->route('cells.index');

        } else {

            return redirect()->back()->wthError()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cell $cell
     * @return Response
     */
    public function destroy(Cell $cell)
    {
        //
    }
}
