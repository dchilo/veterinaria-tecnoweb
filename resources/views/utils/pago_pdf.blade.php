<!DOCTYPE html>
<html>

<head>
    <title> PAGO #{{ $pago->id }} </title>
    <style media="screen">
        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
            color: #424242; /* Color de texto aplomado */
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
            color: #424242; /* Color de texto aplomado */
        }

        .logo {
            float: left;
        }

        .from,
        .to {
            float: left;
            width: 40%;
            color: #424242; /* Color de texto aplomado */
        }

        .fromto {
            font-size: 13px;
            border-style: solid;
            border-width: 1px;
            border-color: #e8e5e5; /* Color de borde aplomado */

            margin: 20px;
            min-width: 150px;
            color: #424242; /* Color de texto aplomado */
        }

        .fromtocontent {
            margin: 10px;
            margin-right: 40px;
        }

        .panel {
            background-color: #e8e5e5;
            font-weight: bold;
            padding: 7px;
            font-size: 14px;
            color: #424242; /* Color de texto aplomado */
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

        .col {
            display: table-cell;
            padding: 5px;
            min-width: 100px;
            /* Ajusta según tus necesidades */
            max-width: 200px;
            /* Ajusta según tus necesidades */
            word-wrap: break-word;
            /* Rompe las palabras largas */
            font-size: 13px;
        }

        .row {
            display: table-row;
            min-width: 100%;
            /* Ajusta según tus necesidades */
            max-width: 100%;
            /* Ajusta según tus necesidades */
            page-break-inside: avoid;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            border: 1px solid #e8e5e5; /* Color de borde aplomado */
        }

        th,
        td {
            border: 1px solid #e8e5e5; /* Color de borde aplomado */
            padding: 5px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #e8e5e5;
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
            BOLETA DE PAGO #{{ $pago->id }}
            <br />
            <span style="font-size: 20px;">Fecha de Pago:
                {{ \Carbon\Carbon::parse($pago->fecha)->format('d-m-Y') }}</span>
        </div>
    </header>
    <br>
    <div class="fromto from" style="margin-right: 80px !important">
        <div class="panel">EMPRESA</div>
        <div class="fromtocontent">
            <span>EL CAMPO</span><br />
            <span>3415 Radial #13</span><br />
            <span>Santa Cruz BO</span><br />
        </div>
    </div>
    <div class="fromto to">
        <div class="panel">CLIENTE</div>
        <div class="fromtocontent">
            <span>{{ $cliente->name }}</span><br />
            <span>{{ $cliente->email }}</span><br />
            <span>{{ $cliente->phone }}</span>
        </div>
    </div>

    <div class="container">
        <section class="items">
            <!-- DETALLE PAGO -->
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <th colspan="4" style="text-align: center; ">
                        DETALLE PAGO - VENTA #{{ $venta->id }}
                    </th>
                </tr>
                <tr>
                    <th style="width: 20%;">PRODUCTO:</th>
                    <td style="width: 30%;">{{ $producto->nombre }}</td>
                    <th style="width: 20%;">TIPO DE PAGO:</th>
                    <td style="width: 30%;">{{ $pago->metodo_pago }}</td>
                </tr>
                <tr>
                    <th style="width: 20%;">FECHA DE PAGO:</th>
                    <td style="width: 30%;">{{ \Carbon\Carbon::parse($pago->fecha)->format('d-m-Y') }}</td>
                    <th style="width: 20%;">FECHA DE VENTA:</th>
                    <td style="width: 30%;">{{ \Carbon\Carbon::parse($venta->fecha)->format('d-m-Y') }}</td>
                </tr>
            </table>

            <!-- DETALLE PRODUCTOS -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <tr class="text-center">
                    <th colspan="4" style="text-align: center; ">
                        DETALLE PRODUCTOS
                    </th>
                </tr>
                <tr class="text-center">
                    <th style="width: 40%; text-align: center;">Producto</th>
                    <th style="width: 20%; text-align: center;">Cantidad</th>
                    <th style="width: 20%; text-align: center;">Precio Unitario</th>
                    <th style="width: 20%; text-align: center;">Precio Total</th>
                </tr>
                <tr class="text-center">
                    <td style="width: 40%; text-align: center;">{{ $producto->nombre }}</td>
                    <td style="width: 20%; text-align: center;">{{ $venta->cantidad }}</td>
                    <td style="width: 20%; text-align: center;">{{ $producto->precio }}</td>
                    <td style="width: 20%; text-align: center;">{{ $venta->cantidad * $producto->precio }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right; padding-top: 20px; font-weight: bold">MONTO TOTAL: {{ $pago->monto }}
                    </td>
                </tr>
            </table>
        </section>
    </div>

</body>

</html>
