<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('flag', 0)->get();

        return view('Product.index', compact('products'));
    }

    public function getFilteredProducts(Request $request)
{
    $flag = $request->input('flag');
    if($flag == 0){
        $products = Product::where('flag', 0)->get();
    }else if($flag == 1){
        $products = Product::where('flag', 1)->get();
    }else{
        $products = Product::get();
    }
    return view('Product.index', compact('products'));
}


// public function index()
// {
//     return view('product');
// }

public function getProducts()
{
    try {
        $products = Product::where('flag', 0)->get();
        return response()->json(['products' => $products]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error fetching products'], 500);
    }
}


    public function create()
    {
        return view('Product.insert');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price'=> 'required',
        ]);

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'flag' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('Product.list')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('Product.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        if ($product) {
            $product->update([
                'flag' => 1,
                'updated_at' => now(),
            ]);

            return redirect()->route('Product.list')->with('success', 'Product Deleted successfully!');
        }

        return redirect()->route('Product.list')->with('error', 'Product not found!');
    }

    public function edit(Product $product)
    {
        return view('Product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if ($product) {
            $product->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'flag' => $request->input('flag'),
                'updated_at' => now(),
            ]);

            return redirect()->route('Product.list')->with('success', 'Product updated successfully!');
        }

        return redirect()->route('Product.list')->with('error', 'Product not found!');
    }
}

?>
