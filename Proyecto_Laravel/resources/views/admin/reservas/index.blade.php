{{-- resources/views/admin/reservas/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Reservas Totales')

@section('content_header')
    <h1>Reservas Totales</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Todas las Reservas</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Clase</th>
                            <th>Fecha</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                            <tr>
                                <td>{{ $reserva->id }}</td>
                                <td>{{ $reserva->nombre }}</td>
                                <td>{{ $reserva->email }}</td>
                                <td>{{ $reserva->clase }}</td>
                                <td>{{ $reserva->fecha }}</td>
                                <td>{{ $reserva->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No hay reservas registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <small class="text-muted">Total de reservas: {{ $reservas->count() }}</small>
        </div>
    </div>
@endsection