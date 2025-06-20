<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        view()->share('hide_logo', true); // Oculta el logo
        $titulo = "Listado de Mascotas";
        $pets = Pet::paginate(10);
        return view('pets.index', compact('pets', 'titulo'));
    }

    public function create()
    {
        view()->share('hide_logo', true); // Oculta el logo
        $this->authorize('create', Pet::class);
        return view('pets.create')->with('titulo', 'Registrar Mascota');
    }

    public function show(Pet $pet)
    {
        view()->share('hide_logo', true); // Oculta el logo
        $this->authorize('view', $pet);
        return view('pets.show', compact('pet'))->with('titulo', 'Detalle de Mascota');
    }

    public function edit(Pet $pet)
    {
        view()->share('hide_logo', true); // Oculta el logo
        $this->authorize('update', $pet);
        return view('pets.edit', compact('pet'))->with('titulo', 'Editar Mascota');
    }
    public function store(Request $request)
    {
        $this->authorize('create', Pet::class);

        // Primero prepara los datos antes de validar
        $request->merge([
            'vaccinated' => $request->has('vaccinated')
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'owner_name' => 'required|string|max:255',
            'vaccinated' => 'required|boolean',
        ]);

        Pet::create($validated);

        return redirect()->route('pets.index')->with('success', 'Mascota registrada correctamente.');
    }

    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        // Primero prepara los datos antes de validar
        $request->merge([
            'vaccinated' => $request->has('vaccinated')
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'owner_name' => 'required|string|max:255',
            'vaccinated' => 'required|boolean',
        ]);

        $pet->update($validated);

        return redirect()->route('pets.index')->with('success', 'Mascota actualizada correctamente.');
    }

   public function destroy(Pet $pet)
{
    $this->authorize('delete', $pet);
    $pet->delete();
    return redirect()->route('pets.index')->with('success', 'Mascota eliminada correctamente.');
}
    
}