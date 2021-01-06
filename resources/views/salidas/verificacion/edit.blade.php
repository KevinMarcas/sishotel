@extends ('layout.admin')
@section('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Estado de Hospedaje</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            {!! Form::model($reserva, ['method' => 'PATCH', 'route' => ['verificacion.update', $reserva->IdReserva]]) !!}
            {{ Form::token() }}

            <div class="form-group">
                <input type="hidden" name="IdCliente" class="form-control" value="{{ $reserva->IdCliente }}">
            </div>

            <div class="form-group">
                <input type="hidden" name="Estado" class="form-control" value="H. CULMINADO">
            </div>
            <div class="form-group">
                <input type="hidden" name="IdPago" class="form-control" value="{{ $reserva->IdPago }}">
            </div>
            <div class="form-group">
                <input type="hidden" name="Num_Hab" class="form-control" value="{{ $reserva->Num_Hab }}">
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="Num_Hab">Nro Habitación</label>
                    <p>{{ $reserva->Num_Hab }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="Precioxdia">Precio por día</label>
                    <p>{{ $reserva->prehab }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="Tipo">Tipo</label>
                    <p>{{ $reserva->Denominacion }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="proveedor">N° Documento Cliente</label>
                    <p>{{ $reserva->Ndcliente }}</p>

                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="proveedor">Cliente</label>
                    <p>{{ $reserva->nomcli }} {{ $reserva->apecli }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="Celular">Nro Celular</label>
                    <p>{{ $reserva->Celular }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="FechEntrada">Fecha Entrada</label>
                    <p>{{ $reserva->FechEntrada }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="FechSalida">Fecha Salida</label>
                    <p>{{ $reserva->FechSalida }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #fad9d0;">
                            <th colspan="4">Detalles del Alojamiento</th>
                        </thead>
                        <thead>
                            <th>Costo Alojamiento</th>
                            <th>Dinero de Adelanto</th>
                            <th>Mora/Penalidad</th>
                            <th style="color: #f38365;">Por Pagar</th>
                        </thead>
                        <tr>
                            <td>{{ $reserva->CostoAlojamiento }}</td>
                            <td>{{ $reserva->TotalPago }}</td>
                            <!-- Oculyo -->
                            <input type="hidden" name="totalpago" value="{{ $reserva->CostoAlojamiento }}">
                            <!-- Oculto -->
                            <input type="hidden" id="porpagar1"
                                value="{{ $reserva->CostoAlojamiento - $reserva->TotalPago }}">
                            <td><input type="text" id="penalidad" name="penalidad"></td>
                            <td style="color: #f38365;">
                                <input type="text" disabled id="pago1"
                                    value="S/. {{ number_format($reserva->CostoAlojamiento - $reserva->TotalPago, 2) }}">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #fad9d0;">
                            <th colspan="5">Detalles de Consumo</th>
                        </thead>
                        <thead>

                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <!-- <th>Detalles</th> -->
                            <th>Estado</th>
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>

                            <th></th>
                            <th></th>
                            <th></th>
                            <!-- <th></th> -->

                        </tfoot>
                        <tbody>
                            @php($total = 0)
                                @php($portotal = 0)
                                    @foreach ($consumo as $con)
                                        <tr>
                                            <td>{{ $con->NombProducto }}</td>
                                            <td>{{ $con->Cantidad }}</td>
                                            <td>S/. {{ $con->Precio }}</td>
                                            @if ($con->Estado == 'PAGADO')
                                                <td class="label label-success">{{ $con->Estado }}</td>
                                            @else
                                                <td class="label label-danger">{{ $con->Estado }}</td>
                                                @php($portotal += $con->Total)
                                                @endif
                                                <td align="right">S/. {{ $con->Total }}</td>
                                                @php($total += $con->Total)
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Total Consumo:</th>
                                                <td align="right">S/. {{ number_format($total, 2) }}</td>
                                            </tr>

                                            <tr style="color: #f38365;">
                                                <th colspan="4">Por Pagar:</th>
                                                <td align="right">S/. {{ number_format($portotal, 2) }}</td>
                                                <!-- Oculto -->
                                                <input type="hidden" name="" id="porpagarc" value="{{ $portotal }}">
                                            </tr>
                                            <tr>
                                                <th colspan="3"></th>
                                                <th>TOTAL A PAGAR:</th>
                                                <td width="200px">
                                                    <input type="text" readOnly id="totalporpagar" class="form-control"
                                                        value="S/. {{ number_format($portotal + ($reserva->CostoAlojamiento - $reserva->TotalPago), 2) }}">
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tr>
                                            <td>
                                                <a href="{{ asset('salidas/verificacion') }}" class="btn btn-danger form-control">Volver
                                                    Atras</a>
                                            </td>
                                            <td colspan="3"></td>
                                            <td><a href="{{ URL::action('SalidaController@update', $reserva->IdReserva) }}"><button
                                                        class="btn btn-info form-control">Culminar y Limpiar Habitación</button></a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>

                        {!! Form::close() !!}

                    </div>
                    </div>
                    <script>
                        const inputs4 = document.querySelectorAll('#penalidad');

                        inputs4.forEach((input) => {
                            input.addEventListener('keyup', sumar);
                        })

                        function sumar() {
                            if (document.getElementById("penalidad").value === "") {
                                document.getElementById("penalidad").value = 0;
                            } else {
                                if (document.getElementById("penalidad").value.length > 1 && document.getElementById("penalidad").value
                                    .charAt(0) === "0") {
                                    document.getElementById("penalidad").value = document.getElementById("penalidad").value.slice(1);
                                }
                            }
                            var suma1 = parseInt(document.getElementById("penalidad").value) + parseInt(document.getElementById("porpagar1")
                                .value);
                            document.getElementById("pago1").value = "S/. " + suma1.toFixed(2);
                            var suma2 = suma1 + parseInt(document.getElementById("porpagarc").value);
                            document.getElementById("totalporpagar").value = "S/. " + suma2.toFixed(2);

                        }

                    </script>
                @endsection
