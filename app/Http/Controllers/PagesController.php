<?php

namespace App\Http\Controllers;
use App\Attribute;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function orderform(){

    	$attributes = Attribute::orderBy('position', 'asc')->get();

		return view('orderform', 
			[
				'page' => 'form',
				'attributes' => $attributes
			]
		);
    
    }

    public function thankyou(){

    	return view('thankyou', 
    		[
    			'page' => 'thankyou'
	    	]
	    );

    }
}
