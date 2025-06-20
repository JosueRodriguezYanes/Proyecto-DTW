@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="fas fa-paw"></i> Listado de Mascotas</h2>
                <a href="{{ route('pets.create') }}" class="btn btn-light">
                    <i class="fas fa-plus"></i> Nueva Mascota
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($pets->isEmpty())
                <div class="alert alert-info">
                    No hay mascotas registradas todavía.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Especie</th>
                                <th>Raza</th>
                                <th>Edad</th>
                                <th>Dueño</th>
                                <th>Vacunado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pets as $pet)
                                <tr>
                                    <td>{{ $pet->name }}</td>
                                    <td>{{ $pet->species }}</td>
                                    <td>{{ $pet->breed }}</td>
                                    <td>{{ $pet->age }} años</td>
                                    <td>{{ $pet->owner_name }}</td>
                                    <td>
                                        @if($pet->vaccinated)
                                            <span class="badge bg-success"><i class="fas fa-check"></i> Sí</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-times"></i> No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pets.show', $pet) }}" class="btn btn-sm btn-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pets.edit', $pet) }}" class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $pets->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection