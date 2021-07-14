<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'title' => 'required|min:3',
        ]);
        // dd($validate);
        if ($request->avatar) {
            // dd($request->image);
            $request->validate([
                'avatar' => 'required|mimes: jpg,jpeg,png,svg,gif|max:1024',
            ]);
            $extension = $request->avatar->getClientOriginalExtension();
            $image_name = Str::slug($request->title) . time() . '.' . $extension;
            // dd($image_name);
            $uploaded = $request->avatar->move(public_path('/uploads/products'), $image_name);
            $request['image'] = $image_name;
        }
        // dd($request->all());
        $request['slug'] = Str::slug($request->title);
        $request['user_id'] = Auth::user()->id;
        $product=Product::create($request->all());
        // dd($product);
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
        ]);
        if ($request->avatar) {
            $request->validate([
                'avatar' => 'required|mimes:jpg,jpeg,png,svg,gif|max:3000',
            ]);
            $extension = $request->avatar->getClientOriginalExtension();
            $image_name = Str::slug($request->title) . time() . "." . $extension;
            $uploaded = $request->avatar->move(public_path('/uploads/products'), $image_name);
            if ($product->image && file_exists("uploads/products/" . $product->image)) {
                unlink("uploads/products/" . $product->image);
            }
            $product->image = $image_name;
        }
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->user_id = Auth::user()->id;
        $product->update();
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if ($product->image && file_exists("uploads/products/" . $product->image)) {
            unlink("uploads/products/" . $product->image);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successful');
    }
}
