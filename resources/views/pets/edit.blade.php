@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h2 class="mb-0"><i class="fas fa-edit"></i> Editar Mascota</h2>
        </div>
        
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pets.update', $pet) }}" method="POST" id="petForm" class="needs-validation" novalidate>
                @csrf
                @method('PUT')


             

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $pet->name) }}" required>
                        <div class="invalid-feedback">Por favor ingrese el nombre de la mascota.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="species" class="form-label">Especie *</label>
                        <select class="form-select" name="species" id="species" required>
                            <option value="" disabled>Seleccione una especie</option>
                            <option value="Perro" {{ old('species', $pet->species) == 'Perro' ? 'selected' : '' }}>Perro</option>
                            <option value="Gato" {{ old('species', $pet->species) == 'Gato' ? 'selected' : '' }}>Gato</option>
                            <option value="Ave" {{ old('species', $pet->species) == 'Ave' ? 'selected' : '' }}>Ave</option>
                            <option value="Roedor" {{ old('species', $pet->species) == 'Roedor' ? 'selected' : '' }}>Roedor</option>
                            <option value="Reptil" {{ old('species', $pet->species) == 'Reptil' ? 'selected' : '' }}>Reptil</option>
                            <option value="Otro" {{ old('species', $pet->species) == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        <div class="invalid-feedback">Por favor seleccione la especie.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="breed" class="form-label">Raza *</label>
                        <input type="text" class="form-control" name="breed" id="breed" value="{{ old('breed', $pet->breed) }}" required>
                        <div class="invalid-feedback">Por favor ingrese la raza.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="age" class="form-label">Edad (años) *</label>
                        <input type="number" class="form-control" name="age" id="age" min="0" max="30" value="{{ old('age', $pet->age) }}" required>
                        <div class="invalid-feedback">Por favor ingrese una edad válida (0-30).</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="owner_name" class="form-label">Dueño *</label>
                        <input type="text" class="form-control" name="owner_name" id="owner_name" value="{{ old('owner_name', $pet->owner_name) }}" required>
                        <div class="invalid-feedback">Por favor ingrese el nombre del dueño.</div>
                    </div>

                       <div class="col-md-4 mb-3 d-flex align-items-end">
    <input type="hidden" name="vaccinated" value="0">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" 
               name="vaccinated" id="vaccinated" value="1"
               @if(old('vaccinated', $pet->vaccinated ?? false)) checked @endif>
        <label class="form-check-label" for="vaccinated">Vacunado</label>
    </div>
</div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary me-md-2">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-save"></i> Actualizar Mascota
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Validación del formulario (igual que en create)
(function() {
    'use strict';
    
    const form = document.getElementById('petForm');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    }, false);
    
    // Validación personalizada para la edad
    const ageInput = document.getElementById('age');
    ageInput.addEventListener('input', function() {
        if (ageInput.validity.rangeUnderflow) {
            ageInput.setCustomValidity('La edad no puede ser menor que 0');
        } else if (ageInput.validity.rangeOverflow) {
            ageInput.setCustomValidity('La edad no puede ser mayor que 30');
        } else {
            ageInput.setCustomValidity('');
        }
    });
})();
</script>
@endsection