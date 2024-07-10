@extends('layouts.user_type.auth')

@section('content')
    <div>

        <div class="d-flex justify-content-between mb-4" style="margin-right: 8px; position: relative;">
            <div class="col-xl-3 col-sm-4 " style="width: 15.5rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Citas
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
            <div class="mt-4 mb-3" style="position: absolute; top: 8px; right: 0;">
                @if (auth()->user()->tipo_usuario == 'Administrador' || auth()->user()->tipo_usuario == 'Cliente')
                    <a href="{{ route('citas.create') }}" class="btn bg-gradient-dark btn-md">Nuevo</a>
                @endif
                <a href="{{ route('citas.generatePDF') }}" class="btn bg-gradient-dark btn-md">PDF</a>
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

        <div class="row mb-10">
            <div class="col-12">
                <div class="card mb-4 mx-0">
                    <div class="card-header pb-0">

                    </div>
                    <div class="card-body pb-2" style="padding: 0.8rem">
                        <div class="table-responsive p-0">
                            <table id="citasTable" class="table align-items-center ">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <div>ID </div>
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <div>Cliente </div>
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <div>Motorizado </div>
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <div>Fecha y Hora </div>
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <div>Estado </div>
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($citas as $cita)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $cita->id }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $cita->cliente->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $cita->motorizado->marca }}
                                                    {{ $cita->motorizado->modelo }} {{ $cita->motorizado->placa }}
                                                </p>
                                            </td>
                                            <td class="text-center">


                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d-m-Y H:i A') }}

                                                </p>


                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $cita->estado }}</p>
                                            </td>
                                            @if (auth()->user()->tipo_usuario == 'Cliente')
                                                | <td class=" text-center">
                                                    <a href="{{ route('citas.show', $cita->id) }}" class="text-white"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Ver cita">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                </td>
                                            @endif


                                            @if (auth()->user()->tipo_usuario == 'Administrador' || auth()->user()->tipo_usuario == 'Técnico')
                                                <td class=" text-center">
                                                    @if ($cita->estado == 'Completada')
                                                        <i class="far fa-check-circle text-secondary"></i>
                                                    @endif
                                                    @if ($cita->estado != 'Completada')
                                                        <form action="{{ route('citas.destroy', $cita) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            @if ($cita->estado != 'Pendiente' && $cita->estado != 'Completada')
                                                                @if ($cita->monto_total != 0)
                                                                    <a href="#" data-id="{{ $cita->id }}"
                                                                        class="text-white open-modal"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Pagar"
                                                                        style="margin-right: 6px">
                                                                        <i
                                                                            class="fas fa-money-check-alt text-secondary"></i>
                                                                    </a>
                                                                @else
                                                                    <a class="text-white" data-bs-toggle="tooltip"
                                                                        data-bs-original-title="No cumple con el monto mínimo"
                                                                        style="margin-right: 6px">
                                                                        <i
                                                                            class="fas fa-money-check-alt text-secondary"></i>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            @if ($cita->estado == 'Pendiente')
                                                                <a href="{{ route('citas.edit', $cita->id) }}"
                                                                    class="text-white" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Editar cita"
                                                                    onclick="return confirm('La cita pasaría a estado: En proceso, ¿Está seguro de que desea editar esta cita?');">
                                                                    <i class="fas fa-pencil-alt text-secondary"></i>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('citas.edit', $cita->id) }}"
                                                                    class="text-white" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Editar cita">
                                                                    <i class="fas fa-pencil-alt text-secondary"></i>
                                                                </a>
                                                            @endif
                                                            <button type="submit" class="cursor-pointer"
                                                                style="border: none; background: none;"
                                                                onclick="return confirm('¿Está seguro de que desea borrar esta cita?');">
                                                                <i class="fas fa-trash text-secondary"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Confirmar Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="cita_id" id="cita_id">
                    <p  class="text-center" style="color:black !important">¿Con que metodo de pago desea pagar?</p>
                    <select name="metodo_pago" id="metodo_pago" style="background-color: #ffff !important; display: block; margin: auto;">
                        <option value="QR">QR</option>
                        <option value="Efectivo">Efectivo</option>
                        <!-- Agrega tus métodos de pago aquí -->
                    </select>
                      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Pagar</button>
                </div>
            </form>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables CSS y JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js">
    </script>

    <!-- Idioma DataTables en español -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"></script>

    <!-- Tu script DataTables -->
    <script>
        $(document).ready(function() {
            // DataTable initialization with responsive option and Spanish language
            $('#citasTable').DataTable({
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
                }
            });
        });

        $(document).ready(function() {
            $('.open-modal').click(function(e) {
                e.preventDefault();
                var citaId = $(this).data('id');
                $('#cita_id').val(citaId);
                $('#paymentModal form').attr('action', '/inf513/grupo07sc/proyecto2/public/pagos/' + citaId + '/pagos');
                $('#paymentModal').modal('show');
            });
        });
    </script>
@endsection
