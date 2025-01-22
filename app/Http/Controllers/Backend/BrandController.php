<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('backend.admin.brand.index', compact('brands'));
    }
    public function add()
    {
        $categories = Catagory::all();
        return view('backend.admin.brand.add', compact('categories'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:15|regex:/^\+?[0-9]{10,15}$/',
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'charge' => 'required|numeric|min:0|max:100',
            'categories' => 'required|array',
        ]);

        $image = $request->file('image');
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->move(public_path('backendAssets/images/brand'), $imageName);

        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->logo = 'backendAssets/images/brand/' . $imageName;
        $brand->address = $request->input('address');
        $brand->number = $request->input('number');
        $brand->url = $request->input('website');
        $brand->email = $request->input('email');
        $brand->percent_charge = $request->input('charge');
        $brand->description = $request->input('description');

        $brand->allowed_categories = $request->has('categories') ? json_encode($request->input('categories')) : json_encode("");

        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand added successfully!');
    }


    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully!');
    }

    public function view($id)
    {
        $categories = Catagory::all();
        $brand = Brand::find($id);
        return view('backend.admin.brand.view', compact('brand', 'categories'));
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('backend.admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Pending,Blocked',
            'categories' => 'nullable|array',
        ]);

        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }

        $brand->name = $request->input('name');
        $brand->email = $request->input('email');
        $brand->number = $request->input('number');
        $brand->description = $request->input('description');
        $brand->address = $request->input('address');
        $brand->status = $request->input('status');
        $brand->allowed_categories = $request->has('categories') ? json_encode($request->input('categories')) : null;
        $brand->save();

        return redirect()->back()->with('success', 'Brand updated successfully!');
    }


    public function member($id)
    {
        $members = User::where('brand_id', $id)->get();
        $brand = Brand::find($id);
        return view('backend.admin.brand.member', compact('members', 'id', 'brand'));
    }

    public function addMember($id)
    {
        $brand = Brand::find($id);
        return view('backend.admin.brand.add-member', compact('brand'));
    }

    public function saveMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'brand_id' => 'required'
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->brand_id = $request->input('brand_id');
        $user->role = 'brand_member';
        $user->save();
        return redirect()->route('brand.member', $request->input('brand_id'))->with('success', 'Member Added Successfully');
    }

    public function editMember($id)
    {
        $member = User::find($id);

        return view('backend.admin.brand.member-edit', compact('member'));
    }
    public function updateMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('admin/brand-member/' . $user->brand_id)->with('success', 'User updated successfully');
    }
    public function deleteMember($id)
    {
        $member = User::find($id);
        $member->delete();
        return redirect()->back()->with('success', 'Member Deleted Successfully');
    }

    public function updateBrandImage(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        if ($request->hasFile('brandImage')) {
            $file = $request->file('brandImage');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/brands/' . $filename;

            // Store the file
            $file->move(public_path('uploads/brands'), $filename);

            // Update the brand logo path in the database
            $brand->logo = $filePath;
            $brand->save();

            return redirect()->back()->with('success', 'Image Updated');
        }

        return redirect()->back()->withErrors(['Image Not Updated']);
    }




    public function showProduct($id)
    {
        $products = Product::where('brand_id', $id)->get();
        $brand = Brand::find($id);
        return view('backend.admin.brand.product-show', compact('products', 'id', 'brand'));
    }




    public function addProduct($id)
    {
        $catagories = [];
        $brand = Brand::find($id);
        $allowed_categories = json_decode($brand->allowed_categories);
        foreach ($allowed_categories as $allowed_category) {
            $category = Catagory::find($allowed_category);
            $catagories[] = $category;
        }
        return view('backend.admin.brand.add-product', compact('brand', 'catagories'));
    }

    public function saveProduct(Request $request)
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
            'brand_id' => 'required',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imageName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('backendAssets/images/products'), $imageName);
                $images[] = 'backendAssets/images/products/' . $imageName;
            }
        }

        // Save Product
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'total_items' => $request->quantity,
            'images' => json_encode($images),
            'color' => json_encode($request->color), // Encode the array to JSON for database storage
            'size' => json_encode($request->size),   // Encode the array to JSON for database storage
            'catagory_id' => $request->catagory_id,
            'brand_id' => $request->brand_id,
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function editProduct($id)
    {
        $product = User::find($id);

        return view('backend.admin.brand.product-edit', compact('product'));
    }
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('admin/brand-product/' . $user->brand_id)->with('success', 'User updated successfully');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'product Deleted Successfully');
    }

    public function updateStatus($id, $status)
    {
        $product = Product::findOrFail($id);
        $product->status = $status;
        $product->save();

        return redirect()->back()->with('success', 'Product status updated successfully.');
    }

    public function viewProduct($id){
        $product = Product::find($id);
        return view('backend.admin.brand.product-view', compact('product'));
    }
}
