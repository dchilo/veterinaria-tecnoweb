@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-2" style="margin-right: 6px; position: relative; ">
            <div class="col-xl-3 col-sm-4 " style="width: 22rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-1 align-content-center">
                                <a href="{{ route('citas.index') }}" class="text-decoration-none">
                                    <div class="icon text-center border-radius-md icon-sm text-secondary"
                                        style="padding-right: 6px;">
                                        <i class="fas fa-arrow-left text-xs opacity-10 mt-2" aria-hidden="true"
                                            style="margin: 0 auto;"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-7">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Nueva Cita
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fas fa-info text-xs opacity-10" aria-hidden="true" style="color: #ffff;"></i>
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
                        Nueva Cita
                    </h5>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4 px-0">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Información de Cita</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ route('citas.store') }}" method="POST" role="form text-left">
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
                        @if (auth()->user()->tipo_usuario == 'Administrador')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cita-cliente" class="form-control-label">Cliente</label>
                                        <div class="@error('cita.cliente_id')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="cita-cliente" name="cliente_id"
                                                onchange="actualizarMotorizados()" required>
                                                <option value="" disabled selected>Seleccione un cliente</option>
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
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
                                        <label for="cita-motorizado" class="form-control-label">Motorizado</label>
                                        <div class="@error('cita.motorizado_id')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="cita-motorizado" name="motorizado_id" required>
                                                <!-- Las opciones de motorizado se actualizarán dinámicamente aquí -->
                                                <option value="">Seleccione un cliente</option>
                                            </select>
                                            @error('motorizado_id')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                            @if (auth()->user()->tipo_usuario == 'Cliente')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cita-cliente" class="form-control-label">Cliente</label>
                                    <div class="@error('cita.cliente_id')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="cita-cliente" name="cliente_id"
                                             required>
                                            <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                            
                                        </select>
                                        @error('cliente_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cita-motorizado" class="form-control-label">Motorizado</label>
                                    <div class="@error('cita.motorizado_id')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="cita-motorizado" name="motorizado_id" required>
                                            @foreach ($motorizados as $motorizado)
                                                @if($motorizado->cliente_id == auth()->user()->id)
                                                    <option value="{{ $motorizado->id }}">
                                                        {{ $motorizado->marca }} {{ $motorizado->modelo }}
                                                        {{ $motorizado->placa }}
                                                    </option>
                                                @endif
                                                @endforeach
                                        </select>
                                        @error('motorizado_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cita-fecha-hora" class="form-control-label">Fecha y Hora</label>
                                    <div class="@error('cita.fecha_hora')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="datetime-local" id="cita-fecha-hora"
                                            name="fecha_hora" required>
                                        @error('fecha_hora')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cita-monto-total" class="form-control-label">Monto Total</label>
                                    <div class="@error('cita.monto_total')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Monto Total"
                                            id="cita-monto-total" name="monto_total" value="0" readonly>
                                        @error('monto_total')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6" hidden>
                                <div class="form-group">
                                    {{-- <label for="cita-estado" class="form-control-label">Estado</label> --}}
                                    <div class="@error('cita.estado')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Estado"
                                            value="Pendiente" id="cita-estado" name="estado" hidden>
                                        @error('estado')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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

        function actualizarMotorizados() {
            // Obtener el elemento select del cliente y motorizado
            var selectCliente = document.getElementById('cita-cliente');
            var selectMotorizado = document.getElementById('cita-motorizado');

            // Limpiar las opciones actuales de motorizado
            selectMotorizado.innerHTML = '';

            // Obtener los motorizados correspondientes al cliente seleccionado
            var motorizados = @json($motorizados);

            // Filtrar los motorizados por el cliente seleccionado
            var motorizadosFiltrados = motorizados.filter(function(motorizado) {
                return motorizado.cliente_id == selectCliente.value;
            });

            // Agregar las nuevas opciones al select de motorizado
            motorizadosFiltrados.forEach(function(motorizado) {
                var option = document.createElement('option');
                option.value = motorizado.id;
                option.text = motorizado.marca + ' ' + motorizado.modelo + ' ' + motorizado.placa;
                selectMotorizado.add(option);
            });
        }
    </script>

    <script>
        document.getElementById('cita-fecha-hora').addEventListener('change', function() {
            var inputDate = new Date(this.value);
            var now = new Date();

            // Elimina los milisegundos de la fecha actual para una comparación justa
            now.setMilliseconds(0);

            if(inputDate < now) {
                alert('La fecha y hora no pueden ser menores a la actual');
                this.value = '';
            } else {
                var hour = inputDate.getHours();
                if(hour < 9 || hour >= 17) {
                    alert('La cita debe ser en horario laboral (9:00 a 17:00)');
                    this.value = '';
                }
            }
        });
    </script>
    
@endsection
