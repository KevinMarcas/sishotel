@extends ('layout.admin')
@section ('Contenido')
	<div class="row">
		<div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
			<p  class="cabecera">Editar datos de la Categoría {{ $Categoria->Denominacion}}.</p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($Categoria,['method'=>'PATCH','route'=>['categoria.update',$Categoria->IdCategoria]])!!}
            {{Form::token()}}
			<div class="form-group">
				<input type="hidden" name="IdCategoria" 
				value="{{$Categoria->IdCategoria}}"
				class="form-control">
			</div>
            <div class="form-group">
            	<label for="Denominacion">Denominación</label>
				<input type="text" name="Denominacion" class="form-control" 
				value="{{$Categoria->Denominacion}}" placeholder="Ingrese el nombre de la Denominación.">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<a href="{{asset('almacen/categoria')}}" class="btn btn-danger">Cancelar</a>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection