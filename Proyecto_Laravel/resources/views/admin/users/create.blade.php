<<<<<<< HEAD
{{-- 
    Vista de Crear Usuario
    ======================
    Formulario para crear un nuevo usuario con:
    - Nombre (requerido, máx 255 caracteres)
    - Email (requerido, válido, único)
    - Contraseña (requerida, mín 8 caracteres, confirmación)
    
    Validaciones en cliente: @error() muestra mensajes de validación
    Validaciones en servidor: se realizan en UserController@store()
--}}
@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1>Crear Nuevo Usuario</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de creación</h3>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="card-body">
                        <!-- Campo Nombre -->
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Ingrese el nombre del usuario"
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Email -->
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       placeholder="Ingrese el email"
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Contraseña -->
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Ingrese la contraseña (mínimo 8 caracteres)"
                                       required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Confirmar Contraseña -->
                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-2 control-label">Confirmar Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" 
                                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Confirme la contraseña"
                                       required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Crear Usuario</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default float-right">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .form-group label {
            font-weight: 600;
        }
        .invalid-feedback {
            display: block;
            color: #dc3545;
            margin-top: 0.25rem;
        }
    </style>
@stop

@section('js')
    <script>
        // Validación en cliente (opcional, Bootstrap valida en servidor)
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });
    </script>
@stop
=======
@extends('adminlte::page')


@section('title', 'Crear Usuario')


@section('content_header')
    <h1>Crear Usuario</h1>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf


                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>


                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>


                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>


                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-success">Crear Usuario</button>
                    <a href="" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

>>>>>>> main
