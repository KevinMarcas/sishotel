@extends('layout.admin')
@Section ('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Agregando nueva Habitación</p>
        </div>
    </div>
    <div class="row">
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
    {!! Form::open(['url' => 'mantenimiento/habitacion', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true'])
    !!}
    {{ Form::token() }}
    <div class="row" id="formulario">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group fg" id="grupo__Num_Hab">
                <label for="Num_Hab">Nro de Habitación</label>
                <p class="formulario__input-error">El valor del campo debe ser un número >= 1</p>
                <div class="formulario__grupo-input">
                    <input type="text" name="Num_Hab" id="Num_Hab"
                    value="{{ old('Num_Hab') }}" class="form-control fi"
                    placeholder="Ingrese un número de Habitación">
                    <i class="formulario__validacion-estado fa fa-times-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Descripcion">Detalles</label>
                <input type="text" name="Descripcion" value="{{ old('Descripcion') }}" class="form-control"
                    placeholder="Escriba una breve descripción de las caracteristicas de la Habitación.">
            </div>
        </div>
        {{-- Oculto Estado --}}
            <div class="form-group">
                <input type="hidden" name="Estado" value="DISPONIBLE" class="form-control" placeholder="Estado...">
            </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Precio">Precio</label>
                <input type="text" name="Precio" value="{{ old('Precio') }}"
                class="form-control" placeholder="Ingrese el Precio por noche de la Habitacion">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Tipo Habitación</label>
                <select name="IdTipoHabitacion" class="form-control selectpicker">
                    @foreach ($TipoHabitacion as $cata)
                        <option value="{{ $cata->IdTipoHabitacion }}">{{ $cata->Denominacion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Nivel/Piso</label>
                <select name="IdNivel" class="form-control selectpicker">
                    @foreach ($Nivel as $cat)
                        <option value="{{ $cat->IdNivel }}">{{ $cat->Denominacion }}</option>
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
