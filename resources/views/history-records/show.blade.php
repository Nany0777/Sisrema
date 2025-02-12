@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12">
            <h3>Historia Médica #{{ $record->numero_historia }}</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <h4 class="mb-3">Datos del Paciente</h4>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nombre:</div>
                            <div class="col-md-8">{{ $record->patient->nombre }} {{ $record->patient->apellido }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Cédula:</div>
                            <div class="col-md-8">{{ $record->patient->ci }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Edad:</div>
                            <div class="col-md-8">{{ $record->patient->edad }}</div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Datos de la Historia</h4>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Doctor:</div>
                            <div class="col-md-8">{{ $record->doctor->nombre }} {{ $record->doctor->apellido }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Fecha de Nacimiento:</div>
                            <div class="col-md-8">{{ $record->fecha_nacimiento->format('d/m/Y') }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tipo de Sangre:</div>
                            <div class="col-md-8">{{ $record->tipo_samgre }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Último Examen Físico:</div>
                            <div class="col-md-8">
                                {{ $record->fecha_ultimo_examen_fisico ? $record->fecha_ultimo_examen_fisico->format('d/m/Y') : 'No registrado' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Alergias:</div>
                            <div class="col-md-8">{{ $record->alergias ?: 'Ninguna registrada' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Enfermedades:</div>
                            <div class="col-md-8">{{ $record->enfermedades ?: 'Ninguna registrada' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Descripción:</div>
                            <div class="col-md-8">{{ $record->descripcion ?: 'Sin descripción' }}</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('history-records.index') }}" class="btn btn-secondary">Volver</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRecordModal">
                                Editar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Edición -->
<div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('history-records.update', $record->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editRecordModalLabel">Editar Historia Médica</h5>
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

                    <div class="row">
                        <input type="text" name="id_patient" id="" value="{{ $record->id_patient }}" hidden>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="numero_historia" class="form-label">Número de Historia</label>
                                <input type="number" class="form-control" id="numero_historia" name="numero_historia" 
                                       value="{{ old('numero_historia', $record->numero_historia) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="id_doctor" class="form-label">Doctor</label>
                                <select class="form-select" id="id_doctor" name="id_doctor" required>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('id_doctor', $record->id_doctor) == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->nombre }} {{ $doctor->apellido }} - {{ $doctor->especialidad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" 
                                       value="{{ old('fecha_nacimiento', $record->fecha_nacimiento->format('Y-m-d')) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tipo_samgre" class="form-label">Tipo de Sangre</label>
                                <select class="form-select" id="tipo_samgre" name="tipo_samgre" required>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $tipo)
                                        <option value="{{ $tipo }}" {{ old('tipo_samgre', $record->tipo_samgre) == $tipo ? 'selected' : '' }}>
                                            {{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_ultimo_examen_fisico" class="form-label">Fecha del Último Examen Físico</label>
                        <input type="date" class="form-control" id="fecha_ultimo_examen_fisico" name="fecha_ultimo_examen_fisico" 
                               value="{{ old('fecha_ultimo_examen_fisico', $record->fecha_ultimo_examen_fisico?->format('Y-m-d')) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="alergias" class="form-label">Alergias</label>
                        <textarea class="form-control" id="alergias" name="alergias" rows="3">{{ old('alergias', $record->alergias) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="enfermedades" class="form-label">Enfermedades</label>
                        <textarea class="form-control" id="enfermedades" name="enfermedades" rows="3">{{ old('enfermedades', $record->enfermedades) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $record->descripcion) }}</textarea>
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
        var editModal = new bootstrap.Modal(document.getElementById('editRecordModal'));
        editModal.show();
    });
</script>
@endif
@endsection