<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::orderBy('created_at', 'desc')->paginate(config('constants.items_per_page'));
		return view('admin.attribute.index')->with('attributes', $attributes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        $newattrib = new Attribute();
		$newattrib->name = $request->name;
		$newattrib->screenname = $request->screenname;
		$newattrib->content = $request->content;		
		$newattrib->unit = $request->unit;
        $newattrib->type = $request->type;		
		$newattrib->values = $request->values;
		$newattrib->attgroup = $request->attgroup;
		$newattrib->save();
		if($newattrib->id){
		echo "Attribute added. Id:".$newattrib->id ;
		}
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {                
        return response()->json($attribute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
