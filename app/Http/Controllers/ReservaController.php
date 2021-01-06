<?php

namespace App\Http\Controllers;
date_default_timezone_set('America/Lima');
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Habitacion;
use App\Reserva;
use App\Pago;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ReservaFormRequest;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ReservaController extends Controller
{
    public function __contruct(){

    }

    public function index(Request $request){
        if ($request){

            $query=trim($request->get('searchText'));


            $reserva=DB::table('reserva as r')
            ->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')
            ->join('cliente as c', 'r.IdCliente', '=', 'c.IdCliente')
            ->join('usuario as u', 'r.IdUsuario', '=', 'u.IdUsuario')
            ->select('IdReserva', 'r.IdCliente', 'FechEntrada','FechSalida', 'CostoAlojamiento','Observacion', 'r.Estado as EsReser',
            'r.Num_Hab', 'u.NumDocumento', 'u.Nombre', 'c.Nombre as nomcli', 'c.Apellido as apecli');
            $reserva = $reserva->get();

            $nivel=DB::table('nivel as n')
            ->select('IdNivel', 'Denominacion');
            $nivel = $nivel->get();

            $habitacion=DB::table('habitacion as h')
            ->join('nivel as n', 'h.IdNivel', '=', 'n.IdNivel')
            ->join('tipohabitacion as t', 'h.IdTipoHabitacion', '=', 't.IdTipoHabitacion')
            ->select('Num_Hab', 'h.Descripcion', 'Estado','Precio', 'n.Denominacion as nivelden',
             't.Denominacion as tipoden')
            ->where('n.Denominacion', 'LIKE','%'.$query.'%')
            ->paginate(14);
            return view('reserva.registro.index',["reserva"=>$reserva, "habitacion"=>$habitacion,"nivel"=>$nivel,"searchText"=>$query]);
        }
    }

    public function CrearReserva($id){
        // $Habitacion = Habitacion::findOrFail($id);
        $Habitacion = DB::table('habitacion as h')
        ->join('nivel as n', 'h.IdNivel', '=', 'n.IdNivel')
        ->join('tipohabitacion as t', 'h.IdTipoHabitacion', '=', 't.IdTipoHabitacion')
        ->select('Num_Hab', 'h.Descripcion as deshab', 'Estado','Precio', 'n.Denominacion as nivelden',
        't.Denominacion as tipoden')
        ->where('Num_Hab','=', $id)
        ->first();
        // $Habitacion=DB::table('Habitacion')
        // ->get();
        // Generamos la reserva para el autoincrement
        $Reserva=DB::table('Reserva')
        ->orderBy('IdReserva','desc')
        ->limit(1);
        $Reserva = $Reserva->first();



        $Cliente=DB::table('Cliente')
        ->get();
        $Usuario=DB::table('Usuario')
        ->where('IdUsuario', '=','1')
        ->get();
        return view("reserva.registro.create",["Habitacion"=>$Habitacion,"Reserva"=>$Reserva,
         "Cliente"=>$Cliente, "Usuario"=>$Usuario]);

    }

    public function store (ReservaFormRequest $request) {
        try{
            $mytime = Carbon::now('America/Lima');
        $Reserva = new Reserva;
        $indicador = $request->get ('Estado');
        if ($indicador == "RESERVAR"){
            $Reserva -> FechReserva =$request -> get ('FechReserva');

            // $Reserva -> FechEntrada = "";
            $ES  = "RESERVADO";
        }else if ($indicador == "HOSPEDAR"){
            $Reserva -> FechEntrada =$request -> get ('FechReserva');
            $Reserva -> FechReserva =$mytime->toDateTimeString();
            // $Reserva -> FechReserva = "";
            $ES  = "OCUPADO";
        }
        $cod = $request -> get('codigo');
         if (is_numeric($cod)){
             $codigo_mas_uno = $cod + 1;
             $cod = str_pad($codigo_mas_uno, 10, "0", STR_PAD_LEFT);
         }else{
             $cod = "0000000001";
         }
        $Reserva -> IdReserva =$cod;
        $Reserva -> FechSalida =$request -> get ('FechSalida');
        $Reserva -> CostoAlojamiento =$request -> get ('CostoAlojamiento');
        $Reserva -> Observacion =$request -> get ('Observacion');
        $Reserva -> Estado =$request -> get ('Estado');
        $Reserva -> IdCliente =$request -> get ('IdCliente');
        $Reserva -> Num_Hab =$request -> get ('Num_Hab');
        $Reserva -> IdUsuario ="1";
         // Pago


        // //
        $Reserva -> save();

        $Pago = new Pago;
        $mytime = Carbon::now('America/Lima');
        $Pago -> FechaPago = $mytime->toDateTimeString();
        $Pago -> TotalPago = $request -> get ('Adelanto');
        if ($request -> get ('CostoAlojamiento') == $request -> get ('Adelanto')){
            $Pago -> Estado = "PAGADO";
        }else{
            $Pago -> Estado = "FALTA PAGAR";
        }
        $Pago -> IdReserva = $cod;
        $Pago -> save();

        $Habitacion=Habitacion::findOrFail($request->get('Num_Hab'));
        $Habitacion->Estado= $ES;
        $Habitacion->update();

        return Redirect::to('reserva/registro');

        }catch(\Exception $e){
            echo "Ocurrio un error";
        }


        // echo $cod;
    }
    public function edit($id){
        $Habitacion = DB::table('habitacion as h')
        ->join('nivel as n', 'h.IdNivel', '=', 'n.IdNivel')
        ->join('tipohabitacion as t', 'h.IdTipoHabitacion', '=', 't.IdTipoHabitacion')
        ->select('Num_Hab', 'h.Descripcion as deshab', 'Estado','Precio', 'n.Denominacion as nivelden',
        't.Denominacion as tipoden')
        ->where('Num_Hab','=', $id)
        ->first();

        $Cliente=DB::table('Cliente')
        ->get();
        $reserva=DB::table('Reserva')
        ->where('Num_Hab', '=', $id)
        ->where('Estado', '!=', 'H. CULMINADO')
        ->orderBy('Estado','asc')
        ->orderBy('IdReserva','asc')
        ->first();

        $pago=DB::table('Pago as p')
        ->join('reserva as r', 'p.IdReserva', '=', 'r.IdReserva')
        ->where('r.Num_Hab', '=', $id)
        ->first();

        return view("reserva.registro.edit",["Habitacion"=>$Habitacion,"reserva"=>$reserva,
        "Cliente"=>$Cliente, "pago"=>$pago]);
    }

    public function update(ReservaFormRequest $request, $id){
        $Reserva=Reserva::findOrFail($id);
        $indicador = $request->get ('Estado');
        if ($indicador == "RESERVAR"){
            $Reserva -> FechReserva =$request -> get ('FechReserva');
            $ES  = "RESERVADO";
        }else if ($indicador == "HOSPEDAR"){
            $Reserva -> FechReserva =$request -> get ('FechReserva');
            $Reserva -> FechEntrada =$request -> get ('FechReserva');
            $ES  = "OCUPADO";
        }
        $Reserva -> FechSalida =$request -> get ('FechSalida');
        $Reserva -> CostoAlojamiento =$request -> get ('CostoAlojamiento');
        $Reserva -> Observacion =$request -> get ('Observacion');
        $Reserva -> Estado =$request -> get ('Estado');
        $Reserva -> IdCliente =$request -> get ('IdCliente');
        $Reserva -> Num_Hab =$request -> get ('Num_Hab');
        $Reserva -> IdUsuario ="1";
        $Reserva->update();

        $Pago=Pago::findOrFail($request->get('IdPago'));
        $mytime = Carbon::now('America/Lima');
        $Pago -> FechaPago = $mytime->toDateTimeString();
        $Pago -> TotalPago = $request -> get ('Adelanto');
        if ($request -> get ('CostoAlojamiento') == $request -> get ('Adelanto')){
            $Pago -> Estado = "PAGADO";
        }else{
            $Pago -> Estado = "FALTA PAGAR";
        }
        $Pago -> update();

        $Habitacion=Habitacion::findOrFail($request->get('Num_Hab'));
        $Habitacion->Estado= $ES;
        $Habitacion->update();

        return Redirect::to('reserva/registro');
    }

    public function show ($id){
        $n_id = substr($id, 1);
        $Habitacion=Habitacion::findOrFail($n_id);

        //Verificamos la existencia de alguna reserva de la habitación
        $reserva = DB::table('reserva as r')
        ->where('r.Num_Hab', '=', $n_id)->where('r.FechReserva', ">=", date('Y-m-d'))->where('r.Estado','=','RESERVAR')
        ->first();
        if (!isset($reserva->IdReserva)){
            $Habitacion->Estado= "DISPONIBLE";
        }else {
            $Habitacion->Estado= "RESERVADO";
        }
        $Habitacion->update();
        return Redirect::to('reserva/registro');
    }
}
