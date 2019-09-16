<?php

namespace App\Http\Controllers\API;

use App\Attribute;
use App\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AttributeOptionsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $attributeId)
    {   
        request()->validate([
            'name' => 'required',
            'cost' => 'required'
        ]);

        $image_path = 'notyet';

        if($request->hasFile('option_image')){
            $image_path = $request->option_image->store('options');
            // $img = Image::make(storage_path('app/' . $image_path))->resize(300, 200);
        }

        Option::create([
            'attribute_id' => $attributeId,
            'name' => $request->name,
            'cost' => $request->cost,
            'image_path' => $image_path
        ]);

        return response()->json(['message' => 'Option Created'], 200);
    }

    public function destroy(Attribute $attribute, Option $option)
    {
        $option->delete();
        return response()->json(['message' => 'Option deleted'], 200);
    }

    public function reorder(Request $request)
    {
        request()->validate([
            'optionids' => 'required'
        ]);
        // loop arr
        foreach ($request->optionids as $index => $optionid) {
            Option::where('id', $optionid)->update(['position' => $index]);
        }
        // assign position in that order
        return response()->json(['message' => 'Options reordered'], 200);
    }
}
