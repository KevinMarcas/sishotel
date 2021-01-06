<?php date_default_timezone_set('America/Lima'); ?>
@extends ('layout.admin')
@section('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Agregando nuevo Registro</p>
        </div>
    </div>

    {!! Form::open(['url' => 'reserva/listar-registro/create', 'method' => 'GET', 'autocomplete' => 'off', 'role' =>
    'search']) !!}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p style="font-size:20px;"><b>Detalles de la Habitación</b></p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>
                                <div class="titulo">Nro de Habitación </div>
                            </label>
                            <select class="form-control selectpicker searchText" name="searchText" id="Num_Hab">
                                <option value="">Seleccione una Habitación</option>
                                @foreach ($Habitacion as $hab)
                                    @if ($searchText == $hab->Num_Hab)
                                        <option
                                            value="{{ $hab->Num_Hab }}_{{ $hab->tipoden }}_{{ $hab->Precio }}_{{ $hab->Estado }}_{{ $hab->deshab }}"
                                            selected>
                                            Habitación {{ $hab->Num_Hab }}</option>
                                    @else
                                        <option
                                            value="{{ $hab->Num_Hab }}_{{ $hab->tipoden }}_{{ $hab->Precio }}_{{ $hab->Estado }}_{{ $hab->deshab }}">
                                            Habitación {{ $hab->Num_Hab }}</option>
                                    @endif

                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>
                                <div class="titulo">Tipo de Habitación </div>
                            </label>
                            <input type="text" value="" id="Tipo_habitacion"
                            class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>
                                <div class="titulo">Precio </div>
                            </label>
                            <input type="text" value="" id="Precio"
                            class="form-control"
                            disabled>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>
                                <div class="titulo">Descripción </div>
                            </label>
                            <input type="text" value="" id="Descripcion"
                            class="form-control"
                            disabled>
                        </div>
                    </div>

                        <div class="form-group">
                            {{-- <label>
                                <div class="titulo">Estado: </div>
                            </label> --}}
                            <input type="hidden" value="" id="Estado_Hab" disabled>
                        </div>


                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="btnbuscar">Buscar</button>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <p style="font-size:20px;"><b>Registros Activos</b></p>
                            @php($nro = 0)
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Nro </th>
                                        <th>Fecha Reserva</th>
                                        <th>Fecha Salida</th>
                                        <th>Estado</th>
                                    </thead>
                                    @foreach ($reserva as $re)
                                        <tr>
                                            <td>{{ $nro += 1 }}</td>
                                            <td>{{ date_format(new DateTime($re->FechReserva), "d/m/Y") }}</td>
                                            <td>{{ date_format(new DateTime($re->FechSalida), "d/m/Y") }}</td>
                                            @if ($re->Estado == 'HOSPEDAR')
                                                <td class="label label-danger">HOSPEDADO</td>
                                            @elseif($re->Estado == "RESERVAR")
                                                <td class="label label-info">RESERVADO</td>
                                            @else
                                                <td>{{ $re->Estado }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}

        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                <div id="error_fecha" class=" bg-danger text-danger"></div>


                @if (count($errors) > 0)
                    <div class="alert bg-danger text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        {!! Form::open(['url' => 'reserva/listar-registro', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        {{ Form::token() }}
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="">Nombre del Cliente</label>
                    <select name="IdCliente" class="form-control selectpicker" id="IdCliente" data-live-search="true">
                        @foreach ($Cliente as $c)
                            <option value="{{ $c->IdCliente }}">{{ $c->NumDocumento }} | {{ $c->Nombre }} {{ $c->Apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Para el autoincrementable -->
            @if (isset($Reserva2))
                <input type="hidden" name="codigo" value="{{ $Reserva2->IdReserva }}">
            @else
                <input type="hidden" name="codigo" value="0">
            @endif
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="c_comensales">Tipo de Registro</label>
                    <select name="Estado" class="form-control selectpicker" id="Estado">
                        <option value="HOSPEDAR">HOSPEDAR</option>
                        <option value="RESERVAR">RESERVAR</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="" id="Entrada">Fecha Entrada (dd/mm/yyyy)</label>
                    <label for="" id="Reserva" style="display:none;">Fecha Reserva (dd/mm/yyyy)</label>
                    <input type="date"
                        min="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' -0 day')); ?>"
                        id="freserva" name="FechReserva" value="<?php echo date('Y-m-d'); ?>"
                        readonly class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="">Fecha Salida (dd/mm/yyyy)</label>
                    <input type="date" name="FechSalida" id="fsalida"
                        min="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')); ?>"
                        value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')); ?>"
                        class="form-control">
                </div>
            </div>


            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="">Total a Pagar </label>
                    <input type="text" id="costo" name="CostoAlojamiento" readonly name="Observaciones" class="form-control">
                </div>
            </div>

            <input type="hidden" value="" id="Num" name="Num_Hab">

            <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="">Adelanto </label>
                    <input type="text" id="Adelanto" name="Adelanto" value="0.00" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="">Porcentaje de Adelanto</label>
                    <select name="PorAdelanto" id="PorAdelanto" class="form-control selectpicker">
                        <option value="0">0 %</option>
                        <option value="50">50 %</option>
                        <option value="100">100 %</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="">Observaciones </label>
                    <textarea name="Observacion" placeholder="Comparte tu opinión con el autor!"
                        class="form-control"></textarea>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <table class="table table-striped table-bordered table-condensed ">
                        <tr>
                            <td>
                                <a href="{{ asset('reserva/listar-registro') }}" class="btn btn-danger"
                                >Volver Atras</a>
                            </td>
                            <td>
                                <button class="btn btn-primary" id="agregar" type="submit" style="float: right;">Agregar Registro</button>
                            </td>

                        </tr>
                    </table>

                    <br>

                </div>
            </div>

        </div>

        {!! Form::close() !!}



        <script>
            window.onload = updateValue;
            document.getElementById("btnbuscar").style.display = "none";
            const input = document.querySelector('#fsalida');
            const input2 = document.querySelector('#freserva');

            input.addEventListener('change', updateValue);
            input2.addEventListener('change', updateValue);

            function updateValue(e) {
                // Calculamos la diferencia en dias
                fecha1 = document.getElementById("freserva").value;
                fecha2 = document.getElementById("fsalida").value;
                var fechaInicio = new Date(fecha1).getTime();
                var fechaFin = new Date(fecha2).getTime();
                var dia = (fechaFin - fechaInicio) / (1000 * 60 * 60 * 24);
                // Calculamos el total a pagar
                precio = document.getElementById("Precio").value;
                var n = dia * precio;
                document.getElementById("costo").value = n.toFixed(2);
                var r = (document.getElementById("PorAdelanto").value * n) / 100;
                document.getElementById("Adelanto").value = r.toFixed(2);
                sumarDias(fecha1, fecha2);
            }


            // Revervar/Hospedar
            const selectElement = document.querySelector('#Estado');
            var Reserva = document.getElementById("Reserva");
            var Entrada = document.getElementById("Entrada");



            selectElement.addEventListener('change', (event) => {
                

                if (event.target.value == 'RESERVAR') {
                    Entrada.style.display = "none";
                    Reserva.style.display = "block";
                    $("#freserva").removeAttr("readOnly");

                } else {
                    Reserva.style.display = "none";
                    Entrada.style.display = "block";
                    $("#freserva").attr("readonly", "readonly");
                    var f = new Date();
                    document.getElementById("freserva").value = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f
                        .getDate();
                }
                fecha1 = document.getElementById("freserva").value;
                fecha2 = document.getElementById("fsalida").value;
                sumarDias(fecha1, fecha2);

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
            
            // Función para sumar fechas
            function sumarDias(fecha_Inicial, fecha_Final){
                var data = <?php echo json_encode($reserva); ?>;
                var fecha_Inicial = new Date(fecha_Inicial);
                var fecha_Final = new Date(fecha_Final);
                var h = fecha_Final - fecha_Inicial;
                var d = h/(1000*60*60*24);
                var finicial = new Date(fecha_Inicial);

                var agregar = document.getElementById("agregar");
                var error_fecha = document.getElementById("error_fecha");
                for (var i = 0; i <= d; i++) {
                    finicial.setDate(finicial.getDate() + 1);
                    var fecha = finicial.getFullYear() + "-" + (finicial.getMonth() + 1) + "-" + ("0" + (finicial.getDate())).slice(-
                2);
                    var aux = "";
                    for (x of data) {
                        
                        if (fecha === x.FechReserva || fecha === x.FechSalida) {
                            aux = "1";
                            break;
                        }
                    }
                    
                   
                    if (aux === '1') {
                         error_fecha.innerHTML = '<li>Verifique que el rango de las Fechas no interfiera con algún registro Activo.</li>';
                        error_fecha.style.padding = "15px";
                        agregar.style.display = "none";
                        break;
                    }else {
                        error_fecha.innerHTML = '';
                        agregar.style.display = "block";
                        error_fecha.style.padding = "0px";
                    }
                }
                if (fecha_Inicial >= fecha_Final){
                    error_fecha.innerHTML = '<li>La fecha inicial no debe ser mayor o igual que la fecha final.</li>';
                    error_fecha.style.padding = "15px";
                    agregar.style.display = "none";
                }

            }

        </script>
        @push('scripts')
            <script>
                // Codigo para mostrar los datos de la habitacion

                $("#Num_Hab").change(mostrarValores);
                mostrarValores2();
                function mostrarValores() {
                    datosProducto = document.getElementById('Num_Hab').value.split('_');
                    $("#Num").val(datosProducto[0]);
                    $("#Tipo_habitacion").val(datosProducto[1]);
                    $("#Precio").val(datosProducto[2]);
                    $("#Estado_Hab").val(datosProducto[3]);
                    $("#Descripcion").val(datosProducto[4]);
                    $('#btnbuscar').click();

                }
                function mostrarValores2() {
                    datosProducto = document.getElementById('Num_Hab').value.split('_');
                    $("#Num").val(datosProducto[0]);
                    $("#Tipo_habitacion").val(datosProducto[1]);
                    $("#Precio").val(datosProducto[2]);
                    $("#Estado_Hab").val(datosProducto[3]);
                    $("#Descripcion").val(datosProducto[4]);
                }


            </script>
        @endpush
    @endsection
