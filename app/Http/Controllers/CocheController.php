<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class CocheController extends Controller
{
    private function cloudinary(): Cloudinary
    {
        return new Cloudinary(env('CLOUDINARY_URL'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Coche::all(), 200);
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
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'precio' => 'required|integer|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:255',
        ]);
        $fotoUrl = null;

        if ($request->hasFile('foto')) {
            $upload = $this->cloudinary()->uploadApi()->upload(
                $request->file('foto')->getRealPath(),
                [
                    'folder'    => 'hospital_pacientes',
                    'public_id' => $validated['id'],
                    'overwrite' => true,
                ]
            );
            $fotoUrl = $upload['secure_url'];
        }

        $coche = Coche::create([
            'marca' => $validated['codigo_paciente'],
            'modelo'    => $validated['nombre'],
            'color'     => $validated['apellidos'],
            'precio'    => $validated['apellidos'],
            'foto'      => $fotoUrl,
        ]);

        return response()->json($coche, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Coche $coche)
    {
        return response()->json($coche, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coche = Coche::find($id);
        return response () ->json ($coche, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $coche = Coche::find($id);

        if (!$coche) {
            return response()->json(['message' => 'Coche no encontrado.'], 404);
        }

        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'precio' => 'required|integer|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:255',
        ]);

        $data = [
            'nombre'    => $validated['nombre'],
            'apellidos' => $validated['apellidos'],
        ];

        if ($request->hasFile('foto')) {
            $upload = $this->cloudinary()->uploadApi()->upload(
                $request->file('foto')->getRealPath(),
                [
                    'folder'     => 'examen',
                    'public_id'  => $validated['id'],
                    'overwrite'  => true,
                    'invalidate' => true,
                ]
            );
            $data['foto_url'] = $upload['secure_url'];
        }

        $coche->update($data);

        return response()->json($coche, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coche $coche)
    {
        $coche ->delete();
        return response ()->json(['message'=>'centro'], 200);
    }
}
