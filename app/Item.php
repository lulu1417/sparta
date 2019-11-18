<?php

namespace App;
use App\Record;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item', 'image'
    ];
    public function record()
    {
        return $this->hasMany('Record');
    }
}
