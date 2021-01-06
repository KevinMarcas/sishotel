@extends ('layout.admin')
@section('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Editar el Nivel de Habitación {{ $Nivel->Denominacion }}</p>
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

            {!! Form::model($Nivel, ['method' => 'PATCH', 'route' => ['nivel.update', $Nivel->IdNivel]]) !!}
            {{ Form::token() }}
            <div class="form-group">
                <input type="hidden" name="Denominacion" class="form-control"
                value="{{ $Nivel->IdNivel }}">
            </div>
            <div class="form-group">
                <label for="Denominacion">Denominación</label>
                <input type="text" name="Denominacion" class="form-control" value="{{ $Nivel->Denominacion }}"
                    placeholder="Denominacion...">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a href="{{asset('mantenimiento/nivel')}}" class="btn btn-danger">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
