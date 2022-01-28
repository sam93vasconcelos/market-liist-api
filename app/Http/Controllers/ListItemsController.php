<?php

namespace App\Http\Controllers;

use App\Models\MarketList;
use App\Models\ListItem;
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
        $listItem = app(ListItem::class);

        $marketList = MarketList::find($request->market_list_id);

        $listItem['user_id'] = $marketList->user_id;

        $this->authorize('create', $listItem);

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
        $listItem->load('market_list');

        $listItem['user_id'] = $listItem->market_list->user_id;

        $this->authorize('create', $listItem);

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
        $listItem->load('market_list');

        $listItem['user_id'] = $listItem->market_list->user_id;

        $this->authorize('update', $listItem);

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
        $listItem->load('market_list');

        $listItem['user_id'] = $listItem->market_list->user_id;

        $this->authorize('delete', $listItem);

        $listItem->delete();
        return response()->noContent();
    }
}
