<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Http\Resources\SubcategoryResource;

class SubcategoryController extends Controller
{
    public function index()
    {
        return SubcategoryResource::collection(Subcategory::all());
    }

    public function store(StoreSubcategoryRequest $request)
    {
        $subcategory = Subcategory::create($request->validated());
        return new SubcategoryResource($subcategory);
    }

    public function show(Subcategory $subcategory)
    {
        return new SubcategoryResource($subcategory);
    }

    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        $subcategory->update($request->validated());
        return new SubcategoryResource($subcategory);
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return response()->json(null, 204);
    }
}
