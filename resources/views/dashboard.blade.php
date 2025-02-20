@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Tablero ->
                <small>Panel de Control</small>
            </h1>
        </section>
        <section class="content">
            <div class="card">
                <br>
                <div class="row">
                    <div class="col-md-12">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $pacientes }}</h3>
                                <p>Pacientes Registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
