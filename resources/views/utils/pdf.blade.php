<!DOCTYPE html>
<html>

<head>
    <title>{{ $pdfData['title'] }}</title>
    <style media="screen">
        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
        }

        header:before,
        header:after {
            content: " ";
            display: table;
        }

        header:after {
            clear: both;
        }

        .invoiceNbr {
            font-size: 30px;
            margin-right: 30px;
            margin-top: 20px;
            float: right;
        }

        .logo {
            float: left;
        }

        .from,
        .to {
            float: left;
            width: 40%;
        }

        .fromto {
            font-size: 14px;
            border-style: solid;
            border-width: 1px;
            border-color: #e8e5e5;
            border-radius: 5px;
            margin: 20px;
            min-width: 150px;
        }

        .fromtocontent {
            margin: 10px;
            margin-right: 40px;
        }

        .panel {
            background-color: #e8e5e5;
            padding: 7px;
            font-size: 14px;
            font-weight: bold;
        }

        .container {
            margin: 20px auto;
            /* Centrar la tabla */
        }

        .items {
            clear: both;
            display: table;
            padding: 20px;
            width: 100%;
            table-layout: fixed;

            /* Establece el ancho de la tabla de manera fija */
        }

        .row {
            display: table-row;
            min-width: 100%;
            max-width: 100%;
            page-break-inside: avoid;
            border: 1px solid #e8e5e5;
            font-size: 14px;
        }

        .col {
            display: table-cell;
            border: 1px solid #e8e5e5;
            padding: 4px;
            word-wrap: break-word;
            font-size: 14px;
        }

        /* Aplica text-align: right solo a la última celda (.col) de cada fila (.row) */
        .row .col:last-child {
            text-align: right;

        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="{{ public_path('/assets/images/logo.jpg') }}" alt="generic business logo" height="181"
                width="167" />
        </div>
        <div class="invoiceNbr">
            {{ $pdfData['title'] }}
            <br />
            <span style="font-size: 20px;">{{ date('d/m/Y') }}</span>
        </div>
    </header>
    <br>
    <div class="fromto from" style="margin-right: 80px !important">
        <div class="panel">EMPRESA</div>
        <div class="fromtocontent">
            <span>EL CAMPO</span><br />
            <span>Avenida Principal</span><br />
            <span>Cotoca BO</span><br />
        </div>
    </div>
    <div class="fromto to">
        <div class="panel">CONTACTO</div>
        <div class="fromtocontent">
            <span>Leslie Salome</span><br />
            <span>Jefe de Desarrollo</span><br />
            <span>6086</span>
        </div>
    </div>

    <div class="container">
        <section class="items">
            <div class="row">
                @foreach ($pdfData['headers'] as $header)
                    <div class="col panel">
                        {{ $header }}
                    </div>
                @endforeach
            </div>

            @foreach ($pdfData['data'] as $item)
                <div class="row">
                    @foreach ($pdfData['attributes'] as $key => $attribute)
                        @if ($attribute == 'proveedor')
                            <div class="col">
                                {{ $item->proveedor->nombre ?? '' }} {{-- Mostrar el nombre del proveedor --}}
                            </div>
                        @elseif ($attribute == 'cliente')
                            <div class="col">
                                {{ $item->cliente->name ?? '' }} {{-- Mostrar el nombre del usuario --}}
                            </div>
                        @elseif ($attribute == 'insumo')
                            <div class="col">
                                {{ $item->insumo->nombre ?? '' }} {{-- Mostrar el nombre del insumo --}}
                            </div>
                        @elseif ($attribute == 'motorizado')
                            <div class="col">
                                {{ $item->motorizado->marca ?? '' }} {{ $item->motorizado->modelo ?? '' }}
                                {{ $item->motorizado->placa ?? '' }} {{-- Mostrar el nombre del motorizado --}}
                            </div>
                        @else
                            <div class="col">
                                {{ $item->$attribute }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </section>
    </div>
</body>

</html>
