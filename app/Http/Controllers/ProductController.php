<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //This method will return the view file
    public function index()
    {
        $product = Product::orderBy('created_at', 'desc')->get();

        return view('products.list', ['products' => $product]);
    }

    //This method will show the product create form
    public function create()
    {
        return view('products.create');
    }

    //This method will store the product data
    public function store(Request $requset)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($requset->image != "") {
            $rules['image'] = 'mimes:jpeg,jpg,png,gif|max:10000';
        }

        $validator = Validator::make($requset->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        //insert product data into database
        $product = new Product();
        $product->name = $requset->name;
        $product->sku = $requset->sku;
        $product->price = $requset->price;
        $product->description = $requset->description;
        $product->save();

        if ($requset->image != "") {
            //store image
            $image = $requset->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //Unique name

            //save image in public folder
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in DB
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    //This method will show edit form
    public function edit($id)
    {
        $product = Product::findorFail($id);

        return view('products.edit', ['product' => $product]);
    }

    //This method will update the product data
    public function update($id, Request $request)
    {
        $product = Product::findorFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($request->image != "") {
            $rules['image'] = 'mimes:jpeg,jpg,png,gif|max:10000';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        //update product data into database
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            //delete old image
            File::delete(public_path('uploads/products/' . $product->image));

            //store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //Unique name

            //save image in public folder
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in DB
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    //This method will delete the product data
    public function destroy($id)
    {
        $product = Product::findorFail($id);

        //detele image
        File::delete(public_path('uploads/products/' . $product->image));

        //delete product data
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
