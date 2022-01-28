<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'market_list_id'
    ];

    public function market_list()
    {
        return $this->belongsTo(MarketList::class);
    }
}
