@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-12">
                <h3>Información del Paciente</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Cédula:</div>
                                <div class="col-md-8">{{ $patient->ci }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Nombre:</div>
                                <div class="col-md-8">{{ $patient->nombre }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Apellido:</div>
                                <div class="col-md-8">{{ $patient->apellido }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Edad:</div>
                                <div class="col-md-8">{{ $patient->edad }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Sexo:</div>
                                <div class="col-md-8">{{ $patient->sexo }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Peso:</div>
                                <div class="col-md-8">{{ $patient->peso }} kg</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Nacionalidad:</div>
                                <div class="col-md-8">{{ $patient->nacionalidad }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Ocupación:</div>
                                <div class="col-md-8">{{ $patient->ocupacion ?: 'No especificada' }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Representante:</div>
                                <div class="col-md-8">{{ $patient->representante }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Teléfono:</div>
                                <div class="col-md-8">{{ $patient->telefono }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Estado:</div>
                                <div class="col-md-8">{{ $patient->state->state }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Ciudad:</div>
                                <div class="col-md-8">{{ $patient->city->city }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Municipio:</div>
                                <div class="col-md-8">{{ $patient->municipality->municipality }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Parroquia:</div>
                                <div class="col-md-8">{{ $patient->parish->parish }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Dirección:</div>
                                <div class="col-md-8">{{ $patient->direccion }}</div>
                            </div>

                            @if ($patient->sexo == 'Femenino')
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Embarazo:</div>
                                    <div class="col-md-8">{{ $patient->embarazo ? 'Sí' : 'No' }}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Madre Lactante:</div>
                                    <div class="col-md-8">{{ $patient->madre_lactante ? 'Sí' : 'No' }}</div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Volver</a>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editPatientModal">
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
    <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editPatientModalLabel">Editar Paciente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ old('nombre', $patient->nombre) }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                                        id="apellido" name="apellido" value="{{ old('apellido', $patient->apellido) }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="ci" class="form-label">Cédula</label>
                                    <input type="number" class="form-control @error('ci') is-invalid @enderror"
                                        id="ci" name="ci" value="{{ old('ci', $patient->ci) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="edad" class="form-label">Edad</label>
                                    <input type="number" class="form-control @error('edad') is-invalid @enderror"
                                        id="edad" name="edad" value="{{ old('edad', $patient->edad) }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select class="form-select @error('sexo') is-invalid @enderror" id="sexo"
                                        name="sexo" required>
                                        <option value="Masculino"
                                            {{ old('sexo', $patient->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino
                                        </option>
                                        <option value="Femenino"
                                            {{ old('sexo', $patient->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="peso" class="form-label">Peso (kg)</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('peso') is-invalid @enderror" id="peso"
                                        name="peso" value="{{ old('peso', $patient->peso) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                    <select class="form-select @error('nacionalidad') is-invalid @enderror"
                                        id="nacionalidad" name="nacionalidad" required>
                                        <option value="Venezolano"
                                            {{ old('nacionalidad', $patient->nacionalidad) == 'Venezolano' ? 'selected' : '' }}>
                                            Venezolano</option>
                                        <option value="Extranjero"
                                            {{ old('nacionalidad', $patient->nacionalidad) == 'Extranjero' ? 'selected' : '' }}>
                                            Extranjero</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="ocupacion" class="form-label">Ocupación</label>
                                    <input type="text" class="form-control @error('ocupacion') is-invalid @enderror"
                                        id="ocupacion" name="ocupacion"
                                        value="{{ old('ocupacion', $patient->ocupacion) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="representante" class="form-label">Representante</label>
                                    <input type="text"
                                        class="form-control @error('representante') is-invalid @enderror"
                                        id="representante" name="representante"
                                        value="{{ old('representante', $patient->representante) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="number" class="form-control @error('telefono') is-invalid @enderror"
                                        id="telefono" name="telefono" value="{{ old('telefono', $patient->telefono) }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="female-options" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="embarazo" name="embarazo"
                                        value="1" {{ old('embarazo', $patient->embarazo) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="embarazo">
                                        Embarazo
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="madre_lactante"
                                        name="madre_lactante" value="1"
                                        {{ old('madre_lactante', $patient->madre_lactante) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="madre_lactante">
                                        Madre Lactante
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion"
                                rows="3" required>{{ old('direccion', $patient->direccion) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_state" class="form-label">Estado</label>
                                    <select class="form-select @error('id_state') is-invalid @enderror" id="id_state"
                                        name="id_state" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ old('id_state', $patient->id_state) == $state->id ? 'selected' : '' }}>
                                                {{ $state->state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_city" class="form-label">Ciudad</label>
                                    <select class="form-select @error('id_city') is-invalid @enderror" id="id_city"
                                        name="id_city" required>
                                        <option value="">Seleccione estado primero</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_municipality" class="form-label">Municipio</label>
                                    <select class="form-select @error('id_municipality') is-invalid @enderror"
                                        id="id_municipality" name="id_municipality" required>
                                        <option value="">Seleccione estado primero</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_parish" class="form-label">Parroquia</label>
                                    <select class="form-select @error('id_parish') is-invalid @enderror" id="id_parish"
                                        name="id_parish" required>
                                        <option value="">Seleccione municipio primero</option>
                                    </select>
                                </div>
                            </div>
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
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Control de campos femeninos
                const toggleFemaleOptions = () => {
                    const isFemale = $('#sexo').val() === 'Femenino';
                    $('#female-options').toggle(isFemale);
                };
                $('#sexo').change(toggleFemaleOptions);
                toggleFemaleOptions();

                // Carga inicial de datos geográficos
                const initialData = @json($patient);
                const loadInitialData = () => {
                    if (initialData.id_state) {
                        loadCities(initialData.id_state, initialData.id_city);
                        loadMunicipalities(initialData.id_state, initialData.id_municipality);
                    }
                    if (initialData.id_municipality) {
                        loadParishes(initialData.id_municipality, initialData.id_parish);
                    }
                };

                // Manejo de selects geográficos
                $('#id_state').change(function() {
                    const stateId = $(this).val();
                    loadCities(stateId);
                    loadMunicipalities(stateId);
                });

                $('#id_municipality').change(function() {
                    const municipalityId = $(this).val();
                    loadParishes(municipalityId);
                });

                // Funciones AJAX
                function loadCities(stateId, selectedId = null) {
                    if (stateId) {
                        $('#id_city').html('<option value="">Cargando...</option>');
                        $.getJSON(`/cities/${stateId}`, function(data) {
                            let options = '<option value="">Seleccione ciudad</option>';
                            data.forEach(city => {
                                options +=
                                    `<option value="${city.id}" ${city.id == selectedId ? 'selected' : ''}>${city.city}</option>`;
                            });
                            $('#id_city').html(options);
                        });
                    }
                }

                function loadMunicipalities(stateId, selectedId = null) {
                    if (stateId) {
                        $('#id_municipality').html('<option value="">Cargando...</option>');
                        $.getJSON(`/municipalities/${stateId}`, function(data) {
                            let options = '<option value="">Seleccione municipio</option>';
                            data.forEach(municipality => {
                                options +=
                                    `<option value="${municipality.id}" ${municipality.id == selectedId ? 'selected' : ''}>${municipality.municipality}</option>`;
                            });
                            $('#id_municipality').html(options);
                        });
                    }
                }

                function loadParishes(municipalityId, selectedId = null) {
                    if (municipalityId) {
                        $('#id_parish').html('<option value="">Cargando...</option>');
                        $.getJSON(`/parishes/${municipalityId}`, function(data) {
                            let options = '<option value="">Seleccione parroquia</option>';
                            data.forEach(parish => {
                                const selected = parish.id == selectedId ? 'selected' : '';
                                options +=
                                    `<option value="${parish.id}" ${selected}>${parish.parish}</option>`;
                            });
                            $('#id_parish').html(options);
                        });
                    }
                }

                // Cargar datos iniciales al abrir el modal
                const loadInitialData = () => {
                    if (initialData.id_state) {
                        loadCities(initialData.id_state, initialData.id_city);
                        loadMunicipalities(initialData.id_state, initialData.id_municipality);
                    }
                    if (initialData.id_municipality) {
                        loadParishes(initialData.id_municipality, initialData.id_parish);
                    }
                };

                // Manejar cambios en el estado
                $('#id_state').on('change', function() {
                    const stateId = $(this).val();
                    loadCities(stateId);
                    loadMunicipalities(stateId);
                    $('#id_parish').html('<option value="">Seleccione municipio primero</option>');
                });

                // Manejar cambios en el municipio
                $('#id_municipality').on('change', function() {
                    const municipalityId = $(this).val();
                    loadParishes(municipalityId);
                });

                // Inicializar
                loadInitialData();
                toggleFemaleOptions();

                // Mostrar modal si hay errores y recargar datos
                @if ($errors->any())
                    $(document).ready(function() {
                        const editModal = new bootstrap.Modal(document.getElementById('editPatientModal'));
                        editModal.show();

                        // Recargar selects con valores de validación
                        const stateId = $('#id_state').val();
                        if (stateId) {
                            loadCities(stateId, {{ old('id_city', $patient->id_city) }});
                            loadMunicipalities(stateId,
                                {{ old('id_municipality', $patient->id_municipality) }});
                        }
                        const municipalityId = $('#id_municipality').val();
                        if (municipalityId) {
                            loadParishes(municipalityId, {{ old('id_parish', $patient->id_parish) }});
                        }
                    });
                @endif
            });
        </script>
    @endpush
@endsection
