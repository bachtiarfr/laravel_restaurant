<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrders extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
