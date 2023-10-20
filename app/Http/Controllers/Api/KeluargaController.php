<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluarga = Keluarga::with('parents')->get();

        return response([
            'data' => $keluarga,
            'message' => "success"
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request, [
            'name' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response([
                'message' =>  'errors',
                'errors' => $errors
            ], 422);
        }

        $request->validate();

        $keluarga = Keluarga::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'parent_id' => $request->parent_id
        ]);

        return response([
            'data' => $keluarga,
            'message' => "success"
        ], 200);
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
        $validator = Validator::make($request, [
            'name' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response([
                'message' =>  'errors',
                'errors' => $errors
            ], 422);
        }

        $keluarga = Keluarga::where('id', $id)->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'parent_id' => $request->parent_id
        ]);

        return response([
            'data' => $keluarga,
            'message' => "success"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keluarga = Keluarga::findOrFail($id);
        if ($keluarga->delete()) {
            return response([
                'message' => "success"
            ], 200);
        } else {
            return response([
                'message' => "errors"
            ], 500);
        }
    }
}
