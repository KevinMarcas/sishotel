{!! Form::open(array('url'=>'mantenimiento/habitacion','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
        <input type="text" class="form-control" name="searchText"
        placeholder="Puede buscar por {Tipo Habitación}, {Nivel/Piso} o {Descripción}" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}
