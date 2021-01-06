<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Reserva;
use App\Pago;
use App\Habitacion;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ReservaFormRequest;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
class LreservaController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request){
        date_default_timezone_set('America/Lima');

       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $query2 = trim ($request -> get('searchText2'));
            $query3 = trim ($request -> get('searchText3'));
            if ($query == ""){
                $reserva=DB::table('reserva as r')->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')->join('cliente as c', 'r.IdCliente', '=', 'c.IdCliente')->join('usuario as u', 'r.IdUsuario', '=', 'u.IdUsuario')
                ->select('IdReserva', 'r.IdCliente', 'FechEntrada','FechSalida', 'CostoAlojamiento','Observacion', 'FechReserva', 'r.Estado as EsReser',
                'r.Num_Hab', 'u.NumDocumento', 'u.Nombre', 'c.Nombre as nomcli', 'c.Apellido as apecli',
                'c.NumDocumento as docli', 'c.Celular', 'r.Num_Hab', 'Observacion')
                ->where('r.Num_Hab', 'LIKE', '%'. $query . '%')
                ->where('r.Estado', 'LIKE', '%' . $query2 . '%')
                ->where('FechReserva', 'LIKE', '%' . $query3 . '%')
                ->orderBy('r.FechReserva', 'desc')
                ->paginate(7);
            }else{
                $reserva=DB::table('reserva as r')->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')->join('cliente as c', 'r.IdCliente', '=', 'c.IdCliente')->join('usuario as u', 'r.IdUsuario', '=', 'u.IdUsuario')
                ->select('IdReserva', 'r.IdCliente', 'FechEntrada','FechSalida', 'CostoAlojamiento','Observacion', 'FechReserva', 'r.Estado as EsReser',
                'r.Num_Hab', 'u.NumDocumento', 'u.Nombre', 'c.Nombre as nomcli', 'c.Apellido as apecli',
                'c.NumDocumento as docli', 'c.Celular', 'r.Num_Hab', 'Observacion')
                ->where('r.Num_Hab', '=', $query)
                ->where('r.Estado', 'LIKE', '%' . $query2 . '%')
                ->where('FechReserva', 'LIKE', '%' . $query3 . '%')
                ->orderBy('r.FechReserva', 'desc')
                ->paginate(7);
            }

            $habitacion=DB::table('habitacion as h')
            ->get();
          return view('reserva.listar-registro.index',["reserva"=>$reserva, "habitacion"=>$habitacion,
          "searchText"=>$query, "searchText2"=>$query2,"searchText3"=>$query3]);
          }
    }

    public function create(Request $request){
        if($request){
            $query = trim ($request -> get('searchText'));

            $Habitacion = DB::table('habitacion as h')
            ->join('nivel as n', 'h.IdNivel', '=', 'n.IdNivel')
            ->join('tipohabitacion as t', 'h.IdTipoHabitacion', '=', 't.IdTipoHabitacion')
            ->select('Num_Hab', 'h.Descripcion as deshab', 'Estado','Precio',
            'n.Denominacion as nivelden',
            't.Denominacion as tipoden');
            $Habitacion = $Habitacion->get();

            $Cliente=DB::table('Cliente')
            ->get();


            $new_query = explode("_", $query);

            $reserva=DB::table('Reserva')
            ->where('Num_Hab', '=', $new_query[0])
            ->where('Estado', '!=', 'H. CULMINADO')
            ->orderBy('FechReserva')
            ->get();

            // Generamos la reserva para el autoincrement
            $Reserva2=DB::table('Reserva')
            ->orderBy('IdReserva','desc')
            ->limit(1);
            $Reserva2 = $Reserva2->first();

            return view("reserva.listar-registro.create",["Habitacion"=>$Habitacion,
            "Cliente"=>$Cliente, "reserva"=>$reserva, "Reserva2"=>$Reserva2,
            "searchText"=>$new_query[0]]);
        }


    }

    public function store(ReservaFormRequest $request){
        $estado_habitacion =  DB::table('habitacion as h')
        ->where('Num_Hab', '=', $request->get('Num_Hab'))
        ->first();

        $Reserva = new Reserva;
        $mytime = Carbon::now('America/Lima');
        $indicador = $request->get ('Estado');
        if ($indicador == "RESERVAR"){
            $Reserva -> FechReserva =$request -> get ('FechReserva');
            if ($estado_habitacion->Estado == "OCUPADO"){
                $ES  = "OCUPADO";
            }else {
                $ES  = "RESERVADO";
            }

        }else if ($indicador == "HOSPEDAR"){

            $Reserva -> FechReserva =$mytime->toDateTimeString();
            $Reserva -> FechEntrada =$request -> get ('FechReserva');
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
        $cod = $request -> get ('codigo');
        if (is_numeric($cod)){
            $codigo_mas_uno = $cod + 1;
            $cod = str_pad($codigo_mas_uno, 10, "0", STR_PAD_LEFT);
        }else{
            $cod = 1;
        }
        //
        $Reserva -> save();

        $Pago = new Pago;
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

        return Redirect::to('reserva/listar-registro');
    }



    public function edit($id, Request $request){
        if($request){
            $query = trim ($request -> get('searchText'));

            $Habitacion = DB::table('habitacion as h')
            ->join('nivel as n', 'h.IdNivel', '=', 'n.IdNivel')
            ->join('tipohabitacion as t', 'h.IdTipoHabitacion', '=', 't.IdTipoHabitacion')
            ->select('Num_Hab', 'h.Descripcion as deshab', 'Estado','Precio',
            'n.Denominacion as nivelden',
            't.Denominacion as tipoden');
            $Habitacion = $Habitacion->get();

            $Cliente=DB::table('Cliente')
            ->get();

            //Propio del ID
            $Reserva3 =Reserva::findOrFail($id);


            $new_query = explode("_", $query);
            if ($query == '') {
                $quer4 = $Reserva3->Num_Hab;
            }else {
                $quer4 = $new_query[0];
            }

            $reserva=DB::table('Reserva')
            ->where('Num_Hab', '=', $quer4)
            ->where('Estado', '!=', 'H. CULMINADO')
            ->where('IdReserva', '!=', $id)
            ->orderBy('FechReserva')
            ->get();
            // Para consultar el Adelanto(Pago)
            $Pago=DB::table('Pago')
            ->where('IdReserva', '=', $id)
            ->first();

            // Generamos la reserva para el autoincrement
            $Reserva2=DB::table('Reserva')
            ->orderBy('IdReserva','desc')
            ->limit(1);
            $Reserva2 = $Reserva2->first();


            return view("reserva.listar-registro.edit",["Habitacion"=>$Habitacion, "Pago"=>$Pago,
            "Cliente"=>$Cliente, "reserva"=>$reserva, "Reserva2"=>$Reserva2, "Reserva3"=>$Reserva3,
            "searchText"=>$new_query[0]]);

        }


    }
    public function update(ReservaFormRequest $request, $id){
        try {
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

            return Redirect::to('reserva/listar-registro');
        } catch(\Exception $e) {
            echo "Ocurrio un error inesperado :'[";
        }

    }

    public function show($id){
        $reserva=DB::table('pago as p')
        ->join('reserva as r', 'p.IdReserva', '=', 'r.IdReserva')
        ->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')
        ->join('cliente as c', 'r.IdCliente', '=', 'c.IdCliente')
        ->join('usuario as u', 'r.IdUsuario', '=', 'u.IdUsuario')
        ->join('tipohabitacion as th', 'h.IdTipoHabitacion', '=', 'th.IdTipoHabitacion')
        ->select('r.IdReserva', 'r.IdCliente', 'FechEntrada','FechSalida', 'c.NumDocumento as Ndcliente',
        'CostoAlojamiento','Observacion', 'r.Estado as EsReser', 'c.Celular', 'c.Direccion',
        'r.Num_Hab', 'u.NumDocumento', 'u.Nombre',
        'h.Precio as prehab', 'th.Denominacion', 'p.IdPago','p.TotalPago', 'p.Penalidad',
        'c.Nombre as nomcli', 'c.Apellido as apecli')
        ->where('r.IdReserva', '=', $id)
        ->first();

        $consumo=DB::table('consumo as c')
        ->join('producto as p', 'c.IdProducto', '=', 'p.IdProducto')
        ->where('IdReserva', '=', $id)
        ->get();

        return view("reserva.listar-registro.show",["reserva"=>$reserva,"consumo"=>$consumo]);
    }

    public function report($id){
        $reserva=DB::table('pago as p')
        ->join('reserva as r', 'p.IdReserva', '=', 'r.IdReserva')
        ->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')
        ->join('cliente as c', 'r.IdCliente', '=', 'c.IdCliente')
        ->join('usuario as u', 'r.IdUsuario', '=', 'u.IdUsuario')
        ->join('tipohabitacion as th', 'h.IdTipoHabitacion', '=', 'th.IdTipoHabitacion')
        ->select('r.IdReserva', 'r.IdCliente', 'FechEntrada','FechSalida', 'c.NumDocumento as Ndcliente',
        'CostoAlojamiento','Observacion', 'r.Estado as EsReser', 'c.Celular', 'c.Direccion',
        'r.Num_Hab', 'u.NumDocumento', 'u.Nombre',
        'h.Precio as prehab', 'th.Denominacion', 'p.IdPago','p.TotalPago', 'p.Penalidad',
        'c.Nombre as nomcli', 'c.Apellido as apecli')
        ->where('r.IdReserva', '=', $id)
        ->first();

        $consumo=DB::table('consumo as c')
        ->join('producto as p', 'c.IdProducto', '=', 'p.IdProducto')
        ->where('IdReserva', '=', $id)
        ->get();
        $pdf = \PDF::loadView('reserva/.listar-registro/report', ["reserva"=>$reserva,"consumo"=>$consumo]);
        return $pdf->stream();
    }


    public function destroy(Request $request, $id){

    }
}
