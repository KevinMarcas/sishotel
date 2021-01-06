@extends ('layout.admin')
@Section ('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Editar datos de la Habitación Nro {{ $Habitacion->Num_Hab }}</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            @if (count($errors) > 0)
                <div class="alert bg-danger text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    {!! Form::model($Habitacion, ['method' => 'PATCH', 'route' => ['habitacion.update', $Habitacion->Num_Hab], 'files' =>
    'true']) !!}
    {{ Form::token() }}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <input type="hidden" name="Num_Hab_a" value="{{ $Habitacion->Num_Hab }}">
            <div class="form-group">
                <label for="Num_Hab">Num_Hab</label>
                <input type="text" name="Num_Hab" required value="{{ $Habitacion->Num_Hab }}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Descripcion">Detalles</label>
                <input type="text" name="Descripcion"
                required value="{{ $Habitacion->Descripcion }}"
                placeholder="Escriba una breve descripción de las caracteristicas de la Habitación." class="form-control">
            </div>
        </div>
            <input type="hidden" name="Estado" required value="{{ $Habitacion->Estado }}" class="form-control">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Precio">Precio</label>
                <input type="text" name="Precio" required value="{{ $Habitacion->Precio }}"
                placeholder="Ingrese el Precio por noche de la Habitacion."
                class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Tipo Habitación</label>
                <select name="IdTipoHabitacion" class="form-control selectpicker">
                    @foreach ($TipoHabitacion as $cata)
                        @if ($cata->IdTipoHabitacion == $Habitacion->Num_Hab)
                            <option value="{{ $cata->IdTipoHabitacion }}" selected>{{ $cata->Denominacion }}</option>
                        @else
                            <option value="{{ $cata->IdTipoHabitacion }}">{{ $cata->Denominacion }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Nivel/Piso</label>
                <select name="IdNivel" class="form-control selectpicker">
                    @foreach ($Nivel as $cat)
                        @if ($cat->IdNivel == $Habitacion->Num_Hab)
                            <option value="{{ $cat->IdNivel }}" selected>{{ $cat->Denominacion }}</option>
                        @else
                            <option value="{{ $cat->IdNivel }}">{{ $cat->Denominacion }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <a href="{{asset('mantenimiento/habitacion')}}" class="btn btn-danger">Cancelar</a>
    </div>
    {!! Form::close() !!}
@endsection
