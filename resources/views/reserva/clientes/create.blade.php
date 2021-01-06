@extends('layout.admin')
@Section ('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Agregando nuevo Cliente</p>
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
    {!! Form::open(['url' => 'reserva/clientes', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true']) !!}
    {{ Form::token() }}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Nombre">Nombres</label>
                <input type="text" name="Nombre" value="{{ old('Nombre') }}" class="form-control"
                    placeholder="Ingrese los nombres del Cliente / Razón Social de la Empresa">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Apellido">Apellidos</label>
                <input type="text" name="Apellido" id="Apellido" value="{{ old('Apellido') }}" class="form-control"
                    placeholder="Ingrese los Apellidos del Cliente">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Celular">Celular</label>
                <input type="text" name="Celular" value="{{ old('Celular') }}" class="form-control"
                    placeholder="Ingrese el Nro de Celular/Teléfono del Cliente">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Correo">Correo</label>
                <input type="text" name="Correo" value="{{ old('Correo') }}" class="form-control"
                    placeholder="Ingrese el correo electrónico del Cliente">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="TipDocumento">Tipo de Documento</label>
                <select name="TipDocumento" id="TipDocumento" class="form-control selectpicker">
                    @if (old('TipDocumento') == 'PASAPORTE')
                        <option value="DNI">DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="PASAPORTE" selected>PASAPORTE</option>
                    @elseif(old('TipDocumento') == 'RUC')
                        <option value="DNI">DNI</option>
                        <option value="RUC" selected>RUC</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                    @else
                        <option value="DNI" selected>DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="NumDocumento">Nro de Documento</label>
                <input type="text" name="NumDocumento" value="{{ old('NumDocumento') }}" class="form-control"
                    placeholder="Ingrese el Nro de Documento según el Tipo de Documento seleccionado.">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Direccion">Dirección</label>
                <input type="text" name="Direccion" value="{{ old('Direccion') }}" class="form-control"
                    placeholder="Ingrese la dirección del Cliente. Ejm {Andahuaylas - Jr. Las Americas 1XX}">
            </div>
        </div>
        <input type="hidden" name="IdTipoCliente" value="1">
        {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Tipo Cliente</label>
                <select name="IdTipoCliente" class="form-control">
                    @foreach ($TipoCliente as $cat)
                        <option value="{{ $cat->IdTipoCliente }}">{{ $cat->Denominacion }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <a href="{{ asset('reserva/clientes') }}" class="btn btn-danger">Cancelar</a>
    </div>

    {!! Form::close() !!}
    @push ('scripts')
    <script>
        $(function() {
            if (document.getElementById("TipDocumento").value == 'RUC') {
                $("#Apellido").attr("readOnly", 1);
                document.getElementById("Apellido").value = ".";
            }
        });


        const selectElement = document.querySelector('#TipDocumento');
        selectElement.addEventListener('change', (event) => {
            if (event.target.value === "RUC") {
                $("#Apellido").attr("readOnly", 1);
                document.getElementById("Apellido").value = ".";
            } else {
                $("#Apellido").removeAttr("readOnly");
                document.getElementById("Apellido").value = "";
            }
        })

    </script>
@endpush
@endsection

