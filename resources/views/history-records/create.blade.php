@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-12">
                <h3>Nueva Historia Médica</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
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

                            <form action="{{ route('history-records.store') }}" method="POST" id="recordForm">
                                @csrf
                                {{-- <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newPatient"
                                                name="new_patient">
                                            <label class="form-check-label" for="newPatient">
                                                Registrar nuevo paciente
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Selección de paciente existente -->
                                <div id="existingPatientSection">
                                    <div class="form-group mb-3">
                                        <label for="id_patient" class="form-label">Paciente</label>
                                        <select class="form-select @error('id_patient') is-invalid @enderror"
                                            id="id_patient" name="id_patient">
                                            <option value="">Seleccione un paciente...</option>
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}"
                                                    {{ old('id_patient') == $patient->id ? 'selected' : '' }}>
                                                    {{ $patient->ci }} - {{ $patient->nombre }} {{ $patient->apellido }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Formulario de nuevo paciente -->
                                {{-- <div id="newPatientSection" style="display: none;">
                                    @include('patients._form')
                                </div> --}}

                                <hr class="my-4">

                                <!-- Datos de la historia médica -->
                                <h4 class="mb-3">Datos de la Historia Médica</h4>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="numero_historia" class="form-label">Número de Historia</label>
                                            <input type="number"
                                                class="form-control @error('numero_historia') is-invalid @enderror"
                                                id="numero_historia" name="numero_historia"
                                                value="{{ old('numero_historia') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="id_doctor" class="form-label">Doctor</label>
                                            <select class="form-select @error('id_doctor') is-invalid @enderror"
                                                id="id_doctor" name="id_doctor" required>
                                                <option value="">Seleccione un doctor...</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}"
                                                        {{ old('id_doctor') == $doctor->id ? 'selected' : '' }}>
                                                        {{ $doctor->nombre }} {{ $doctor->apellido }} -
                                                        {{ $doctor->especialidad }}
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
                                            <input type="date"
                                                class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                                id="fecha_nacimiento" name="fecha_nacimiento"
                                                value="{{ old('fecha_nacimiento') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tipo_samgre" class="form-label">Tipo de Sangre</label>
                                            <select class="form-select @error('tipo_samgre') is-invalid @enderror"
                                                id="tipo_samgre" name="tipo_samgre" required>
                                                <option value="">Seleccione...</option>
                                                @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $tipo)
                                                    <option value="{{ $tipo }}"
                                                        {{ old('tipo_samgre') == $tipo ? 'selected' : '' }}>
                                                        {{ $tipo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="fecha_ultimo_examen_fisico" class="form-label">Fecha del Último Examen
                                        Físico</label>
                                    <input type="date"
                                        class="form-control @error('fecha_ultimo_examen_fisico') is-invalid @enderror"
                                        id="fecha_ultimo_examen_fisico" name="fecha_ultimo_examen_fisico"
                                        value="{{ old('fecha_ultimo_examen_fisico') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="alergias" class="form-label">Alergias</label>
                                    <textarea class="form-control @error('alergias') is-invalid @enderror" id="alergias" name="alergias" rows="3">{{ old('alergias') }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="enfermedades" class="form-label">Enfermedades</label>
                                    <textarea class="form-control @error('enfermedades') is-invalid @enderror" id="enfermedades" name="enfermedades"
                                        rows="3">{{ old('enfermedades') }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"
                                        rows="3">{{ old('descripcion') }}</textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('history-records.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const newPatientCheckbox = document.getElementById('newPatient');
                const existingPatientSection = document.getElementById('existingPatientSection');
                const newPatientSection = document.getElementById('newPatientSection');
                const patientSelect = document.getElementById('id_patient');

                function toggleSections() {
                    if (newPatientCheckbox.checked) {
                        existingPatientSection.style.display = 'none';
                        newPatientSection.style.display = 'block';
                        patientSelect.removeAttribute('required');
                    } else {
                        existingPatientSection.style.display = 'block';
                        newPatientSection.style.display = 'none';
                        patientSelect.setAttribute('required', 'required');
                    }
                }

                newPatientCheckbox.addEventListener('change', toggleSections);
                toggleSections();
            });
        </script>
    @endpush
@endsection
