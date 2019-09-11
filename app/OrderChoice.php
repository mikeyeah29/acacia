<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderChoice extends Model
{
    protected $fillable = [
        'order_id', 'attribute', 'chosen_option', 'name', 'cost'
    ];
}
