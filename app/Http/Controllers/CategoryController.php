<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = validator(request()->all(), [
            'name'=> 'required',
            'code' => 'required',
            'user' => 'required',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->code = $request->code;
        $category->user_id = $request->user;
        $category->save();

        return redirect(route('categories.index'))->with('Success', 'Category Created Successfully');

    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if(! $category) return back()->with('Error','Category Not Found');
        return view('categories.edit',[
            'category' => $category
        ]);

    }

    public function update(Request $request, Category $category)
    {
        if(! $category) return back()->with('Error','Category Not Found');

        $validator = validator(request()->all(), [
            'name'=> 'required',
            'code' => 'required',
            'user' => 'required',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category->update($request->all());
        return redirect(route('categories.index'))->with('Success', 'Category Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (! $category) {
            return back()->with('Error','Category Not Found');
        }
        $category->delete();
        return redirect()->back()->with('Success', 'Category Deleted Successfully');
    }
}
