{!! Form::open(array('url'=>'reserva/listar-registro', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
<div>
   
<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
    <label for="">Nro. Habitación</label>
    <select class="form-control selectpicker searchText" name="searchText" >
        <option value="" >Mostrar Todo</option>
        @foreach ($habitacion as $hab)
        @if ($searchText == $hab->Num_Hab)
            <option value="{{$hab->Num_Hab}}" selected>Habitación: {{$hab->Num_Hab}}</option>
        @else
            <option value="{{$hab->Num_Hab}}" >Habitación: {{$hab->Num_Hab}}</option>
        @endif
        @endforeach
    </select>
        </div>
    </div>
<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
    <label for="">Estado Habitación</label>
    <select class="form-control selectpicker searchText2" name="searchText2" >
    @if ($searchText2 == "HOSPEDAR")
        <option value="" >Mostrar Todo</option>
        <option value="HOSPEDAR" selected>HOSPEDADO</option>
        <option value="RESERVAR" >RESERVADA</option>
        <option value="H. CULMINADO" >H. CULMINADO</option>
    @elseif($searchText2 == "RESERVAR")
        <option value="" >Mostrar Todo</option>
        <option value="HOSPEDAR" >HOSPEDADO</option>
        <option value="RESERVAR" selected>RESERVADA</option>
        <option value="H. CULMINADO" >H. CULMINADO</option>
    @elseif($searchText2 == "H. CULMINADO")
        <option value="" >Mostrar Todo</option>
        <option value="HOSPEDAR" >HOSPEDADO</option>
        <option value="RESERVAR" >RESERVADA</option>
        <option value="H. CULMINADO" selected>H. CULMINADO</option>
    @else
        <option value="" >Mostrar Todo</option>
        <option value="HOSPEDAR" >HOSPEDADO</option>
        <option value="RESERVAR" >RESERVADA</option>
        <option value="H. CULMINADO" >H. CULMINADO</option>
    @endif
    </select>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
    <label for="">F. Entrada/Reserva</label>
    <input type="date" class="form-control" name="searchText3" placeholder="Buscar.." value="{{$searchText3}}">
    </div>
</div>
    <br><button type="submit" class="btn btn-primary" >Buscar</button>
</div>
{{Form::close()}}