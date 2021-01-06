@extends ('layout.admin')
@section ('Contenido')
{{-- <div class="row">
    <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
        <p class="cabecera">Gráfico del Estado de las Habitaciones</p>
    </div>
</div> --}}

     <!-- <h3>Listado de las Mesa <a href="mesa/create"><button class="btn btn-success">Nuevo</button></h3></a> -->
    @include('reserva.registro.search')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table >
            <tr>
            @php($contador = 0)
            @foreach ($habitacion as $h)
                    <td>
                @if ($h->Estado == "RESERVADO")
                    <div class="estado_habitacion_r" data-title="Para modificar dirijase al Listado de Registros">
                    <a href="#">
                    {{-- <a href="{{URL::action('ReservaController@edit', $h->Num_Hab)}}"> --}}
                    Habitación {{$h->tipoden}} @php($contador += 1)
                    <p><font style="font-size: 1.7em"> Nro:{{ $h->Num_Hab}}</font> <img src="{{asset('img/icono3.png')}}"  width="60" alt="imagen"></p>
                    <p class="estado_r">{{ $h->Estado}} </p>
                    </div>
                @elseif ($h->Estado == "OCUPADO")
                    <div class="estado_habitacion_o" data-title="Para modificar dirijase al Listado de Registros">
                    {{-- <a href="{{URL::action('ReservaController@edit', $h->Num_Hab)}}"> --}}
                    <a href="#">
                    Habitación {{$h->tipoden}} @php($contador += 1)
                    <p><font style="font-size: 1.7em"> Nro:{{ $h->Num_Hab}}</font> <img src="{{asset('img/icono2.png')}}" width="60" alt="imagen"></p>
                    <p class="estado_r">{{ $h->Estado}}</p>
                    </div>
                @elseif ($h->Estado == "DISPONIBLE")
                <div class="estado_habitacion_d" data-title="Precio: S/ {{$h->Precio}}">
                    <a href="{{URL::action('ReservaController@CrearReserva', $h->Num_Hab)}}">
                    Habitación <font> {{$h->tipoden}} @php($contador += 1)</font>
                    <p><font style="font-size: 1.7em"> Nro:{{ $h->Num_Hab}}</font><img src="{{asset('img/icono1.png')}}" width="60" alt="imagen"></p>
                    <p class="estado_d">{{ $h->Estado}}</p>
                    </div>
                @else
                    <div class="estado_habitacion_l"
                    data-nombre="{{$h->Num_Hab}}"
                    data-title="Habitación en Limpieza">
                    <a>
                    Habitación <font>{{ $h->Num_Hab}} @php($contador += 1)</font>
                    <p><font style="font-size: 1.7em"> Nro:{{ $h->Num_Hab}}</font>
                    <img src="{{asset('img/icono4.png')}}" width="60" alt="imagen"></p>
                    <p class="estado_d">{{ $h->Estado}}</p>
                    </div>
                @endif

                </a>
                </td>

                 @if (($contador % 5) == 0)
                 </tr>
                @endif

            @endforeach
            </table>
        </div>

        {{$habitacion->render()}}
    </div>
</div>
<script>

    const selectElement = document.querySelector('.searchText');
    selectElement.addEventListener('change', (event) => {
        $("#buscar").click();
    });

</script>

@endsection
