<?php

namespace App\Http\Controllers;

use App\Models\Colours as Colour;
use App\Http\Requests\ColorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = DB::table('colors')->get();
        return view('colors.index', compact('colors'));
    }
    public function create()
    {
        return view('colors.create_edit');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $color =  new Colour();
        $color->color = $request->input('color') ;
        // $color->plate = $request->input('plate') ;
        $color->save();

        return redirect()->route('colors.index')
            ->with('success', 'Color created successfully.');
    }

    public function edit($id)
    {
        $color = Colour::findOrFail($id);
        return view('colors.create_edit', compact('color'));
    }

    public function update(ColorRequest $request, $id)
    {
        $color = Colour::findOrFail($id);

        $color->update($request->all());

        return redirect()->route('colors.index')
            ->with('success', 'Color updated successfully.');
    }

    public function destroy($id)
    {
        $color = Colour::findOrFail($id);

        $color->delete();

        return redirect()->route('colors.index')
            ->with('success', 'Color deleted successfully.');
    }
}
