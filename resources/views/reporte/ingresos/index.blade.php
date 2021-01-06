@extends('layout.admin')
@Section ('Contenido')
<div class="row">
    <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
        <p  class="cabecera">Reporte Diario</p>
    </div>
</div>
<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-8 col-xs-12">

	</div>
</div>
<br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					{{-- <th>Id</th> --}}
					<th>N°</th>
                    <th>Habitación</th>
                    <th>Fecha Ingreso</th>
                    <th>Fecha Salida</th>
                    <th>Dinero Dejado</th>
				</thead>
				@php($contador = 0)
				   @foreach ($pago as $p)
				   @php($contador += 1)
				<tr>
					<td>{{$contador}}</td>
                    <td>{{$p->Num_Hab}}</td>
                    <td>{{$p->FechEntrada}}</td>
                    <td>{{$p->FechSalida}}</td>
					<td>S/ {{$p->TotalPago}}</td>
				</tr>
                @endforeach
			</table>
		</div>
		{{$pago->render()}}
	</div>
</div>
@endsection
