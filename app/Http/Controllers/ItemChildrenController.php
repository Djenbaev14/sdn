<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemChildrenResource;
use App\Models\Item_children;
use Illuminate\Http\Request;

class ItemChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return ItemChildrenResource::collection(Item_children::all());
        return Item_children::with('item')->get();
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
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Item_children $children)
    {
        return new ItemChildrenResource($children);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
