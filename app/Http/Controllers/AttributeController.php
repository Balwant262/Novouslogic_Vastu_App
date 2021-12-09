<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attribute = Attribute::all();
        return view('admin.attribute.index', compact('attribute'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Attribute::create($request->all());

        return redirect()->route('attribute.index')->with('success', 'Attribute created successfully.');
    }

    public function update(Request $request, Attribute $zon)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $attribute = Attribute::find($request->input('id'));
        $attribute->name = $request->input('name');
        $attribute->description = $request->input('description');
        $attribute->update();

        return redirect()->route('attribute.index')->with('success', 'Attribute updated successfully');
    }

    public function destroy(Request $request, Attribute $zon)
    {
        $attribute = Attribute::find($request->input('id'));
        $attribute->delete();
        
        return redirect()->route('attribute.index')->with('success', 'Attribute deleted successfully');
    }
}
