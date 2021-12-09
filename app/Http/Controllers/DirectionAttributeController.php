<?php

namespace App\Http\Controllers;

use App\Models\DirectionAttribute;
use App\Models\Attribute;
use App\Models\Zone;
use Illuminate\Http\Request;

class DirectionAttributeController extends Controller
{
    public function index()
    {
        $attribute = DirectionAttribute::join('attributes', 'attributes.id', '=', 'directions_and_attributes.attribute_id')->join('zone', 'zone.id', '=', 'directions_and_attributes.zone_id')->get(['directions_and_attributes.*', 'attributes.name as attribute_name', 'zone.direction_name']);
        $attrs = Attribute::all();
        $zones = Zone::all();
        return view('admin.direction_attribute.index', compact('attribute','attrs','zones'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required',
            'zone_id' => 'required',
        ]);

        DirectionAttribute::create($request->all());

        return redirect()->route('direction_attribute.index')->with('success', 'Direction & Attribute created successfully.');
    }

    public function update(Request $request, DirectionAttribute $zon)
    {
        $request->validate([
            'attribute_id' => 'required',
            'zone_id' => 'required',
        ]);
        
        $attribute = DirectionAttribute::find($request->input('id'));
        $attribute->attribute_id = $request->input('attribute_id');
        $attribute->zone_id = $request->input('zone_id');
        $attribute->update();

        return redirect()->route('direction_attribute.index')->with('success', 'Direction & Attribute updated successfully');
    }

    public function destroy(Request $request, DirectionAttribute $zon)
    {
        $attribute = DirectionAttribute::find($request->input('id'));
        $attribute->delete();
        
        return redirect()->route('direction_attribute.index')->with('success', 'Direction & Attribute deleted successfully');
    }
}
