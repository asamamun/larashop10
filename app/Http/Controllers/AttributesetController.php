<?php

namespace App\Http\Controllers;

use App\Models\Attributeset;
use App\Http\Requests\StoreAttributesetRequest;
use App\Http\Requests\UpdateAttributesetRequest;
use App\Models\Attribute;

class AttributesetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attribsets = Attributeset::orderBy('created_at', 'desc')->paginate(config('constants.items_per_page'));
		$attributes = Attribute::orderBy('attgroup','desc')->get();
		//dd()
		return view('admin.attributeset.index')->
		with('attribsets', $attribsets)->
		with('attributes',$attributes);
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
    public function store(StoreAttributesetRequest $request)
    {
        $newattribset = new Attributeset();
		$newattribset->name = $request->name;
        $newattribset->content = $request->content;
		$newattribset->save();
		if($newattribset->id){
		$attributes = 	explode(",",$request->att);
		//foreach($attributes as $a){
		$newattribset->attributes()->attach($attributes);
		return response()->json(['success'=>'true','message'=>'Inserted']);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Attributeset $attributeset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attributeset $attributeset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributesetRequest $request, Attributeset $attributeset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attributeset $attributeset)
    {
        //
    }
}
