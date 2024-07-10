@extends('layouts.user_type.auth')

@section('content')
<div class="row">
@if(auth()->user()->tipo_usuario == 'Administrador')
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p id="dashkpi" class="text-sm mb-0 text-capitalize font-weight-bold">Usuarios</p>
                            <h5 id="dashkpi" class="font-weight-bolder mb-0">
                                {{ $usuarios }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Gráfico del Historial de Ventas -->
    <div class="col-lg-6 mb-lg-4 mb-4">
        <div class="card z-index-2">
            <div class="card-body p-3">
                <h5 class="mb-3">Historial de Ventas</h5>
                <div class="border-radius-lg py-3 pe-1 mb-3">
                    <div class="chart">
                        <canvas id="sales-history-chart" class="chart-canvas" height="180"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Movimientos del Inventario -->
    <div class="col-lg-6 mb-lg-4 mb-4">
        <div class="card z-index-2">
            <div class="card-body p-3">
                <h5 class="mb-3">Movimientos del Inventario</h5>
                <div class="border-radius-lg py-3 pe-1 mb-3">
                    <div class="chart">
                        <canvas id="inventory-movements-chart" class="chart-canvas" height="180"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Agendar citas </p>
                            <h6 class="font-weight-bolder mb-0">
                                
                              Online
                            </h6>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="fas fa-calendar-check text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Ver estado de </p>
                            <h6 class="font-weight-bolder mb-0">
                              Vehiculos online

                            </h6>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="fas fa-car text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Acceso a </p>
                            <h6 class="font-weight-bolder mb-0">
                                Historial de pagos

                            </h6>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="fas fa-file-invoice-dollar text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Flexibilidad de</p>
                            <h6 class="font-weight-bolder mb-0">
                                Métodos de pago

                            </h6>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="fas fa-money-check-alt text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column h-100">
                            <p class="mb-1 pt-2 text-bold">Hecho para tí</p>
                            <h5 class="font-weight-bolder">Automotriz JC</h5>
                            <p class="mb-5">Estamos a tus ordenes para cualquier consulta, recuerda que puedes
                                contactarnos en nuestras redes sociales y facilitar tu experiencia con nosotros. </p>

                        </div>
                    </div>
                    <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                        <div class="bg-gradient-dark border-radius-lg h-100">
                            
                            <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                
                                <img src="{{ asset('assets/images/logo.jpg') }}" class="w-50 position-relative z-index-2 border-radius-lg"
                                    alt="logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 mb-10">
        <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                style="background-image: url('../assets/img/ivancik.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                    <h5 class="text-white font-weight-bolder mb-4 pt-2">Quédate con nosotros</h5>
                    <p class="text-white"> Nosotros valoramos tu preferencia, con nuestra empresa automotriz JC
                        puedes tener la seguridad de que tu vehículo estará en las mejores manos. </p>
                    <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                        href="https://github.com/LeoMogiano">
                        Siguenos

                        <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

@endif



<div id="contador">
    <div class="card">
        <div class="card-body p-2">
            <h6 class="card-title m-0">Contador de visitas</h6>
            <p class="card-text m-0">Esta página ha sido visitada <span class="badge bg-primary">{{ $pagina->contador }}</span> veces</p>
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
@endsection

@push('dashboard')
<script>
    function fetchChartData(url, chartId) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                var ctx = document.getElementById(chartId).getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.data,
                        datasets: [{
                            label: "Total",
                            data: data.values,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            },
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $(document).ready(function() {
        fetchChartData('/statistics/sales-history', 'sales-history-chart');
        fetchChartData('/statistics/inventory-movements', 'inventory-movements-chart');
    });
</script>
@endpush
