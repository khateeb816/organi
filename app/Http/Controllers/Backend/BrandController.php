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

    public function addMember($id){
        $brand = Brand::find($id);
        return view('backend.admin.brand.add-member', compact('brand'));
    }

    public function saveMember(Request $request){
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
        return redirect()->route('brand.member' , $request->input('brand_id'))->with('success', 'Member Added Successfully' );
    }

    public function editMember($id){
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

        return redirect('admin/brand-member/'. $user->brand_id)->with('success', 'User updated successfully');
    }
    public function deleteMember($id){
    $member = User::find($id);
    $member->delete();
    return redirect()->back()->with('success', 'Member Deleted Successfully');
    }
}
