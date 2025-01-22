<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('catagory')->get();
        return view("backend.admin.product.index", compact("products"));
    }

    public function add()
    {
        $catagories = Catagory::all(); // Fetch categories for dropdown
        return view('backend.admin.product.add', compact('catagories'));
    }

    public function save(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required',
            'quantity' => 'required',
            'images' => 'required',
            'color' => 'required|array',
            'size' => 'required|array',
            'catagory_id' => 'required',
        ]);
        // dd($request->all());
        // Handle Image Upload
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imageName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('backendAssets/images/products'), $imageName);
                $images[] = 'backendAssets/images/products/' . $imageName;
            }
        }

        // Save Product
        Product::insert([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'total_items' => $request->quantity,
            'images' => json_encode($images),
            'color' => json_encode($request->color), // Encode the array to JSON for database storage
            'size' => json_encode($request->size),   // Encode the array to JSON for database storage
            'catagory_id' => $request->catagory_id,
            'brand_id' => Auth::user()->brand_id,
            'created_at' => now(),
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function edit($id)
    {
        $catagories = Catagory::all();
        $product = Product::find($id);
        return view('backend.admin.product.edit', compact('product', 'catagories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        'color' => 'required|array',
        'size' => 'required|array',
        'catagory_id' => 'required|exists:catagories,id',
        'status' => 'required',   // Validate status field
        'state' => 'required',
    ]);

    // Find the product
    $product = Product::findOrFail($id);

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->move(public_path('backendAssets/images/products'), $imageName);

        // Delete the old image if it exists
        if ($product->images && file_exists(public_path($product->images))) {
            unlink(public_path($product->images));
        }

        // Update image path
        $product->images = 'backendAssets/images/products/' . $imageName;
    }

    // Update other product details
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->total_items = $request->input('quantity');
    $product->color = json_encode($request->input('color'));
    $product->size = json_encode($request->input('size'));
    $product->catagory_id = $request->input('catagory_id');
    $product->status = $request->input('status');
    $product->state = $request->input('state');

    // Save changes
    $product->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Product updated successfully!');
}

public function view($id)
{
    $product = Product::with('catagory') // Assuming category relationship exists
        ->findOrFail($id);

    return view('backend.admin.product.view', compact('product'));
}

}
