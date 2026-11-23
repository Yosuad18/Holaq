<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Revision::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:255',
            'aceite' => 'required|bollean',
            'nitro' => 'required|boolean',
            'frenos' => 'required|boolean',
        ]);
        
        $revision=Revision::create($validated);
        
        return response()->json($revision, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Revision $revision)
    {
        return response()->json($revision);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Revision::find($id);
        return response ()->json($client, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revision $revision)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:255',
            'aceite' => 'required|bollean',
            'nitro' => 'required|boolean',
            'frenos' => 'required|boolean',
        ]);
        $revision->update($validated);

        return redirect()->route('admin.panel')->with('succes', 'helloo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revision $revision)
    {
        $revision->delete();
        return response ()->json(['message'=>'centro'],200);
        
    }
}
