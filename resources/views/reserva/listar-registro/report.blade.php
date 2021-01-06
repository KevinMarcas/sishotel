<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información detallada de la reserva {{ $reserva->IdReserva }}</title>
</head>
<style>
    table {
        border-collapse: collapse;
        border-color: darkblue;
        width: 100%;
        font-family: monospace;
    }

    table td {
        border: 1px solid black;
    }

    .titulo {
        background: #eee7e7;
    }

</style>

<body>
    <table >
        <tr>
            <td colspan="4" align="center" class="titulo">Estado de Hospedaje</td>
        </tr>
        <tr>
            <td><b>Nro Habitación: </b>{{ $reserva->Num_Hab }}</td>
            <td><b>Precio: </b>S/ {{ $reserva->prehab }}</td>
            <td colspan="2"><b>Tipo: </b>{{ $reserva->Denominacion }}</td>
        </tr>
        <tr>
            <td><b>N° Documento Cliente: </b>{{ $reserva->Ndcliente }}</td>
            <td colspan="3"><b>Cliente: </b> {{ $reserva->nomcli }} {{ $reserva->apecli }}</td>
        </tr>
        <tr>
            <td><b>Nro Celular: </b>{{ $reserva->Celular }}</td>
            <td colspan="2"><b>F. Entrada: </b>{{ $reserva->FechEntrada }}</td>
            <td><b>F. Salida: </b>{{ $reserva->FechSalida }}</td>
        </tr>
        <tr>
            <td colspan="3">Total Hospedaje</td>
            <td align="right">S/ {{ number_format($reserva->CostoAlojamiento, 2) }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td colspan="4" align="center" class="titulo">Detalles de Consumo</td>
        </tr>
        <tr>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Precio Unitario</td>
            <td>Subtotal</td>
        </tr>
        @php($total = 0)@php($portotal = 0)
        @foreach ($consumo as $con)
        <tr>
            <td>{{ $con->NombProducto }}d</td>
            <td>{{ $con->Cantidad }}</td>
            <td>S/ {{ $con->Precio }}</td>
            @php($portotal += $con->Total)
            <td align="right">S/ {{ $con->Total }}</td>
            @php($total += $con->Total)
        </tr>
        @endforeach
        <tr>
            <td colspan="3">Total Consumo</td>
            <td align="right">S/ {{ number_format($total, 2) }}</td>
        </tr>
        <tr>

            <td colspan="3" align="right"><b>TOTAL</b></td>
            <td width="200px">
                <input type="text" readOnly id="totalporpagar" class="form-control"
                    style="text-align:right;"
                    value="S/ {{ number_format($reserva->CostoAlojamiento + $total, 2) }}">
            </td>
        </tr>
    </table>
</body>
</html>
