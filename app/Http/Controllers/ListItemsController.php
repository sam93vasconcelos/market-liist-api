<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use App\Models\MarketList;
use Illuminate\Http\Request;

class ListItemsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marketList = MarketList::findOrFail($request->market_list_id);

        $this->authorize('create', $marketList);

        $request->validate([
            'name' => 'required',
            'qty' => 'required|integer',
            'market_list_id' => 'required|exists:market_lists,id'
        ]);

        $list_item = ListItem::create($request->all());
        return response()->json($list_item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListItem  $listItem
     * @return \Illuminate\Http\Response
     */
    public function show(ListItem $listItem)
    {
        $marketList = MarketList::findOrFail($listItem->market_list_id);

        $this->authorize('view', $marketList);

        return response()->json($listItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListItem  $listItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListItem $listItem)
    {
        $marketList = MarketList::findOrFail($listItem->market_list_id);

        $this->authorize('update', $marketList);

        $listItem->update($request->all());
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListItem  $listItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListItem $listItem)
    {
        $marketList = MarketList::findOrFail($listItem->market_list_id);

        $this->authorize('delete', $marketList);
        
        $listItem->delete();
        return response()->noContent();
    }
}
