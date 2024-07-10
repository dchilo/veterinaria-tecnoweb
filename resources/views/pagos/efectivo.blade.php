@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 px-0">
        <div class="row">
            <!-- Información de la cita -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Información de Cita</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <!-- ... Resto de tu contenido ... -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cita-cliente" class="form-control-label">Cliente</label>
                                    <div class="@error('cita.cliente_id')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Cliente" id="cita-cliente"
                                            name="cliente_id" value="{{ $cita->cliente->name }}" readonly>
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
                                        <input class="form-control" type="text" placeholder="Motorizado"
                                            id="cita-motorizado" name="motorizado_id" value="{{ $cita->motorizado->marca }}"
                                            readonly>
                                        @error('motorizado_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cita-fecha-hora" class="form-control-label">Fecha y Hora</label>
                                    <div class="@error('cita.fecha_hora')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="datetime-local" id="cita-fecha-hora"
                                            name="fecha_hora" value="{{ $cita->fecha_hora }}" readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cita-monto-total" class="form-control-label">Monto Total Bs.</label>
                                    <div class="@error('cita.monto_total')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Monto Total"
                                            id="cita-monto-total" name="monto_total" value="{{ $cita->monto_total }}"
                                            readonly>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-5">
                                <!-- Servicios -->
                                <div class="card">
                                    <div class="card-header pb-0 px-3">
                                        <h6 class="mb-0">Servicios</h6>
                                    </div>
                                    <div class="border rounded-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Nombre</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cita->servicios as $servicio)
                                                    <tr>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $servicio->nombre }}
                                                            </p>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $servicio->precio }}
                                                            </p>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <!-- Insumos -->
                                <div class="card">
                                    <div class="card-header pb-0 px-3">
                                        <h6 class="mb-0">Insumos</h6>
                                    </div>
                                    <div class="border rounded-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Nombre</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Cantidad</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Precio Unitario</th>

                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Total</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cita->insumos as $insumo)
                                                    <tr>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $insumo->nombre }}
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $insumo->pivot->cantidad }}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $insumo->precio }}
                                                            </p>
                                                        </td>

                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $insumo->pivot->cantidad * $insumo->precio }}</p>


                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('pagos.index') }}" class="btn btn-primary">Finalizar</a>
                    </div>
                </div>
            </div>
            

            <!-- Código QR -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Pago en Efectivo</h6>
                    </div>
                    <div class="card-body pt-4 p-3 text-center">
                        <!-- Agrega el mensaje de pago en efectivo -->
                        <p>Estás realizando este pago con efectivo.</p>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <!-- CONTADOR DE PAGINA LOGIN -->
        <div id="contador">
            <div class="card">
                <div class="card-body p-2">
                    <h6 class="card-title m-0">Contador de visitas</h6>
                    <p class="card-text m-0">Esta página ha sido visitada <span
                            class="badge bg-primary">{{ $pagina->contador }}</span> veces</p>
                </div>
            </div>
        </div>
    </div>
@endsection
