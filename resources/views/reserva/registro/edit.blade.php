<?php date_default_timezone_set('America/Lima'); ?>
@extends ('layout.admin')
@section('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Editar datos del Registro</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                        <p style="font-size:20px;"><b>Detalles de la Habitación</b></p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label>
                            <div class="titulo">Nro de Habitación: </div> {{ $Habitacion->Num_Hab }}
                        </label>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label>
                            <div class="titulo">Tipo de Habitación: </div> {{ $Habitacion->tipoden }}
                        </label>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label>
                            <div class="titulo">Estado: </div>
                            @if ($Habitacion->Estado == 'DISPONIBLE')
                                <div style="float:left; background: #1cad69; color: #ffffff; padding: 0 3px 0 3px;">
                                    {{ $Habitacion->Estado }}
                                </div>
                            @elseif ($Habitacion->Estado == "RESERVADO")
                                <div style="float:left; background: #1c7fad; color: #ffffff; padding: 0 3px 0 3px;">
                                    {{ $Habitacion->Estado }}
                                </div>
                            @elseif ($Habitacion->Estado == "OCUPADO")
                                <div style="float:left; background: #e67469; color: #ffffff; padding: 0 3px 0 3px;">
                                    {{ $Habitacion->Estado }}
                                </div>
                            @endif
                        </label>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                        <label>
                            <div class="titulo">Descripción: </div> {{ $Habitacion->deshab }}
                        </label>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label>
                            <div class="titulo">Precio: </div>S/ {{ $Habitacion->Precio }}
                        </label>
                        <input type="hidden" id="Precio" value="{{ $Habitacion->Precio }}">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    {!! Form::model($reserva, ['method' => 'PATCH', 'route' => ['registro.update', $reserva->IdReserva]]) !!}
    {{ Form::token() }}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Nombre del Cliente</label>
                <select name="IdCliente" class="form-control selectpicker" id="IdCliente" data-live-search="true">
                    @foreach ($Cliente as $c)
                        @if ($c->IdCliente == $reserva->IdCliente)
                            <option value="{{ $c->IdCliente }}" selected>{{ $c->NumDocumento }} | {{ $c->Nombre }}
                                {{ $c->Apellido }}
                            </option>
                        @else
                            <option value="{{ $c->IdCliente }}">{{ $c->NumDocumento }} | {{ $c->Nombre }} {{ $c->Apellido }}
                            </option>

                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="c_comensales">Tipo de Registro</label>
                <select name="Estado" class="form-control" id="Estado">
                    @if ('HOSPEDAR' == $reserva->Estado)
                        <option value="HOSPEDAR" selected>HOSPEDAR</option>

                    @else
                        <option value="HOSPEDAR">HOSPEDAR</option>
                        <option value="RESERVAR" selected>RESERVAR</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="" id="Entrada">Fecha Entrada (dd/mm/yyyy)</label>
                <label for="" id="Reserva" style="display:none;">Fecha Reserva (dd/mm/yyyy)</label>
                @if ($reserva->Estado == 'RESERVAR')
                    <input type="date" name="FechReserva" id="freserva" min="{{ $reserva->FechReserva }}"
                        value="{{ $reserva->FechReserva }}" class="form-control">
                @elseif ($reserva->Estado=="HOSPEDAR")
                    <input type="date" name="FechReserva" id="freserva" min="{{ $reserva->FechEntrada }}" readOnly
                        value="{{ $reserva->FechEntrada }}" class="form-control">

                @endif
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Fecha Salida (dd/mm/yyyy)</label>
                <input type="date" name="FechSalida" id="fsalida" value="{{ $reserva->FechSalida }}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <input type="hidden" name="Num_Hab" value="{{ $Habitacion->Num_Hab }}">
                <label for="">Total a Pagar </label>
                <input type="text" id="costo" name="CostoAlojamiento" readonly value="{{ $reserva->CostoAlojamiento }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Adelanto </label>
                <input type="text" id="Adelanto" readonly
                name="Adelanto" value="{{ $pago->TotalPago }}" class="form-control">
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Porcentaje de Adelanto</label>
                <select name="PorAdelanto" id="PorAdelanto" class="form-control selectpicker">
                    @if ($reserva->CostoAlojamiento == $pago->TotalPago)
                        <option value="0">0 %</option>
                        <option value="50">50 %</option>
                        <option value="100" selected>100 %</option>
                    @elseif($pago->TotalPago == ($reserva->CostoAlojamiento/2))
                        <option value="0">0 %</option>
                        <option value="50" selected>50 %</option>
                        <option value="100">100 %</option>
                    @else
                        <option value="0" selected>0 % </option>
                        <option value="50">50 %</option>
                        <option value="100">100 %</option>
                    @endif
                </select>
            </div>
        </div>
        <input type="hidden" value="{{ $pago->IdPago }}" name="IdPago">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Observaciones </label>
                <textarea name="Observacion" placeholder="Comparte tu opinión con el autor!"
                    class="form-control">{{ $reserva->Observacion }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <div class="form-group">
                <a href="{{ asset('reserva/registro') }}" class="btn btn-danger">Volver Atras</a>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <div class="form-group">
                <button class="btn btn-primary" style="float: right"
                type="submit">Modificar Registro</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        const input = document.querySelector('#fsalida');
        const input2 = document.querySelector('#freserva');



        input.addEventListener('change', updateValue2);
        input2.addEventListener('change', updateValue);


        function updateValue(e) {
            // Calculamos la diferencia en dias
            fecha1 = document.getElementById("freserva").value;
            fecha2 = document.getElementById("fsalida");

            // Establecemos el min de la fecha final
            var f = new Date(fecha1);
            fecha2.setAttribute("min", f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + ("0" + (f.getDate() + 2)).slice(-
                2));
            console.log(fecha1);
            fecha2.value = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + ("0" + (f.getDate() + 2)).slice(-2);

            var fechaInicio = new Date(fecha1).getTime();
            var fechaFin = new Date(fecha2.value).getTime();
            var dia = (fechaFin - fechaInicio) / (1000 * 60 * 60 * 24);
            // Calculamos el total a pagar
            precio = document.getElementById("Precio").value;
            document.getElementById("costo").value = dia * precio;

        }

        function updateValue2(e) {
            fecha1 = document.getElementById("freserva").value;
            fecha2 = document.getElementById("fsalida");
            var fechaInicio = new Date(fecha1).getTime();
            var fechaFin = new Date(fecha2.value).getTime();
            var dia = (fechaFin - fechaInicio) / (1000 * 60 * 60 * 24);
            // Calculamos el total a pagar
            precio = document.getElementById("Precio").value;
            var n = dia * precio;
            document.getElementById("costo").value = n.toFixed(2);
            var r = (document.getElementById("PorAdelanto").value * n) / 100;
            document.getElementById("Adelanto").value = r.toFixed(2);
        }

        // Revervar/Hospedar
        const selectElement = document.querySelector('#Estado');
        var Reserva = document.getElementById("Reserva");
        var Entrada = document.getElementById("Entrada");

        selectElement.addEventListener('change', (event) => {
            if (event.target.value == 'RESERVAR') {
                Entrada.style.display = "none";
                Reserva.style.display = "block";
            } else {
                Reserva.style.display = "none";
                Entrada.style.display = "block";
                $("#freserva").attr("readonly", "readonly");
                var f = new Date();
                document.getElementById("freserva").value = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + (
                    "0" + f.getDate()).slice(-2);
                updateValue();
            }
        });
        const adelanto = document.querySelector('#PorAdelanto');
        adelanto.addEventListener('change', (event) => {
            if (event.target.value == '0') {
                var r = 0.00;
                document.getElementById("Adelanto").value = r.toFixed(2);
            } else if (event.target.value == '50') {
                var r = document.getElementById("costo").value * 0.50;
                document.getElementById("Adelanto").value = r.toFixed(2);
            } else {
                document.getElementById("Adelanto").value = document.getElementById("costo").value;
            }
        });

    </script>
@endsection
