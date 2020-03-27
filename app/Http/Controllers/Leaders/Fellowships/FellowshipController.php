<?php

namespace App\Http\Controllers\Leaders\Fellowships;

use App\Fellowship;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FellowshipController extends Controller
{
    public function getFellowshipName($fellowship)
    {
        $fellowship = Fellowship::whereName(
            Auth::user()->fellowship->name
        )->first();

        return $fellowship;
    }

    /**
     * Get's a list of all Members belong to a particular fellowship
     * @param $fellowship
     * @return Factory|View
     */
    public function members($fellowship)
    {
        $fellowship = $this->getFellowshipName($fellowship);

        $members = User::whereFellowshipId($fellowship->id)->get();

        return view('pages.leaders.fellowships.members',
            compact('members'));
    }
}
