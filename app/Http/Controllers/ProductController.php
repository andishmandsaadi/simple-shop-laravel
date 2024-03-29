<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductLike;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $isLiked = false;
        if (Auth::check()) {
            $isLiked = ProductLike::where('product_id', $product->id)
                                ->where('user_id', Auth::id())
                                ->exists();
        }

        return view('products.show', compact('product', 'isLiked'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Product
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $fileNameToStore;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function like($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        ProductLike::updateOrCreate(
            ['user_id' => $user->id],
            ['product_id' => $product->id]
        );

        return response()->json(['success' => true]);
    }

    public function unlike($id)
    {
        $user = Auth::user();
        $like = ProductLike::where('product_id', $id)->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();
        }

        return response()->json(['success' => true]);
    }
}
