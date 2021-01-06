@extends ('layout.admin')
@section ('Contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar TipoCliente: {{ $TipoCliente->Denominacion}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($TipoCliente,['method'=>'PATCH','route'=>['TipoCliente.update',$TipoCliente->IdTipoCliente]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="Denominacion">Denominacion</label>
            	<input type="text" name="Denominacion" class="form-control" value="{{$TipoCliente->Denominacion}}" placeholder="Denominacion...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection