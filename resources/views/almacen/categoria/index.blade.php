@extends('layout.admin')
@Section ('Contenido')
<div class="row">
    <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
        <p  class="cabecera">Categorías de Productos</p>
    </div>
</div>
<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-8 col-xs-12">
		<a href="categoria/create">
		<button class="btn btn-success btn-block">Agregar nueva Categoría
		</button></a>
	</div>
</div>
<br>
<div class="row">
	<div class="col-lg-8 col-md-10 col-sm-8 col-xs-12">
		@include('almacen.categoria.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<!-- <th>Id</th> -->
					<th>Denominación</th>
					<th colspan="2">Opciones</th>
				</thead>
               @foreach ($Categoria as $cat)
				<tr>
					<!-- <td>{{$cat->IdCategoria}}</td> -->
                    <td>{{$cat->Denominacion}}</td>
					<td>
						<a href="{{URL::action('CategoriaController@edit',$cat->IdCategoria)}}">
						<button class="btn btn-info" title="Editar {{ $cat->Denominacion }}">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</button></a>
						 
					</td>
					<td>
						<form class="edi" action="{{ URL::action('CategoriaController@destroy', $cat->IdCategoria) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button  class="btn btn-danger  borrar"
							 title="Eliminar {{ $cat->Denominacion }}"
                            data-nombre="{{ $cat->Denominacion }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
					</td>
				</tr>
                @endforeach
			</table>
		</div>
		{{$Categoria->render()}}
	</div>
</div>
@endsection
