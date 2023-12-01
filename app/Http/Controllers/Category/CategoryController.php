<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCatergoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories=Category::all();

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        $data = $request->validated();


        // insert data
        $categories                = new Category;
        $categories->name          = $data['name'];
        $categories->description   = $data['description'];
        $categories->save();

        // redirect
        // return back();
        return redirect()->route('categories.index')->with('status', 'Category created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatergoryRequest $request, Category $category)
    {
         // validation
         $data = $request->validated();
        

         // update data
         $category->name          = $data['name'];
         $category->description   = $data['description'];
         $category->save();
 
         // redirect
        return redirect()->route('categories.index')->with('status', 'Category created successfully');
        // return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // delete record
        $category->delete();
        
        // redirect
        return redirect()->route('categories.index')->with('status', 'Category deleted successfully');//
    }
}
