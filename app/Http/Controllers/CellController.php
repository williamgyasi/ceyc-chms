<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Member;
use App\Fellowship;
use Illuminate\Http\Request;

class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateAttributes = $this->validate($request, [
            'fellowship_id' =>  'required',
            'name'          =>  'required',
            'leader'        =>  'required',
        ]);

        $cell = Cell::create($validateAttributes);

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
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function show(Cell $cell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
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
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cell $cell)
    {
        //
    }
}
