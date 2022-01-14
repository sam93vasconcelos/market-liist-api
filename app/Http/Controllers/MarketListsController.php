<?php

namespace App\Http\Controllers;

use App\Models\MarketList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();

        $lists = MarketList::with('list_items')->where('user_id', $user)->get();
        return response()->json($lists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        MarketList::create($data);
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarketList  $marketList
     * @return \Illuminate\Http\Response
     */
    public function show(MarketList $marketList)
    {
        $marketList->load('list_items');
        return response()->json($marketList);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarketList  $marketList
     * @return \Illuminate\Http\Response
     */
    public function edit(MarketList $marketList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MarketList  $marketList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarketList $marketList)
    {
        $this->authorize('update', $marketList);

        $marketList->title = $request->title;
        $marketList->update();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarketList  $marketList
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarketList $marketList)
    {
        //return response()->json(Auth::id() === $marketList->user_id);
        $this->authorize('delete', $marketList);

        $marketList->delete();
        return response()->noContent();
    }
}
