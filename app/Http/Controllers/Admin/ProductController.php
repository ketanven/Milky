<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['seller', 'category'])->orderBy('created_at', 'desc')->get();
        $sellers = Seller::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        return view('Admin.products.index', compact('products', 'sellers', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'freshness' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    // public function update(Request $request, Product $product)
    // {
    //     $data = $request->validate([
    //         'seller_id' => 'required|exists:sellers,id',
    //         'category_id' => 'nullable|exists:categories,id',
    //         'name' => 'required|string|max:255',
    //         'sku' => "nullable|string|unique:products,sku,{$product->id}",
    //         'description' => 'nullable|string',
    //         'price' => 'required|numeric|min:0',
    //         'quantity' => 'required|integer|min:0',
    //         'unit' => 'nullable|string|max:50',
    //         'freshness' => 'nullable|string|max:50',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     $data['is_active'] = $request->has('is_active') ? 1 : 0;

    //     if ($request->hasFile('image')) {
    //         if ($product->image) {
    //             Storage::disk('public')->delete($product->image);
    //         }
    //         $data['image'] = $request->file('image')->store('products', 'public');
    //     }

    //     $product->update($data);

    //     return redirect()->back()->with('success', 'Product updated successfully.');
    // }

    // Show the edit page
    public function edit(Product $product)
    {
        $sellers = Seller::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();

        return view('Admin.products.edit', compact('product', 'sellers', 'categories'));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => "nullable|string|unique:products,sku,{$product->id}",
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'freshness' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }



    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->save();
        return redirect()->back()->with('success', 'Product status updated.');
    }
}
