<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Http\Request;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluarga = Keluarga::with('parents')->get();

        return view('pages.index', compact('keluarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('keluarga.store');
        $parents = Keluarga::where('parent_id', '=', 1)->get();

        return view('pages._form', compact('parents', 'method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
        ]);

        Keluarga::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('keluarga.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $method = "update";
        $url = route('keluarga.update', $id);
        $keluarga = Keluarga::findOrfail($id);
        $parents = Keluarga::where('parent_id', '=', 1)->get();

        return view('pages._form', compact('parents', 'keluarga', 'method', 'url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
        ]);

        Keluarga::where('id', $id)->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('keluarga.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keluarga = Keluarga::findOrFail($id);
        $keluarga->delete();

        return redirect()->route('keluarga.index');
    }
}
