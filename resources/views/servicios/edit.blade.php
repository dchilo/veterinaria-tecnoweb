@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-2" style="margin-right: 6px; position: relative; ">
            <div class="col-xl-3 col-sm-4 " style="width: 21.5rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-1 align-content-center">
                                <a href="{{ route('servicios.index') }}" class="text-decoration-none">
                                    <div class="icon text-center border-radius-md icon-sm" style="padding-right: 6px;">
                                        <i class="fas fa-arrow-left text-xs opacity-10 mt-2" aria-hidden="true"
                                            style="color: #495057; margin: 0 auto;"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-7">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Editar Servicio
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fas fa-wrench text-xs opacity-10" aria-hidden="true"
                                        style="color: #ffff;"></i>
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
                        {{ $servicio->nombre }}
                    </h5>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4 px-0">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Información del Servicio</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" role="form text-left">
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
                                    <label for="servicio-nombre" class="form-control-label">Nombre del Servicio</label>
                                    <div class="@error('nombre') border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $servicio->nombre }}" type="text"
                                            placeholder="Nombre" id="servicio-nombre" name="nombre" required>
                                        @error('nombre')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="servicio-descripcion" class="form-control-label">Descripción</label>
                                    <div class="@error('descripcion') border border-danger rounded-3 @enderror">

                                        <input class="form-control" value="{{ $servicio->descripcion }}" type="text"
                                            placeholder="Descripción" id="servicio-descripcion" name="descripcion" required>
                                        @error('descripcion')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="servicio-precio" class="form-control-label">Precio Bs.</label>
                                    <div class="@error('precio') border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $servicio->precio }}" type="number"
                                            step="0.01" placeholder="Precio" id="servicio-precio" name="precio" required>
                                        @error('precio')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Otros campos según sea necesario -->
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn bg-gradient-dark w-12 my-4 mb-2">Actualizar</button>
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
            $('#servicio-precio').on('input', function() {
                // Reemplaza las comas por puntos
                this.value = this.value.replace(',', '.');
            });

            $('#servicio-precio').on('blur', function() {
                // Asegúrate de que el valor sea un número decimal
                var precio = parseFloat(this.value);
                if (isNaN(precio)) {
                    this.setCustomValidity('Por favor ingrese un precio válido');
                } else {
                    this.setCustomValidity('');
                    this.value = precio.toFixed(2);
                }
            });
        });
    </script>
@endsection
