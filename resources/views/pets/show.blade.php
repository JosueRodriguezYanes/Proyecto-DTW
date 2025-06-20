@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h2 class="mb-0"><i class="fas fa-paw"></i> Detalle de Mascota</h2>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="pet-avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px; font-size: 3rem;">
                        <i class="fas fa-dog"></i>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Nombre:</strong></h5>
                            <p class="fs-4">{{ $pet->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Especie:</strong></h5>
                            <p class="fs-4">{{ $pet->species }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Raza:</strong></h5>
                            <p class="fs-4">{{ $pet->breed }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Edad:</strong></h5>
                            <p class="fs-4">{{ $pet->age }} años</p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Dueño:</strong></h5>
                            <p class="fs-4">{{ $pet->owner_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Vacunado:</strong></h5>
                            <p class="fs-4">
                                @if($pet->vaccinated)
                                    <span class="badge bg-success"><i class="fas fa-check"></i> Sí</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times"></i> No</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
                <a href="{{ route('pets.edit', $pet) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit"></i> Editar Mascota
                </a>
            <!-- Botón de Eliminar con confirmación -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash-alt"></i> Eliminar Mascota
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro que deseas eliminar a "{{ $pet->name }}"? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('pets.destroy', $pet) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Confirmar Eliminación
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .pet-avatar {
        transition: transform 0.3s;
    }
    .pet-avatar:hover {
        transform: scale(1.1);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script adicional para manejar el formulario -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Verificación adicional antes de enviar
    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Aquí puedes agregar más validaciones si necesitas
        this.submit();
    });
    
    // Cambiar ícono según especie (tu código actual)
    const petAvatar = document.querySelector('.pet-avatar i');
    const species = "{{ strtolower($pet->species) }}";
    
    if (species.includes('gato')) {
        petAvatar.className = 'fas fa-cat';
    } else if (species.includes('ave')) {
        petAvatar.className = 'fas fa-dove';
    } else if (species.includes('roedor')) {
        petAvatar.className = 'fas fa-otter';
    } else if (species.includes('reptil')) {
        petAvatar.className = 'fas fa-dragon';
    }
});
</script>
@endsection