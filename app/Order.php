<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\OrderCreated;

class Order extends Model
{
	protected static function boot(){

		parent::boot();

		static::created(function($order){
			// send email to scott
			$toEmail = Setting::where('key', 'Acacia Email')->first();
			\Mail::to($toEmail->value)->send(
				new OrderCreated($order->id, $toEmail)
			);
		});

	}

	public function choices(){
		return $this->hasMany(OrderChoice::class);
	}

    public function addChoice($choice){
    	// $this->choices()->create($choice);
    }
}
