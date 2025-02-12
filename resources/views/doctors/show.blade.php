@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Información del Doctor</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nombre:</div>
                        <div class="col-md-8">{{ $doctor->nombre }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Apellido:</div>
                        <div class="col-md-8">{{ $doctor->apellido }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Teléfono:</div>
                        <div class="col-md-8">{{ $doctor->telefono }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Especialidad:</div>
                        <div class="col-md-8">{{ $doctor->especialidad }}</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Volver</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDoctorModal">
                            Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editDoctorModalLabel">Editar Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                               value="{{ old('nombre', $doctor->nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" 
                               value="{{ old('apellido', $doctor->apellido) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="number" class="form-control" id="telefono" name="telefono" 
                               value="{{ old('telefono', $doctor->telefono) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <input type="text" class="form-control" id="especialidad" name="especialidad" 
                               value="{{ old('especialidad', $doctor->especialidad) }}" required>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editModal = new bootstrap.Modal(document.getElementById('editDoctorModal'));
        editModal.show();
    });
</script>
@endif
@endsection