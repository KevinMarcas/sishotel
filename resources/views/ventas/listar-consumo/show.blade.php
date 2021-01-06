@extends ('layout.admin')
@section('Contenido')

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="proveedor">N° DNI</label>
                    <p>{{ $Datos->NumDocumento }}</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="proveedor">Cliente</label>
                    <p>{{ $Datos->Nombre }} {{ $Datos->Apellido }}</p>

                </div>
            </div>
            <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="proveedor">Nro Celular</label>
                    <p>{{ $Datos->Celular }}</p>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-body">


                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #fadcd3;">


                            <th>Fecha de Consumo</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <!-- <th>Detalles</th> -->
                            <th>Subtotal</th>
                        </thead>

                        </tbody>
                        <tbody>
                            @php($total = 0)
                            @foreach ($Consumo as $co)
                                <tr>
                                    <td>{{$co->FechConsumo}}</td>
                                    <td>{{ $co->NombProducto }}</td>
                                    <td>{{ $co->Cantidad }}</td>
                                    <td>S/ {{ number_format($co->Total / $co->Cantidad,2)}}</td>
                                    <td>S/ {{ number_format($co->Total,2) }}</td>
                                </tr>
                                @php($total+= $co->Total)
                            @endforeach
                        </tbody>
                        <tbody>

                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                             <th></th>
                            <th>
                                <h4 id="total">S/ {{ number_format($total,2)}}</h4>
                            </th>


                            <tr>
                                <td colspan="4">
                                    <a href="{{ asset('ventas/listar-consumo') }}" class="btn btn-danger">Volver Atras</a>
                                </td>
                            </tr>


                    </table>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    {{-- <a
                        href="{{ URL::action('LConsumoController@report', $Datos->IdReserva) }}"><button
                            class="btn btn-info">Ver</button></a> --}}
                </div>
            </div>

        </div>

    </div>


@endsection
