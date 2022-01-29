<?php

namespace App\Http\Controllers;

use App\Models\MarketList;
use App\Models\Share;
use App\Models\User;
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
        $user = User::where('email', $request->user_email)->first();

        if(!$user) {
            return response()->json([
                'msg' => 'user not found'
            ], 404);
        }

        $request->validate(
            [
                'market_list_id' => 'required|exists:market_lists,id'
            ]
        );

        $marketList = MarketList::find($request->market_list_id);

        if (Auth::user()->id !== $marketList->user_id) {
            return response()->json('', 403);
        }
        
        Share::create([
            'market_list_id' => $request->market_list_id,
            'user_id' => $user->id
        ]);

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
