<?php

namespace App;
use App\Item;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'name', 'item', 'god'
    ];
    function item(){
        return $this->belongsTo(Item::class)->select(array('item','image'));
    }
}
