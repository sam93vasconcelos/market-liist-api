<?php

namespace App\Http\Controllers;

use App\Models\MarketList;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();

        $shares = Share::where('user_id', $user)->get();
        return response()->json($shares);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required|exists:users,id',
                'market_list_id' => 'required|exists:market_lists,id'
            ]
        );

        $marketList = MarketList::find($request->market_list_id);

        if (Auth::id() !== $marketList->user_id) {
            return response()->json('', 403);
        }


        Share::create($request->all());
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function destroy(Share $share)
    {
        $share->delete();
        return response()->noContent();
    }
}
