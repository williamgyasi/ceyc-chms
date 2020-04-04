<?php

namespace App\Http\Controllers\Leaders\Fellowships;

use App\Cell;
use App\Fellowship;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FellowshipController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'fellowship-leader']);
    }

    public function getFellowshipName($fellowship)
    {
        $fellowship = Fellowship::whereName(
            Auth::user()->fellowship->name
        )->first();

        return $fellowship;
    }

    /**
     * Get's a list of all Members belong to the particular fellowship
     * @param $fellowship
     */
    public function members($fellowship)
    {
        $fellowship = $this->getFellowshipName($fellowship);

        $members = User::whereFellowshipId($fellowship->id)->get();

        return view('pages.leaders.fellowships.members',
            compact('members'));
    }

    /**
     * Displays a list of all the cells that belong to the particular fellowship
     * @param $fellowship
     */
    public function cells($fellowship)
    {
        $fellowship = $this->getFellowshipName($fellowship);

        $cells = Cell::whereFellowshipId($fellowship->id)->get();

        $members = User::whereFellowshipId($fellowship->id)->get();

        return view('pages.leaders.cells.cells',
            compact('cells', 'members'));
    }

    /**
     * Creates a new cell under the particular fellowship
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function cell(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required',
            'leader' => 'required'
        ]);

        $cell = Cell::create($attributes + [
                'fellowship_id' => Auth::user()->fellowship->id
            ]);

        if ($cell->save()) {

            $request->session()->flash('success', ' ' .$cell->name.' Cell Successfully Added To Portal.');

            return redirect()->back();
        } else {

            return redirect()->back();
        }

    }
}
