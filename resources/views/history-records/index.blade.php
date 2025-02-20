@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Historias Médicas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first text-end mb-3">
                <a href="{{ route('history-records.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Nueva Historia Médica
                </a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table table-striped" id="recordsTable">
                    <thead>
                        <tr>
                            <th>Nº Historia</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Tipo de Sangre</th>
                            <th>Último Examen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{ $record->numero_historia }}</td>
                                <td>{{ $record->patient->nombre }} {{ $record->patient->apellido }}</td>
                                <td>{{ $record->doctor->nombre }} {{ $record->doctor->apellido }}</td>
                                <td>{{ $record->tipo_samgre }}</td>
                                <td>{{ $record->fecha_ultimo_examen_fisico ? $record->fecha_ultimo_examen_fisico->format('d/m/Y') : 'No registrado' }}
                                </td>
                                <td>
                                    <a href="{{ route('history-records.show', $record->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#recordsTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                            text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                            className: 'btn btn-success btn-sm',
                            exportOptions: {
                                columns: [0,1,2,3,4] // Excluye las columnas ID (0) y Acciones (6)
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                            className: 'btn btn-danger btn-sm',
                            exportOptions: {
                                columns: [0,1,2,3,4]
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="bi bi-printer"></i> Imprimir',
                            className: 'btn btn-info btn-sm',
                            exportOptions: {
                                columns: [0,1,2,3,4]
                            }
                        }
                    ],
                });
            });
        </script>
    @endpush
@endsection
