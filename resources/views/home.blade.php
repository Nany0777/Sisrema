@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pacientes Totales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pacientes }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Doctores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $doctores }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Historias Médicas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $historias }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTable Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Registros Médicos</h6>
            <div class="date-filters">
                <form class="form-inline">
                    <div class="form-group mx-2">
                        <label for="fecha_inicio" class="mr-2">Desde:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                    </div>
                    <div class="form-group mx-2">
                        <label for="fecha_fin" class="mr-2">Hasta:</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                    </div>
                    <button type="button" class="btn btn-primary" id="filtrar">Filtrar</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Diagnóstico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
<script>
$(document).ready(function() {
    let table = $('#dataTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '{{ route("data") }}',
            data: function(d) {
                d.fecha_inicio = $('#fecha_inicio').val();
                d.fecha_fin = $('#fecha_fin').val();
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'fecha', name: 'fecha'},
            {data: 'patient.name', name: 'patient.name'},
            {data: 'doctor.name', name: 'doctor.name'},
            {data: 'diagnosis', name: 'diagnosis'},
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-sm btn-info" onclick="verDetalle(${row.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="editarRegistro(${row.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                    `;
                }
            }
        ],
        pageLength: 10,
        order: [[1, 'desc']]
    });

    $('#filtrar').click(function() {
        table.ajax.reload();
    });
});

function verDetalle(id) {
    // Implementar lógica para ver detalle
    window.location.href = `/medical-records/${id}`;
}

function editarRegistro(id) {
    // Implementar lógica para editar
    window.location.href = `/medical-records/${id}/edit`;
}
</script>
@endpush
@endsection