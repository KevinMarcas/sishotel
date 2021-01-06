<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reserva;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $pago=DB::table('pago as p')
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
            ->where('r.Estado','=','HOSPEDAR')
            ->paginate(7);
          return view('reporte.ingresos.index',["pago"=>$pago,"searchText"=>$query]);
          }
    }
}
