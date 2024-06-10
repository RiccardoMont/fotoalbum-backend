<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->title, '-');

        $validated['user_id'] = auth()->id();

        Category::create($validated);

        return to_route('admin.categories.index')->with('message', 'New Category created!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if(auth()->id() != $category->user_id){
            abort(403, 'Access denied');
        }

        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->title, '-');

        $category->update($validated);

        return to_route('admin.categories.index')->with('message', 'Category edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(auth()->id() != $category->user_id){
            abort(403, 'Access denied');
        }

        $category->delete();

        return to_route('admin.categories.index')->with('message', 'Category deleted!');
    }
}
