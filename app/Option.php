<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Option extends Model
{
    protected $fillable = [
        'attribute_id', 'name', 'image_path', 'cost',
    ];

    protected static function boot(){

        parent::boot();

        static::deleting(function($option){
            Storage::delete('storage/' . $option->image_path);
        });

    }

    public function attribute(){
		return $this->belongsTo(Attribute::class);
	}
}
