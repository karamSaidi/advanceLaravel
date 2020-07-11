<?php

namespace App\Http\Controllers\Advance;

use App\User;
use App\Model\Offer;
use App\Model\Winner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\WinnerJob;

class WinnerController extends Controller
{

    public function getform()
    {
        $offers = Offer::select('id', 'title')->get();
        $users = User::select('id', 'name')->get();
        return view('winner.winner', compact('offers', 'users'));
    }


    public function saveWinner(Request $request)
    {

        return response()->json(['data' => $request->all()]);

        $this->validate($request, [
            'offer_id'       => 'required|numeric',
            'user_ids'      => 'required|array',
            'user_id.*'     => 'required|numeric'

        ]);

        dispatch(new WinnerJob($request->all()));

        return redirect()->route('winner-form')->with('success', 'Winner will added in background');

    }


}// end controller
