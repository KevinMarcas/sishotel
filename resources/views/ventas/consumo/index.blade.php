@extends ('layout.admin')
@section ('Contenido')
<div class="row">
    <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
        <p class="cabecera">Agregar nueva Venta - Gráfico de Habitaciones Ocupadas</p>
    </div>
</div>
<div class="row">
@php($contador = 0)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table>
            <tr>
            @foreach ($reserva as $r)
                <td >
                    <div class="estado_habitacion_o"
                    data-title="Vender a Habitación Nro:{{$r->Num_Hab}}?" >
                    <a href="{{URL::action('ConsumoController@edit', $r->IdReserva)}}">
                    Habitación {{ $r->Denominacion}} @php($contador += 1)
                    <p><span style="font-size: 2em"> Nro:{{ $r->Num_Hab}}</span><img src="{{asset('img/icono2.png')}}" width="40" alt="imagen"></p>
                    <p class="estado_r">OCUPADO</p>
                    </div>
                </a>
                </td>
                 @if (($contador % 5) == 0)
                 </tr>
                @endif
            @endforeach
            </table>
        </div>

        {{$reserva->render()}}
    </div>
</div>
@endsection
