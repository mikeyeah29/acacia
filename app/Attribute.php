<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function options(){
    	return $this->hasMany(Option::class);
    }

    protected static function boot(){

        parent::boot();

        static::deleting(function($attribute){
            Option::where('attribute_id', $attribute->id)->delete();
        });

    }
}
