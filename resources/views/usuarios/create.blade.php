@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-2" style="margin-right: 6px; position: relative;">
            <div class="col-xl-3 col-sm-4" style="width: 19rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-1 align-content-center">
                                <a href="{{ route('usuarios.index') }}" class="text-decoration-none">
                                    <div class="icon text-center border-radius-md icon-sm" style="padding-right: 6px;">
                                        <i class="fas fa-arrow-left text-xs opacity-10 mt-2" aria-hidden="true"
                                            style="color: #495057; margin: 0 auto;"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-7">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Crear Usuario
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fas fa-user text-xs opacity-10" aria-hidden="true" style="color: #ffff;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4 px-0">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Información de Perfil</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ route('usuarios.store') }}" method="POST" role="form text-left">
                        @csrf

                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="m-3  alert alert-info alert-dismissible fade show" id="myAlert1" role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">Nombre Completo</label>
                                    <div class="@error('name') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Nombre" id="user-name"
                                            name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                    <div class="@error('email') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="email" placeholder="@example.com"
                                            id="user-email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-phone" class="form-control-label">Celular</label>
                                    <div class="@error('phone') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="tel" placeholder="40770888444" id="user-phone"
                                            name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-password" class="form-control-label">Contraseña</label>
                                    <div class="@error('password') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="password" placeholder="Contraseña"
                                            id="user-password" name="password" required minlength="8">
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-phone" class="form-control-label">Tipo Usuario</label>
                                    <div class="@error('tipo_usuario') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="tipo_usuario" id="tipo_usuario" required>
                                            <option value="">Seleccione</option>
                                            <option value="Cliente">Cliente</option>
                                            <option value="Administrador">Administrador</option>
                                        </select>
                                        @error('tipo_usuario')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>

                            <div class="text-left">
                                <button type="submit" class="btn bg-gradient-dark w-12 my-4 mb-2">Crear</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- CONTADOR DE PAGINA LOGIN -->
        <div id="contador" c>
            <div class="card">
                <div class="card-body p-2">
                    <h6 class="card-title m-0">Contador de visitas</h6>
                    <p class="card-text m-0">Esta página ha sido visitada <span
                            class="badge bg-primary">{{ $pagina->contador }}</span> veces</p>
                </div>
            </div>
        </div>
    </div>

    </div>
    <style>
        #contador {
            position: relative;
            font-size: 14px;
            opacity: 0.8;
            /* Agrega esta línea para moverlo a la derecha */
        }

        #contador .card {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 25rem;
            margin-top: 1rem;
            margin-left: auto;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#user-name').on('input', function() {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
        });
        $(document).ready(function() {
            $('#user-phone').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });



        $(document).ready(function() {
            $('#user-email').on('input', function() {
                var email = this.value;
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if (!emailReg.test(email)) {
                    this.setCustomValidity('Por favor ingrese un correo válido');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    </script>
@endsection
