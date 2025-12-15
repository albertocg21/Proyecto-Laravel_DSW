{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Panel de Administración - GymTime</h1>
@endsection

@section('content')
    {{--
    SECCIÓN DE ESTADÍSTICAS
    Muestra dos tarjetas pequeñas con información clave del sistema:
    - Total de usuarios registrados en la plataforma
    - Total de reservas realizadas
    --}}
    <div class="row">
        <!-- Card: Total de Usuarios -->
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\User::count() }}</h3>
                    <p>Usuarios registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Card: Total de Reservas -->
        <div class="col-lg-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Reserva::count() }}</h3>
                    <p>Reservas totales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('admin.reservas.index') }}" class="small-box-footer">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{--
    SECCIÓN DE CONTENIDO PRINCIPAL
    Contiene dos columnas:
    1. Tabla de últimos usuarios registrados (izquierda)
    2. Panel de bienvenida con información (derecha)
    --}}
    <div class="row">
        <!-- Últimos Usuarios Registrados -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        <i class="fas fa-fw fa-user-plus"></i> Últimos Usuarios Registrados
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- usamos un forelse para no tener que recorrer nosotros mismos el array y comprobar si tiene o no elementos --}}
                                @forelse(\App\Models\User::latest()->limit(5)->get() as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><small>{{ $user->created_at->format('d/m/Y') }}</small></td>
                                    </tr>
                                {{-- lo que hace @empty es mostrar un mensaje en caso de que no haya usuarios en la base de datos --}}
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No hay usuarios</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-info">
                        <i class="fas fa-list"></i> Ver todos los usuarios
                    </a>
                </div>
            </div>
        </div>

        <!-- Panel de Bienvenida -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-fw fa-welcome"></i> Bienvenido a GymTime
                    </h3>
                </div>
                <div class="card-body">
                    <p><strong>¡Hola, {{ auth()->user()->name }}!</strong></p>
                    <p>Bienvenido al panel de administración de <strong>GymTime</strong>. A través de esta plataforma puedes gestionar todos los aspectos de tu gimnasio:</p>
                    <ul class="pl-3">
                        <li><strong>Gestionar usuarios:</strong> Crear, editar y eliminar cuentas de miembros</li>
                        <li><strong>Ver reservas:</strong> Consultar todas las clases y sesiones reservadas</li>
                        <li><strong>Controlar aforo:</strong> Limitar la capacidad de instalaciones por franja horaria</li>
                        <li><strong>Gestionar horarios:</strong> Crear y modificar horarios de disponibilidad</li>
                    </ul>
                    <hr>
                    <p class="text-muted text-sm">
                        <i class="fas fa-clock"></i> Última conexión: {{ now()->format('d/m/Y H:i') }}
                    </p>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-muted">Sistema v1.0 - GymTime © 2025</small>
                </div>
            </div>
        </div>
    </div>

    {{--
    ESTILOS PERSONALIZADOS PARA EL DASHBOARD
    - Animación hover en las tarjetas de estadísticas
    - Efectos visuales para mejorar la experiencia del usuario
    --}}
    <style>
        .small-box {
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 0.5rem;
        }
        .small-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .card-header {
            border-bottom: 2px solid #f4f4f4;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection
