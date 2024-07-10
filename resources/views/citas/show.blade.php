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
                                        Ver Cita
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
                        Ver Cita #{{ $cita->id }}
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
                    <h6 class="mb-0">Información de Cita</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ route('citas.update', $cita->id) }}" method="POST" role="form text-left">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="montoTotal" id="montoTotal" value="">
                        <input type="hidden" name="serviciosData" id="serviciosData" value="">
                        <input type="hidden" name="insumosData" id="insumosData" value="">

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
                                    <label for="cita-cliente" class="form-control-label">Cliente</label>
                                    <div class="@error('cita.cliente_id')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Cliente" id="cita-cliente"
                                            name="cliente_id" value="{{ $cita->cliente->name }}" readonly>
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
                                            <option value="{{ $cita->motorizado->id }}" selected>
                                                {{ $cita->motorizado->marca }} {{ $cita->motorizado->modelo }}
                                                {{ $cita->motorizado->placa }}</option>
                                        </select>
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
                                        @error('fecha_hora')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
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
                                        @error('monto_total')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </form>
                    <br>
                    <br>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cita-servicios" class="form-control-label">Servicios</label>
                                <div class="border rounded-3" id="servicios-container">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cita-insumos" class="form-control-label">Insumos</label>
                                <div class="border rounded-3" id="insumos-container">
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
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cita->insumos as $insumo)
                                                <tr>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $insumo->nombre }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $insumo->pivot->cantidad }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $insumo->precio }}</p>
                                                    </td>

                                                    
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
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener datos de servicios desde la vista de Blade (Laravel)
            var serviciosData = {!! json_encode($cita->servicios) !!};
            // Obtener datos de insumos desde la vista de Blade (Laravel)
            var insumosData = {!! json_encode($cita->insumos) !!};

            // Llamar a las funciones para cargar los datos en las variables temporales
            cargarServiciosTemporales(serviciosData);
            cargarInsumosTemporales(insumosData);

            // Llamar a las funciones para actualizar la interfaz con los datos cargados
            actualizarInterfazServicios();
            actualizarInterfazInsumos();
            calcularMontoTotal();
        });

        $(document).ready(function() {
            $("#guardarBtn").on("click", function() {
                // Asigna los valores directamente a los campos ocultos del formulario
                var montoTotalXD = document.getElementById('cita-monto-total').value;
                $("#montoTotal").val(parseFloat(montoTotalXD));
                $("#serviciosData").val(JSON.stringify(
                    serviciosTemporales)); // Convierte a cadena JSON si es necesario
                $("#insumosData").val(JSON.stringify(
                    insumosTemporales)); // Convierte a cadena JSON si es necesario

                // Envía el formulario
                $("#miFormulario").submit();
            });


        })

        function calcularMontoTotal() {
            // Obtener el valor del monto total
            var montoTotal = 0;

            // Verificar si es un número válido
            if (!isNaN(montoTotal)) {

            } else {
                console.error('El monto total no es un número válido.');
            }

            // Sumar los precios de los servicios
            serviciosTemporales.forEach(function(servicio) {
                montoTotal += parseFloat(servicio.precio);
            });

            // Sumar los precios de los insumos
            insumosTemporales.forEach(function(insumo) {
                montoTotal += parseFloat(insumo.precioUnitario) * parseFloat(insumo.cantidad);
            });

            // Mostrar el monto total en el campo correspondiente
            document.getElementById('cita-monto-total').value = parseFloat(montoTotal).toFixed(2);
        }

        // Modifica estas funciones para cargar datos en las variables temporales
        function cargarServiciosTemporales(servicios) {
            serviciosTemporales = [];

            // Iterar sobre los servicios y ajustar los datos necesarios
            servicios.forEach(function(servicio) {
                // Considerar los datos del pivot
                var servicioConPivot = {
                    id: servicio.id,
                    nombre: servicio.nombre,
                    descripcion: servicio.descripcion,
                    cantidad: servicio.pivot.cantidad, // Ajustar según la estructura real del objeto pivot
                    precio: servicio.precio,
                };

                serviciosTemporales.push(servicioConPivot);
            });
        }

        function cargarInsumosTemporales(insumos) {
            insumosTemporales = [];

            // Iterar sobre los insumos y ajustar los datos necesarios
            insumos.forEach(function(insumo) {
                // Considerar los datos del pivot
                var insumoConPivot = {
                    id: insumo.id,
                    nombre: insumo.nombre,
                    cantidad: insumo.pivot.cantidad, // Ajustar según la estructura real del objeto pivot
                    precioUnitario: insumo.precio,
                };

                insumosTemporales.push(insumoConPivot);
            });
        }



        // Variables temporales para servicios e insumos
        var serviciosTemporales = [];
        var insumosTemporales = [];

        // Función para agregar un servicio a la lista temporal y actualizar la interfaz
        // Función para agregar un servicio a la lista temporal y actualizar la interfaz
        function agregarServicio() {
            var selectServicio = document.getElementById('nuevo-servicio');
            var id = selectServicio.value;
            var nombre = selectServicio.options[selectServicio.selectedIndex].dataset.nombre;
            var precio = selectServicio.options[selectServicio.selectedIndex].dataset.precio;

            // Verificar si el servicio ya está en la lista temporal
            var servicioExistente = serviciosTemporales.find(function(servicio) {
                return servicio.id == id;
            });

            if (servicioExistente) {
                alert('Este servicio ya ha sido añadido.');
                return;
            } else {
                // Si no existe, agrégalo a la lista temporal
                serviciosTemporales.push({
                    id: id,
                    nombre: nombre,
                    precio: precio,
                    cantidad: 1
                });
            }
            console.log('Los servicios: ', serviciosTemporales);
            // Actualizar la interfaz de servicios
            actualizarInterfazServicios();
            calcularMontoTotal();
        }

        // Función para agregar un insumo a la lista temporal y actualizar la interfaz
        function agregarInsumo() {
            var selectInsumo = document.getElementById('nuevo-insumo');
            var id = selectInsumo.value;
            var nombre = selectInsumo.options[selectInsumo.selectedIndex].dataset.nombre;
            var precio = selectInsumo.options[selectInsumo.selectedIndex].dataset.precio;
            var cantidad = parseInt(document.querySelector('input[name="cantidad_insumo"]').value);

            
            var cantidadExistente = selectInsumo.options[selectInsumo.selectedIndex].dataset.cantidadreal;
            
            if (cantidad > cantidadExistente) {
                alert('La cantidad no puede ser mayor a la existente.');
                return;
            }
            // Verificar si el insumo ya está en la lista temporal
            var insumoExistente = insumosTemporales.find(function(insumo) {
                return insumo.id == id;
            });

            if (insumoExistente) {
                
                insumoExistente.cantidad += cantidad;
                if (insumoExistente.cantidad > cantidadExistente) {
                    alert('La cantidad no puede ser mayor a la existente.');
                    return;
                }
            } else {
                // Si no existe, agrégalo a la lista temporal
                insumosTemporales.push({
                    id: id,
                    nombre: nombre,
                    cantidad: cantidad,
                    precioUnitario: precio
                });
            }

            console.log('Los insumos: ', insumosTemporales);
            // Actualizar la interfaz de insumos
            actualizarInterfazInsumos();
            calcularMontoTotal();
        }



        // Función para actualizar la interfaz de servicios
        function actualizarInterfazServicios() {
            var serviciosContainer = document.getElementById('servicios-container');

            // Limpiar el contenido actual del cuerpo de la tabla
            serviciosContainer.querySelector('tbody').innerHTML = '';

            // Crear la fila de encabezado si no existe
            if (!serviciosContainer.querySelector('thead')) {
                var thead = document.createElement('thead');
                var headerRow = document.createElement('tr');

                var nombreHeader = document.createElement('th');
                nombreHeader.className = 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                nombreHeader.textContent = 'Nombre';
                headerRow.appendChild(nombreHeader);

                var precioHeader = document.createElement('th');
                precioHeader.className = 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                precioHeader.textContent = 'Precio';
                headerRow.appendChild(precioHeader);

                var accionesHeader = document.createElement('th');
                accionesHeader.className =
                    'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                accionesHeader.textContent = 'Acciones';
                headerRow.appendChild(accionesHeader);

                thead.appendChild(headerRow);
                serviciosContainer.appendChild(thead);
            }

            // Crear la fila de cuerpo si no existe
            if (!serviciosContainer.querySelector('tbody')) {
                serviciosContainer.appendChild(document.createElement('tbody'));
            }

            serviciosTemporales.forEach(function(servicio) {
                var servicioRow = document.createElement('tr');

                var nombreColumn = document.createElement('td');
                nombreColumn.className = 'text-center';
                var nombreElement = document.createElement('p');
                nombreElement.className = 'text-xs font-weight-bold mb-0';
                nombreElement.textContent = servicio.nombre;
                nombreColumn.appendChild(nombreElement);

                var precioColumn = document.createElement('td');
                precioColumn.className = 'text-center';
                var precioElement = document.createElement('p');
                precioElement.className = 'text-xs font-weight-bold mb-0';
                precioElement.textContent = servicio.precio;
                precioColumn.appendChild(precioElement);

                var accionesColumn = document.createElement('td');
                accionesColumn.className = 'text-center';
                var accionesButton = document.createElement('button');
                accionesButton.type = 'button';
                accionesButton.className = 'cursor-pointer';
                accionesButton.style = 'border: none; background: none;';
                accionesButton.onclick = function() {
                    eliminarServicio(servicio.id);
                };
                var accionesIcon = document.createElement('i');
                accionesIcon.className = 'fas fa-trash text-secondary';
                accionesButton.appendChild(accionesIcon);
                accionesColumn.appendChild(accionesButton);

                servicioRow.appendChild(nombreColumn);
                servicioRow.appendChild(precioColumn);
                servicioRow.appendChild(accionesColumn);

                serviciosContainer.querySelector('tbody').appendChild(servicioRow);
            });
        } // Función para actualizar la interfaz de servicios
        function actualizarInterfazServicios() {
            var serviciosContainer = document.getElementById('servicios-container');

            // Limpiar el contenido actual del cuerpo de la tabla
            serviciosContainer.querySelector('tbody').innerHTML = '';

            // Crear la fila de encabezado si no existe
            if (!serviciosContainer.querySelector('thead')) {
                var thead = document.createElement('thead');
                var headerRow = document.createElement('tr');

                var nombreHeader = document.createElement('th');
                nombreHeader.className = 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                nombreHeader.textContent = 'Nombre';
                headerRow.appendChild(nombreHeader);

                var precioHeader = document.createElement('th');
                precioHeader.className = 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                precioHeader.textContent = 'Precio';
                headerRow.appendChild(precioHeader);

                var accionesHeader = document.createElement('th');
                accionesHeader.className =
                    'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                accionesHeader.textContent = 'Acciones';
                headerRow.appendChild(accionesHeader);

                thead.appendChild(headerRow);
                serviciosContainer.appendChild(thead);
            }

            // Crear la fila de cuerpo si no existe
            if (!serviciosContainer.querySelector('tbody')) {
                serviciosContainer.appendChild(document.createElement('tbody'));
            }

            serviciosTemporales.forEach(function(servicio) {
                var servicioRow = document.createElement('tr');

                var nombreColumn = document.createElement('td');
                nombreColumn.className = 'text-center';
                var nombreElement = document.createElement('p');
                nombreElement.className = 'text-xs font-weight-bold mb-0';
                nombreElement.textContent = servicio.nombre;
                nombreColumn.appendChild(nombreElement);

                var precioColumn = document.createElement('td');
                precioColumn.className = 'text-center';
                var precioElement = document.createElement('p');
                precioElement.className = 'text-xs font-weight-bold mb-0';
                precioElement.textContent = servicio.precio;
                precioColumn.appendChild(precioElement);

                var accionesColumn = document.createElement('td');
                accionesColumn.className = 'text-center';
                var accionesButton = document.createElement('button');
                accionesButton.type = 'button';
                accionesButton.className = 'cursor-pointer';
                accionesButton.style = 'border: none; background: none;';
                accionesButton.onclick = function() {
                    eliminarServicio(servicio.id);
                };
                var accionesIcon = document.createElement('i');
                accionesIcon.className = 'fas fa-trash text-secondary';
                accionesButton.appendChild(accionesIcon);
                accionesColumn.appendChild(accionesButton);

                servicioRow.appendChild(nombreColumn);
                servicioRow.appendChild(precioColumn);
                servicioRow.appendChild(accionesColumn);

                serviciosContainer.querySelector('tbody').appendChild(servicioRow);
            });
        }

        // Función para actualizar la interfaz de insumos
        function actualizarInterfazInsumos() {
            var insumosContainer = document.getElementById('insumos-container');

            // Limpiar el contenido actual del cuerpo de la tabla
            insumosContainer.querySelector('tbody').innerHTML = '';

            // Crear la fila de encabezado si no existe
            if (!insumosContainer.querySelector('thead')) {
                var thead = document.createElement('thead');
                var headerRow = document.createElement('tr');

                var nombreHeader = document.createElement('th');
                nombreHeader.className = 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                nombreHeader.textContent = 'Nombre';
                headerRow.appendChild(nombreHeader);

                var cantidadHeader = document.createElement('th');
                cantidadHeader.className =
                    'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                cantidadHeader.textContent = 'Cantidad';
                headerRow.appendChild(cantidadHeader);

                var precioUnitarioHeader = document.createElement('th');
                precioUnitarioHeader.className =
                    'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                precioUnitarioHeader.textContent = 'Precio Unitario';
                headerRow.appendChild(precioUnitarioHeader);

                var accionesHeader = document.createElement('th');
                accionesHeader.className =
                    'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7';
                accionesHeader.textContent = 'Acciones';
                headerRow.appendChild(accionesHeader);

                thead.appendChild(headerRow);
                insumosContainer.appendChild(thead);
            }

            // Crear la fila de cuerpo si no existe
            if (!insumosContainer.querySelector('tbody')) {
                insumosContainer.appendChild(document.createElement('tbody'));
            }

            insumosTemporales.forEach(function(insumo) {
                // Buscar la fila existente y actualizarla si es necesario
                var filaExistente = insumosContainer.querySelector('tbody tr[data-id="' + insumo.id + '"]');

                if (filaExistente) {
                    // La fila ya existe, actualiza la cantidad
                    var cantidadElement = filaExistente.querySelector('.cantidad-column p');
                    cantidadElement.textContent = parseInt(cantidadElement.textContent) + parseInt(insumo.cantidad);


                } else {
                    // La fila no existe, créala
                    var insumoRow = document.createElement('tr');
                    insumoRow.setAttribute('data-id', insumo.id);

                    var nombreColumn = document.createElement('td');
                    nombreColumn.className = 'text-center';
                    var nombreElement = document.createElement('p');
                    nombreElement.className = 'text-xs font-weight-bold mb-0';
                    nombreElement.textContent = insumo.nombre;
                    nombreColumn.appendChild(nombreElement);

                    var cantidadColumn = document.createElement('td');
                    cantidadColumn.className = 'text-center cantidad-column';
                    var cantidadElement = document.createElement('p');
                    cantidadElement.className = 'text-xs font-weight-bold mb-0';
                    cantidadElement.textContent = insumo.cantidad;
                    cantidadColumn.appendChild(cantidadElement);

                    var precioUnitarioColumn = document.createElement('td');
                    precioUnitarioColumn.className = 'text-center';
                    var precioUnitarioElement = document.createElement('p');
                    precioUnitarioElement.className = 'text-xs font-weight-bold mb-0';
                    precioUnitarioElement.textContent = insumo.precioUnitario;
                    precioUnitarioColumn.appendChild(precioUnitarioElement);

                    var accionesColumn = document.createElement('td');
                    accionesColumn.className = 'text-center';
                    var accionesButton = document.createElement('button');
                    accionesButton.type = 'button';
                    accionesButton.className = 'cursor-pointer';
                    accionesButton.style = 'border: none; background: none;';
                    accionesButton.onclick = function() {
                        eliminarInsumo(insumo.id);
                    };
                    var accionesIcon = document.createElement('i');
                    accionesIcon.className = 'fas fa-trash text-secondary';
                    accionesButton.appendChild(accionesIcon);
                    accionesColumn.appendChild(accionesButton);

                    insumoRow.appendChild(nombreColumn);
                    insumoRow.appendChild(cantidadColumn);
                    insumoRow.appendChild(precioUnitarioColumn);
                    insumoRow.appendChild(accionesColumn);

                    insumosContainer.querySelector('tbody').appendChild(insumoRow);
                }
            });

            // Eliminar filas que ya no están en la lista temporal
            var filasEliminar = insumosContainer.querySelectorAll('tbody tr:not([data-id])');
            filasEliminar.forEach(function(fila) {
                fila.remove();
            });
        }




        // Función para eliminar un insumo y actualizar la interfaz
        function eliminarInsumo(id) {
            // Eliminar el insumo de la lista temporal
            insumosTemporales = insumosTemporales.filter(function(insumo) {
                return insumo.id !== id;
            });

            // Actualizar la interfaz de insumos
            actualizarInterfazInsumos();
            calcularMontoTotal();
        }

        function eliminarServicio(id) {
            // Eliminar el servicio de la lista temporal
            serviciosTemporales = serviciosTemporales.filter(function(servicio) {
                return servicio.id !== id;
            });

            // Actualizar la interfaz de servicios

            actualizarInterfazServicios();
            calcularMontoTotal();
        }
    </script>

    
@endsection
