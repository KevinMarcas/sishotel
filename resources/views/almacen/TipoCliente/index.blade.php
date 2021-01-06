@extends('layout.admin')
@Section ('Contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de TipoCliente <a href="TipoCliente/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.TipoCliente.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Denominacion</th>
				</thead>
               @foreach ($TipoCliente as $cat)
				<tr>
					<td>{{$cat->IdTipoCliente}}</td>
                    <td>{{$cat->Denominacion}}</td>
					<td>
						<a href="{{URL::action('TipoClienteController@edit',$cat->IdTipoCliente)}}"><button class="btn btn-info">Editar</button></a>
						 <form class="edi" action="{{ URL::action('TipoClienteController@destroy', $cat->IdTipoCliente) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button  class="btn btn-danger  borrar" title="Eliminar {{ $cat->Denominacion }}"
                                        data-nombre="{{ $cat->Denominacion }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
					</td>
				</tr>
                @endforeach
			</table>
		</div>
		{{$TipoCliente->render()}}
	</div>
</div>
@endsection
