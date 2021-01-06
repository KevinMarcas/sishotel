{!! Form::open(['url' => 'reserva/registro', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search']) !!}
<div class="row">
    <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
        @if ($searchText != '')
                <p class="cabecera">Habitaciones del {{ $searchText }}</p>
            @else
                <p class="cabecera">Se muestran todas las Habitaciones</p>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-log-4 col-md-4 col-sm-8 col-xs-12">
        <div class="form-group">
            <select name="searchText" class="form-control selectpicker  searchText">
                <option value="">Seleccione el Nivel/Piso</option>
                @foreach ($nivel as $n)
                    @if ($n->Denominacion == $searchText)
                        <option value="{{ $n->Denominacion }}" selected>{{ $n->Denominacion }}</option>
                    @else
                        <option value="{{ $n->Denominacion }}">{{ $n->Denominacion }}</option>
                    @endif
                @endforeach
            </select>

            <span class="input-group-btn">
                <button type="submit" id="buscar" class="btn btn-primary"> </button>
            </span>

            <!-- <input type="text" class="form-control" name="searchText" placeholder="Buscar.." value="{{ $searchText }}"> -->

        </div>
    </div>
</div>

{{ Form::close() }}
