@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-4" style="margin-right: 8px; position: relative;">
            <div class="col-xl-3 col-sm-4 " style="width: 12.5rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Pagos
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fa fa-dollar-sign text-xs opacity-10" aria-hidden="true"
                                        style="color: #ffff;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-3" style="position: absolute; top: 8px; right: 0;">
                <a href="{{ route('pagos.generatePDF') }}" class="btn bg-gradient-dark btn-md">Generar PDF</a>
            </div>
        </div>

        @if (session('success'))
            <div class="m-3 alert alert-info alert-dismissible fade show" id="myAlert1" role="alert">
                <span class="alert-text text-white">
                    {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
        @endif

        <div class="row mb-10">
            <div class="col-12">
                <div class="card mb-4 mx-0">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body" style="padding: 1rem">
                        <div class="table-responsive p-0">
                            <table id="pagosTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Venta ID
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Cliente
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Monto
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fecha de Pago
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Método de Pago
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($pagos as $pago)

                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $pago->id }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $pago->venta_id }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $pago->venta->usuario->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $pago->monto }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($pago->fecha)->format('d-m-Y') }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $pago->metodo_pago }}</p>
                                            </td>
                                            <td class=" text-center">
                                                <form action="{{ route('pagos.destroy', $pago) }}" method="post">
                                                    @method('delete')
                                                    @csrf

                                                    <a href="{{ route('pagos.show', $pago->id) }}" class="text-white"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Ver pago">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                    @if(Auth::user()->tipo_usuario == 'Administrador')
                                                    <button type="submit" class="cursor-pointer"
                                                        style="border: none; background: none;"
                                                        onclick="return confirm('¿Está seguro de que desea borrar este pago?');">
                                                        <i class="fas fa-trash text-secondary"></i>
                                                    </button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contador" c>
                <div class="card">
                    <div class="card-body p-2">
                        <h6 class="card-title m-0">Contador de visitas</h6>
                        <p class="card-text m-0">Esta página ha sido visitada <span class="badge bg-primary">{{ $pagina->contador }}</span> veces</p>
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
        }

        #contador .card {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 25rem;
            margin-top: 1rem;
            margin-left: auto.
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"></script>
    <script>
        $(document).ready(function() {
            $('#pagosTable').DataTable({
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
                }
            });
        });
    </script>
@endsection
