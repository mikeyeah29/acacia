<?php

namespace App\Http\Controllers;
use App\Attribute;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function orderform(){

    	$attributes = Attribute::all();

		return view('orderform', 
			[
				'page' => 'form',
				'attributes' => $attributes
			]
		);
    
    }
}
