@extends('layout.admin')
@Section ('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p  class="cabecera">Agregando un nuevo Nivel de Habitación</p>
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

            {!! Form::open(['url' => 'mantenimiento/nivel', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            {{ Form::token() }}
            <div class="form-group">
                <label for="Denominacion">Denominación</label>
                <input type="text" name="Denominacion" class="form-control"
            placeholder="Ingresar la Denominación del Nivel" value="{{ old('Denominacion')}}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a href="{{asset('mantenimiento/nivel')}}" class="btn btn-danger">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
