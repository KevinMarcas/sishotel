<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Reserva;
use App\Pago;
use App\Habitacion;
use App\Consumo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ReservaFormRequest;
use Illuminate\Support\Facades\DB;

class SalidaController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            // $query = trim ($request -> get('searchText'));
            // $Categoria = DB::table('Categoria')->where('Denominacion','LIKE','%'.$query.'%')
            // ->orderBy('IdCategoria','desc')

            $reserva=DB::table('reserva as r')
            ->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')
            ->join('tipohabitacion as th', 'h.IdTipoHabitacion', '=', 'th.IdTipoHabitacion')
            ->select('r.Num_Hab', 'th.Denominacion', 'r.IdReserva', 'r.Estado')
            ->where('r.Estado', '=','HOSPEDAR')
            ->paginate(15);
          return view('salidas.verificacion.index',["reserva"=>$reserva]);
          }
    // echo"hola";
    }


    public function edit($id){
        $reserva=DB::table('pago as p')
        ->join('reserva as r', 'p.IdReserva', '=', 'r.IdReserva')
        ->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')
        ->join('cliente as c', 'r.IdCliente', '=', 'c.IdCliente')
        ->join('usuario as u', 'r.IdUsuario', '=', 'u.IdUsuario')
        ->join('tipohabitacion as th', 'h.IdTipoHabitacion', '=', 'th.IdTipoHabitacion')
        ->select('r.IdReserva', 'r.IdCliente', 'FechEntrada','FechSalida', 'c.NumDocumento as Ndcliente',
        'CostoAlojamiento','Observacion', 'r.Estado as EsReser', 'c.Celular', 'c.Direccion',
        'r.Num_Hab', 'u.NumDocumento', 'u.Nombre',
        'h.Precio as prehab', 'th.Denominacion', 'p.IdPago','p.TotalPago',
        'c.Nombre as nomcli', 'c.Apellido as apecli')
        ->where('r.IdReserva', '=', $id)
        ->first();

        $consumo=DB::table('consumo as c')
        ->join('producto as p', 'c.IdProducto', '=', 'p.IdProducto')
        ->where('IdReserva', '=', $id)
        ->get();

        return view("salidas.verificacion.edit",["reserva"=>$reserva,"consumo"=>$consumo]);
    }
    public function update(ReservaFormRequest $request, $id){
        $reserva=reserva::findOrFail($id);
        $reserva->Estado=$request->get('Estado');
        $reserva->update();

        $pago = pago::findOrFail($request->get('IdPago'));
        if ($request->get('penalidad') == 0){
            $pago -> Penalidad = 0;
        }else {
            $pago -> Penalidad = $request->get('penalidad');
        }
        $pago -> TotalPago = $request->get('totalpago');
        $pago -> Estado = "PAGADO"; //analizar si se pone la fecha de emision o no
        $pago->update();

        $habitacion = habitacion::findOrFail($request->get('Num_Hab'));
        $habitacion -> Estado = "LIMPIEZA";
        $habitacion->update();

        $consumo = DB::table('consumo')->where('IdReserva', '=', $id)->get();
        foreach ($consumo as $con){
            $consuming = consumo::findOrFail($con->IdConsumo);
            $consuming -> Estado = "PAGADO";
            $consuming->update();
        }
        return Redirect::to('salidas/verificacion');
    }

    public function show($id)
    {
        echo "Estas entrando al show";
    }


    public function destroy(Request $request, $id){

    }
}
