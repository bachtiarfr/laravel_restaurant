<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function detail()
    {
        return $this->hasMany('App\DetailOrders');
    }

    // public function order()
    // {
    //     return $this->belongsTo('App\Order');
    // }
}
