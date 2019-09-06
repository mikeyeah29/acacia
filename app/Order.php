<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected static function boot(){

		parent::boot();

		static::created(function($order){
			// send email to scott
		});

	}

	public function choices(){
		$this->hasMany(OrderChoice::class);
	}

    public function addChoice($choice){
    	// $this->choices()->create($choice);
    }
}
