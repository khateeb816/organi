<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\catagory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class catagoryController extends Controller
{
    use HasFactory;
    //
    public function index()
    {
        $catagorys = catagory::all();

        return view('backend.admin.catagory.index', compact('catagorys'));
    }

    public function add()
    {

        return view('backend.admin.catagory.add');
    }


    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',

        ]);



        $catagory = new catagory();
        $catagory->name = $request->input('name');
        $catagory->description = $request->input('description');

        $catagory->save();

        return redirect()->route('catagory.index')->with('success', 'Brand added successfully!');
    }

    public function delete($id)
    {
        $catagory = catagory::find($id);
        $catagory->delete();
        return redirect()->route('catagory.index')->with('success', 'catagory deleted successfully!');
    }

    public function edit($id)
    {
        $catagory = catagory::find($id);
        return view('backend.admin.catagory.edit', compact('catagory'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',

        ]);
        $catagory = catagory::find($id);

        $catagory->name = $request->input('name');
        $catagory->description = $request->input('description');

        $catagory->save();
        return redirect()->route('catagory.index')->with('success', 'catagory updated successfully!');
    }
}
