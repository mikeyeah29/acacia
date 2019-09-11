<?php

namespace App\Http\Controllers\API;

use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::orderBy('position', 'asc')->get();
        return response()->json(['attributes' => $attributes], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        $attribute->options;
        return response()->json(['attribute' => $attribute], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        request()->validate([
            'name' => 'required'
        ]);

        $attribute->name = $request->name;
        $attribute->save();

        return response()->json(['message' => 'Attribute updated'], 200);
    }

    public function reorder(Request $request)
    {
        request()->validate([
            'arrtids' => 'required'
        ]);
        // loop arr
        foreach ($request->arrtids as $index => $attribute_id) {
            Attribute::where('id', $attribute_id)->update(['position' => $index]);
        }
        // assign position in that order
        return response()->json(['message' => 'Attributes reordered'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(['message' => 'Attribute deleted'], 200);
    }
}
