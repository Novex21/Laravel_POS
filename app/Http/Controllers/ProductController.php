<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('products.index', [
            'products' => $products
        ]);
        exit();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', [
            'categories'=>$categories
        ]);
        exit();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator(request()->all(), [
            'name'=> 'required',
            'description' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'alert_stock' => 'required',
            'category_id'=> 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:5120'
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->alert_stock = $request->alert_stock;
        $product->category_id = $request->category_id;
        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('productPhotos','public');
           $product->photo = $path;
        }else {
            $path = 'productPhotos/product_default.jpeg';
           $product->photo = $path;
        }
       $product->save();

        return redirect(route('products.index'))->with('Success', 'Product Created Successfully');
        exit();

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
    public function edit(Product $product)
    {
        if(! $product) return back()->with('Error','Product Not Found');
        $categories = Category::all();
        return view('products.edit',[
            'product' => $product,
            'categories' => $categories
        ]);
        exit();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if(! $product) return back()->with('Error','Product Not Found');

        $validator = validator(request()->all(), [
            'name'=> 'required',
            'description' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'alert_stock' => 'required',
            'category_id' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:5120'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('productPhotos','public');
            $product->photo = $path;
        }

        $product->update($request->all());
        return redirect(route('products.index'))->with('Success', 'Product Updated Successfully');
        exit();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (! $product) {
            return back()->with('Error','Product Not Found');
        }
        $product->delete();
        return redirect()->back()->with('Success', 'Product Deleted Successfully');
        exit();

    }
}
