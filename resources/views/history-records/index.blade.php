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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#recordsTable').DataTable({
                    
                });
            });
        </script>
    @endpush
@endsection
