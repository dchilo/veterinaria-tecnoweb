@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-2" style="margin-right: 6px; position: relative; ">
            <div class="col-xl-3 col-sm-4 " style="width: 25rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-1 align-content-center">
                                <a href="{{ route('motorizados.index') }}" class="text-decoration-none">
                                    <div class="icon text-center border-radius-md icon-sm" style="padding-right: 6px;">
                                        <i class="fas fa-arrow-left text-xs opacity-10 mt-2" aria-hidden="true"
                                            style="color: #495057; margin: 0 auto;"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-7">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Editar Motorizado
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fas fa-car text-xs opacity-10" aria-hidden="true" style="color: #ffff;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body blur shadow-blur mx-0 mt-3 text-center d-flex align-items-center">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <h5 class="mb-1">
                        {{ $motorizado->marca }} {{ $motorizado->modelo }}
                    </h5>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="m-3  alert alert-info alert-dismissible fade show" id="myAlert1" role="alert">
                <span class="alert-text text-white">
                    {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
        @endif

        <div class="container-fluid py-4 px-0">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Información de Motorizado</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ route('motorizados.update', $motorizado->id) }}" method="POST" role="form text-left">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="motorizado-cliente" class="form-control-label">Cliente</label>
                                    <div class="@error('motorizado.cliente_id')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="motorizado-cliente" name="cliente_id" required>
                                            @foreach ($usuarios as $usuario)
                                                <option value="{{ $usuario->id }}"
                                                    {{ $motorizado->cliente_id == $usuario->id ? 'selected' : '' }}>
                                                    {{ $usuario->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cliente_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="motorizado-marca" class="form-control-label">Marca</label>
                                    <div class="@error('motorizado.marca')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Marca" id="motorizado-marca"
                                            name="marca" value="{{ old('marca', $motorizado->marca) }}" required>
                                        @error('marca')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="motorizado-modelo" class="form-control-label">Modelo</label>
                                    <div class="@error('motorizado.modelo')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Modelo"
                                            id="motorizado-modelo" name="modelo"
                                            value="{{ old('modelo', $motorizado->modelo) }}" required>
                                        @error('modelo')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="motorizado-anio" class="form-control-label">Año</label>
                                    <div class="@error('motorizado.anio')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="number" placeholder="Año" id="motorizado-anio"
                                            value="{{ old('anio', $motorizado->anio) }}" name="anio" min="1885"
                                            max="9999" required>
                                        @error('anio')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="motorizado-placa" class="form-control-label">Placa</label>
                                    <div class="@error('motorizado.placa')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Placa"
                                            id="motorizado-placa" name="placa"
                                            value="{{ old('placa', $motorizado->placa) }}" required>
                                        @error('placa')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            @if (Auth::user()->tipo_usuario == 'Administrador' || Auth::user()->tipo_usuario == 'Técnico')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="motorizado-estado" class="form-control-label">Estado</label>
                                        <div class="@error('motorizado.estado')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="motorizado-estado" name="estado" required>
                                                <option value="Activo"
                                                    {{ $motorizado->estado == 'Activo' ? 'selected' : '' }}>Activo
                                                </option>
                                                <option value="Inactivo"
                                                    {{ $motorizado->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo
                                                </option>
                                            </select>
                                            @error('estado')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="motorizado-estado" class="form-control-label" hidden>Estado</label>
                                    <div class="@error('motorizado.estado')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Estado"
                                            id="motorizado-estado" name="estado"
                                            value="{{ old('estado', $motorizado->estado) }}"  hidden>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn bg-gradient-dark w-12 my-4 mb-2">Guardar</button>
                        </div>

                    </form>
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
        var alertElement = document.getElementById("myAlert1");
        setTimeout(function() {
            alertElement.style.display = "none";
        }, 2000);

        $(document).ready(function() {
            $('#motorizado-anio').on('change', function() {
                // Validar si el valor es un número
                var ano = parseInt(this.value, 10);

                if (isNaN(ano)) {
                    this.setCustomValidity('Por favor ingrese un año válido');
                    return;
                }
                $actual = new Date().getFullYear();
                // Limitar el valor al rango establecido en el campo de entrada numérica
                this.value = Math.min(Math.max(ano, 1885), $actual);
                this.setCustomValidity('');
            });
        });
    </script>
@endsection
