@extends ('layout.admin')
@section('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Estado de Hospedaje</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


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
                            <th colspan="5">Detalles de Consumo</th>
                        </thead>
                        <thead>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <!-- <th>Detalles</th> -->

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
                                            @php($portotal += $con->Total)
                                                <td align="right">S/. {{ $con->Total }}</td>
                                                @php($total += $con->Total)
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total Consumo:</th>
                                                <td align="right">S/. {{ number_format($total, 2) }}</td>
                                            </tr>

                                            <tr style="color: #f38365;">
                                                <th colspan="3">Monto Hospedaje</th>
                                                <td align="right">S/. {{ number_format($reserva->CostoAlojamiento, 2) }}</td>
                                                <!-- Oculto -->
                                                <input type="hidden" name="" id="porpagarc" value="{{ $portotal }}">
                                            </tr>
                                            <tr>
                                                <th colspan="2"></th>
                                                <th>TOTAL:</th>
                                                <td width="200px">
                                                    <input type="text" readOnly id="totalporpagar" class="form-control"
                                                        style="text-align:right;"
                                                        value="S/. {{ number_format($reserva->CostoAlojamiento + $total, 2) }}">
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tr>
                                            <td>
                                                <a href="{{ asset('reserva/listar-registro') }}" class="btn btn-danger">Volver
                                                    Atras</a>
                                            </td>
                                            <td colspan="2"></td>
                                            <td><a href="{{ URL::action('LReservaController@report', $reserva->IdReserva) }}"><button
                                                        class="btn btn-info form-control">Imprimir</button></a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>


                    </div>
                    </div>

                @endsection
