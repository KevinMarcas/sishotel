@extends ('layout.admin')
@section('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Editar datos del tipo de habitación: {{ $TipoHabitacion->Denominacion }}</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($TipoHabitacion, ['method' => 'PATCH', 'route' => ['tipo_habitacion.update',
            $TipoHabitacion->IdTipoHabitacion]]) !!}
            {{ Form::token() }}
            <div class="form-group">
            <input type="hidden" name="IdTipoHabitacion"
            value="{{$TipoHabitacion->IdTipoHabitacion}}">
            </div>
            <div class="form-group">
                <label for="Denominacion">Denominación</label>
                <input type="text" name="Denominacion" class="form-control"
                value="{{ $TipoHabitacion->Denominacion }}"
                    placeholder="Ingrese el nombre del Tipo de Habitación.">
            </div>
            <div class="form-group">
                <label for="Descripcion">Descripción</label>
                <input type="text" name="Descripcion" class="form-control" value="{{ $TipoHabitacion->Descripcion }}"
                    placeholder="Puede describir brevemente las caracteristicas de este tipo de habitación.">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a href="{{asset('mantenimiento/tipo_habitacion')}}" class="btn btn-danger">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
