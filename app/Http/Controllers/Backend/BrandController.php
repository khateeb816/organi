<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('backend.admin.brand.index', compact('brands'));
    }
    public function add()
    {

        return view('backend.admin.brand.add');
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:15',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = uniqid() . '_' . $image->getClientOriginalName();

            $image->move(public_path('backendAssets/images/brand'), $imageName);
        }

        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->logo = 'backendAssets/images/brand/' . $imageName; // Store the path to the image
        $brand->address = $request->input('address');
        $brand->number = $request->input('number');

        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand added successfully!');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully!');
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
        ]);
        $brand = Brand::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backendAssets/images/brand'), $imageName);
            $brand->logo = 'backendAssets/images/brand/' . $imageName;
        }
        $brand->name = $request->input('name');
        $brand->address = $request->input('address');
        $brand->number = $request->input('number');
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Brand updated successfully!');
    }

    public function member($id){
        $members = User::where('brand_id' , $id)->get();
        $brand = Brand::find($id);
        return view('backend.admin.brand.member', compact('members' , 'id' , 'brand'));
    }
}
