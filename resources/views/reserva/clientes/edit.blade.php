@extends ('layout.admin')
@section('Contenido')
    <div class="row">
        <div class="col-log-12 col-md-12 col-sm-12 col-xs-12">
            <p class="cabecera">Editar datos del Cliente: {{ $Cliente->Nombre }}</p>
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
    </DIV>
    {!! Form::model($Cliente, ['method' => 'PATCH', 'route' => ['clientes.update', $Cliente->IdCliente]])
    !!}
    {{ Form::token() }}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" required value="{{ $Cliente->Nombre }}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Apellido">Apellido</label>
                <input type="text" name="Apellido" id="Apellido"
                value="{{ $Cliente->Apellido }}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Celular">Celular</label>
                <input type="text" name="Celular" value="{{ $Cliente->Celular }}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Correo">Correo</label>
                <input type="text" name="Correo" value="{{ $Cliente->Correo }}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="TipDocumento">Tipo de Documento</label>
                <select name="TipDocumento" id="TipDocumento" class="form-control selectpicker">
                    @if ($Cliente->TipDocumento == 'PASAPORTE')
                        <option value="DNI">DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="PASAPORTE" selected>PASAPORTE</option>
                    @elseif($Cliente->TipDocumento  == 'RUC')
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
                <label for="NumDocumento">Nro Documento</label>
                <input type="text" name="NumDocumento" value="{{ $Cliente->NumDocumento }}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Direccion">Dirección</label>
                <input type="text" name="Direccion" value="{{ $Cliente->Direccion }}"
                class="form-control"
                placeholder="Ingrese la dirección del Cliente. Ejm {Andahuaylas - Jr. Las Americas 1XX}">
            </div>
        </div>
        <input type="hidden" name="IdTipoCliente" value="1">
        {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Denominacion</label>
                <select name="IdTipoCliente" class="form-control">
                    @foreach ($TipoCliente as $cat)
                        @if ($cat->IdTipoCliente == $Cliente->IdTipoCliente)
                            <option value="{{ $cat->IdTipoCliente }}" selected>{{ $cat->Denominacion }}</option>
                        @else
                            <option value="{{ $cat->IdTipoCliente }}">{{ $cat->Denominacion }}</option>
                        @endif
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

