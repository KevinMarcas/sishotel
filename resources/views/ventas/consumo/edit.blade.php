@extends ('layout.admin')
@section ('Contenido')
<div class="row">
    <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
        <p class="cabecera">Agregando nueva Venta</p>
    </div>
</div>
<div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="Num_Hab">Nro Habitación</label>
            <p>{{$reserva->Num_Hab}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="Precioxdia">Precio por día</label>
            <p>S/ {{$reserva->prehab}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="Tipo">Tipo</label>
            <p>{{$reserva->Denominacion}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="proveedor">N° Documento Cliente</label>
            <p>{{$reserva->Ndcliente}}</p>

        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="proveedor">Cliente</label>
            <p>{{$reserva->nomcli}} {{$reserva->apecli}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="Celular">Nro Celular</label>
            <p>{{$reserva->Celular}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="FechEntrada">Fecha Entrada</label>
            <p>{{$reserva->FechEntrada}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="FechSalida">Fecha Prevista de Salida</label>
            <p>{{$reserva->FechSalida}}</p>
        </div>
    </div>


<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
    {!!Form::model($reserva,['method'=>'PATCH','route'=>['consumo.update',$reserva->IdReserva]])!!}
    {{Form::token()}}
        <div class="form-group">
            <input type="hidden" name="IdReserva"
            class="form-control" value="{{$reserva->IdReserva}}">
        </div>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Producto</label>
                    <select name="IdProducto" class="form-control selectpicker" data-live-search="true" id="IdProducto" >
                        <!-- <option>--Selecionar--</option> -->
                        @foreach($producto as $pro)
                        <option value="{{$pro->IdProducto}}_{{$pro->Precio}}"> {{$pro->NombProducto}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="Cantidad" id="Cantidad" class="form-control"
                placeholder="Cantidad">
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" name="Precio" id="Precio" class="form-control" disabled
                placeholder="precio">
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <br>
                    <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #ffded9;">
                        <th style="text-align:center;">Opciones</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </thead>
                    <tfoot>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> <h4 id="total">S/. 0.00</h4> <input type="hidden" id="Total" name="Total">
                            <p><input type="radio" name="Estado" value="PAGADO" required> PAGAR AHORA</p>
                            <input type="radio" name="Estado" value="FALTA PAGAR" required> PAGAR LUEGO
                        </td>
                    </tfoot>


                </table>

            </div>
        </div>

    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <td colspan="4"><a href="{{asset('ventas/consumo')}}" class="btn btn-danger">Volver Atras</a></td>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"  ></input>
            <button class="btn btn-primary" type="submit" id="guardar" style="float: right">
            Agregar Nueva Venta
            </button>
        </div>
    </div>
</div>



{!!Form::close()!!}

@push ('scripts')
<script>
    $(document).ready(function(){
        $('#bt_add').click(function(){
            agregar();
            mostrarValores();
        });
    });
    var cont = 0;
    total = 0;
    subtotal=[];
    $("#guardar").hide();

// Código para mostrar valores extra en un select "PLATO"
mostrarValores();
    $("#IdProducto").change(mostrarValores);
    function mostrarValores(){
        datosProducto = document.getElementById('IdProducto').value.split('_');
        $("#Precio").val(datosProducto[1]);
    }

// Seleccionar un valor idcliente
// document.getElementById('IdCliente').options.selectedIndex = 1;
// Código para cargar los datos direccion, latitud, longitud


mostrarValoresC();
// Código para mostrar valores extra en un select "Cliente"
    $("#IdCliente").change(mostrarValoresC);
    function mostrarValoresC(){
        datosCliente = document.getElementById('IdCliente').value.split('_');
        $("#Direccion").val(datosCliente[1]);
        $("#Latitud").val(datosCliente[2]);
        $("#Longitud").val(datosCliente[3]);

        // canbiar la posicion en el mapa



    }

    function agregar(){
        datosProducto = document.getElementById('IdProducto').value.split('_');
        idproducto = datosProducto[0];
        articulo = $("#IdProducto option:selected").text();
        cantidad = $("#Cantidad").val();
        precio = $("#Precio").val();


        if (idproducto != "" && cantidad != "" && cantidad > 0 && precio != "" ) {
            subtotal[cont]=(cantidad*precio);cantidad
            total = total + subtotal[cont];

            var fila='<tr class="selected" id="fila' + cont +
            '"><td style="text-align:center;"><button type ="button" class="bn btn quitar" onclick="eliminar('+ cont +')">'+
            '<i class="fa fa-minus-circle" aria-hidden="true"></i>'+
            '</button></td>'+
            '<td><input type="hidden" name="idproducto[]" value="'+ idproducto +'"> '+ articulo
            +'</td><td><input type="text" readonly name="cantidad[]" value="'+ cantidad
            +'"></td><td><input type="text" disabled name="precio[]" value="'+ precio
            +'"></td><td><input type="hidden" readonly name="precio_venta[]" value="'+ subtotal[cont]
            +'">'+ 'S/ ' + subtotal[cont].toFixed(2) +'</td></tr>';
            cont ++;
            limpiar();
            $("#total").html("S/. " + total.toFixed(2));
            $("#Total").val(total);
            evaluar();
            $('#detalles').append(fila);
        }else{
            alert("Error al ingresar el detalle del Pedido, revise los datos del plato");
        }
    }

    function limpiar (){
        $("#cantidad").val("");
        $("#Precio").val("");

    }
    function evaluar (){
        if (total > 0) {
            $("#guardar").show();
        }else {
            $("#guardar").hide();

        }

    }
    function eliminar(index){
        total=total-subtotal[index];
        $("#total").html("S/ " + total);
        $("#fila" + index).remove();
        evaluar();
    }


</script>

@endpush

@endsection
