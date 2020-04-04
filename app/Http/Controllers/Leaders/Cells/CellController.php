<?php

namespace App\Http\Controllers\Leaders\Cells;

use App\Cell;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CellController extends Controller
{
    public function  __construct()
    {
        $this->middleware(['auth', 'cell-leader']);
    }

    public function  getCellName($cell)
    {
        $cell = Cell::wherename(
            Auth::user()->cell->name
        )->first();

        return $cell;
    }

    /**
     * Displays a list of all members of the specified cell
     * @param $cell
     *
     */
    public function members($cell)
    {
        $cell = $this->getCellName($cell);

        $members = User::whereCellId($cell->id)->get();

        return view('pages.leaders.cells.members',
            compact('members', 'cell'));
    }
}
