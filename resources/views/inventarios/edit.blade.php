@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-2" style="margin-right: 6px; position: relative;">
            <div class="col-xl-3 col-sm-4" style="width: 19rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-1 align-content-center">
                                <a href="{{ route('inventarios.index') }}" class="text-decoration-none">
                                    <div class="icon text-center border-radius-md icon-sm" style="padding-right: 6px;">
                                        <i class="fas fa-arrow-left text-xs opacity-10 mt-2" aria-hidden="true"
                                            style="color: #495057; margin: 0 auto;"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-7">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Editar Inventario
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fas fa-warehouse text-xs opacity-10" aria-hidden="true" style="color: #ffff;"></i>
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
                    <h6 class="mb-0">Información del Inventario</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ route('inventarios.update', $inventario->id) }}" method="POST" role="form text-left">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">{{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="m-3 alert alert-info alert-dismissible fade show" id="myAlert1" role="alert">
                                <span class="alert-text text-white">{{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="producto-id" class="form-control-label">Producto</label>
                                    <div class="@error('producto_id') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="producto_id" id="producto-id" required>
                                            <option value="">Seleccione un producto</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}" {{ $producto->id == $inventario->producto_id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('producto_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cantidad" class="form-control-label">Cantidad</label>
                                    <div class="@error('cantidad') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="number" placeholder="Cantidad" id="cantidad"
                                            name="cantidad" value="{{ old('cantidad', $inventario->cantidad) }}" required>
                                        @error('cantidad')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_movimiento" class="form-control-label">Tipo de Movimiento</label>
                                    <div class="@error('tipo_movimiento') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="tipo_movimiento" id="tipo_movimiento" required>
                                            <option value="">Seleccione el tipo de movimiento</option>
                                            <option value="Entrada" {{ $inventario->tipo_movimiento == 'Entrada' ? 'selected' : '' }}>Entrada</option>
                                            <option value="Salida" {{ $inventario->tipo_movimiento == 'Salida' ? 'selected' : '' }}>Salida</option>
                                        </select>
                                        @error('tipo_movimiento')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_movimiento" class="form-control-label">Fecha del Movimiento</label>
                                    <div class="@error('fecha_movimiento') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="date" id="fecha_movimiento" name="fecha_movimiento"
                                            value="{{ old('fecha_movimiento', $inventario->fecha_movimiento) }}" required>
                                        @error('fecha_movimiento')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn bg-gradient-dark w-12 my-4 mb-2">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- CONTADOR DE PAGINA -->
        <div id="contador">
            <div class="card">
                <div class="card-body p-2">
                    <h6 class="card-title m-0">Contador de visitas</h6>
                    <p class="card-text m-0">Esta página ha sido visitada <span class="badge bg-primary">{{ $pagina->contador }}</span> veces</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        #contador {
            position: relative;
            font-size: 14px;
            opacity: 0.8;
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
    </script>
@endsection
