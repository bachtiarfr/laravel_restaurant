<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function detail()
    {
        return $this->hasMany('App\DetailOrders');
    }

    public function item()
    {
        return $this->hasMany('App\Item');
    }
}
