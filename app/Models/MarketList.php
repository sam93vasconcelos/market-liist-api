<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function shares()
    {
        return $this->hasMany(Share::class);
    }

    public function list_items()
    {
        return $this->hasMany(ListItem::class)->orderBy('name');
    }
}
