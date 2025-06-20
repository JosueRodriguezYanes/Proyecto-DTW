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
        $this->authorize('viewAny', Pet::class);
        $pets = Pet::all();
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        $this->authorize('create', Pet::class);
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Pet::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'owner_name' => 'required|string|max:255',
            'vaccinated' => 'boolean',
        ]);

        Pet::create($validated);

        return redirect()->route('pets.index')->with('success', 'Mascota creada correctamente.');
    }

    public function edit(Pet $pet)
    {
        $this->authorize('update', $pet);
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'owner_name' => 'required|string|max:255',
            'vaccinated' => 'boolean',
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