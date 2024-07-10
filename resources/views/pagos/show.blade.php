@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-2" style="margin-right: 6px; position: relative; ">
            <div class="col-xl-3 col-sm-4 " style="width: 22rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-1 align-content-center">
                                <a href="{{ route('pagos.index') }}" class="text-decoration-none">
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
                                        Ver Pago
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fa fa-dollar-sign text-xs opacity-10" aria-hidden="true" style="color: #ffff;"></i>
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
                        Ver Pago #{{ $pago->id }}
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
                    <div>
                        <div>
                            <h6 class="mb-0">Información de Pago </h6>
                        </div>
                        <div>
                            <h6 class="mb-0">Nro de Venta #{{ $venta->id }}</h6>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-right: 2rem; margin-top: 0;margin-bottom: 0">
                            <a href="{{ route('pagos.generateDetallePDF', $pago->id) }}" class="btn btn-primary btn-sm"
                                target="_blank">Generar PDF</a>
                        </div>
                    </div>

                </div>

                <div class="card-body pt-0 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venta-cliente" class="form-control-label">Cliente</label>
                                <div class="@error('venta.cliente_id')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Cliente" id="venta-cliente"
                                        name="cliente_id" value="{{ $cliente->name }}" readonly>
                                    @error('cliente_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venta-fecha" class="form-control-label">Fecha de Pago</label>
                                <div class="@error('venta.fecha')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" id="venta-fecha" name="fecha"
                                        value="{{ \Carbon\Carbon::parse($pago->fecha)->format('d-m-Y') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venta-monto-total" class="form-control-label">Monto Total Bs.</label>
                                <div class="@error('venta.total')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Monto Total"
                                        id="venta-monto-total" name="monto_total" value="{{ $venta->total }}" readonly>
                                    @error('monto_total')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aquí podrías agregar más información si es necesario -->

                </div>
            </div>
            <br>
            <br>
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
@endsection
