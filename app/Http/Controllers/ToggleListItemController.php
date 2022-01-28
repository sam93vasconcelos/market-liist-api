<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;

class ToggleListItemController extends Controller
{
    public function setAsDone(ListItem $listItem)
    {
        $listItem->load('market_list');

        $listItem['user_id'] = $listItem->market_list->user_id;

        $this->authorize('done', $listItem);

        unset($listItem->user_id);

        $listItem->done = true;
        $listItem->update();

        return response()->noContent();
    }

    public function setAsUndone(ListItem $listItem)
    {
        $listItem->load('market_list');

        $listItem['user_id'] = $listItem->market_list->user_id;

        $this->authorize('done', $listItem);

        unset($listItem->user_id);

        $listItem->done = false;
        $listItem->update();

        return response()->noContent();
    }
}
