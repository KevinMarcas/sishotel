@extends('layout.admin')
@Section ('Contenido')
<div class="row">
	<div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
		<p class="cabecera">Agregando Nuevo Producto</p>
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
	</div>
</div>
{!!Form::open(array('url'=>'almacen/producto','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
{{Form::token()}}
<div class="row" id="formulario">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Categoría</label>
			<select name="IdCategoria" class="form-control selectpicker" data-live-search="true">
				@foreach($Categoria as $cat)
					@if(old('IdCategoria') == $cat->IdCategoria)
						<option value="{{$cat->IdCategoria}}" selected>{{$cat->Denominacion}}</option>
					@else
						<option value="{{$cat->IdCategoria}}">{{$cat->Denominacion}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group fg " id="grupo__NombProducto">
			<label for="NombProducto">Nombre Producto</label>
			<p class="formulario__input-error">/ El nombre del Producto tiene que ser de 3 a 30 digitos y solo puede ser letras.</p>
			<div class="formulario__grupo-input">
				<input type="text" name="NombProducto" id="NombProducto" required
				value="{{old('NombProducto')}}" class="form-control"
				placeholder="Ingrese el Nombre del Producto">
				<i class="formulario__validacion-estado fa fa-times-circle"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group fg" id="grupo__Precio">
			<label for="Precio">Precio</label>
			<p class="formulario__input-error">/ El precio debe ser un valor númerico. Ejm 12.34</p>
			<div class="formulario__grupo-input">
				<input type="text" name="Precio" id="Precio" required
				value="{{old('Precio')}}" class="form-control"
				placeholder="Ingrese el Precio del Producto">
				<i class="formulario__validacion-estado fa fa-times-circle"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="Descripcion">Descripción</label>
			<input type="text" name="Descripcion"  value="{{old('Descripcion')}}" class="form-control" placeholder="Descripcion...">
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="Imagen">Imagen</label>
			<input type="file" name="Imagen" class="form-control" required>
		</div>
	</div>
</div>
<div class="form-group">
	<button class="btn btn-primary" type="submit">Guardar</button>
	<a href="{{asset('almacen/producto')}}" class="btn btn-danger">Cancelar</a>
</div>

{!!Form::close()!!}
@endsection
