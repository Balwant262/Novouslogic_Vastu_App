<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    public function index()
    {
        $purpose = Purpose::all();
        return view('admin.purpose.index', compact('purpose'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Purpose::create($request->all());

        return redirect()->route('purpose.index')->with('success', 'Purpose created successfully.');
    }

    public function update(Request $request, Purpose $zon)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $purpose = Purpose::find($request->input('id'));
        $purpose->name = $request->input('name');
        $purpose->update();

        return redirect()->route('purpose.index')->with('success', 'Purpose updated successfully');
    }

    public function destroy(Request $request, Purpose $zon)
    {
        $purpose = Purpose::find($request->input('id'));
        $purpose->delete();
        
        return redirect()->route('purpose.index')->with('success', 'Purpose deleted successfully');
    }
}
