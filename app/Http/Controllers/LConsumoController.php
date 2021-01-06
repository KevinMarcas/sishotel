<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Consumo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ConsumoFormRequest;
use Illuminate\Support\Facades\DB;

class LConsumoController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $Consumo = DB::table('Consumo as c')
            ->join('reserva as r', 'c.IdReserva','=','r.IdReserva')
            ->join('cliente as cl', 'r.IdCliente','=','cl.IdCliente')
            ->select('r.IdReserva', 'cl.Nombre', 'cl.Apellido', DB::raw('SUM(Total) as Total2'), 'r.Num_Hab',
            	'r.Estado')
            ->where('cl.Nombre','LIKE','%'.$query.'%')
            ->groupby('r.IdReserva', 'cl.Nombre', 'cl.Apellido',  'r.Num_Hab', 'r.Estado')
            ->orderBy('IdReserva','desc')
            ->paginate(7);
          return view('ventas.listar-consumo.index',["Consumo"=>$Consumo,"searchText"=>$query]);
          }
    }

    public function show($id){
        $Datos = DB::table('Consumo as c')
        ->join('reserva as r', 'c.IdReserva','=','r.IdReserva')
        ->join('cliente as cl', 'r.IdCliente','=','cl.IdCliente')
        ->select('r.IdReserva', 'cl.Nombre', 'cl.Apellido',
        'cl.Celular','cl.NumDocumento', 'Total', 'r.Num_Hab',
            'r.Estado')
        ->where('r.IdReserva', '=', $id)
        ->first();

        $Consumo = DB::table('Consumo as c')
            ->join('producto as p', 'c.IdProducto','=','p.IdProducto')
            ->join('reserva as r', 'c.IdReserva','=','r.IdReserva')
            ->join('cliente as cl', 'r.IdCliente','=','cl.IdCliente')
            ->select('r.IdReserva', 'cl.Nombre', 'cl.Apellido','Total', 'r.Num_Hab',
                'r.Estado', 'c.Cantidad', 'c.Estado as EstadoC', 'c.FechConsumo', 'p.NombProducto',
                'p.Precio')
            ->where('r.IdReserva', '=', $id)
            ->get();
            return view("ventas.listar-consumo.show", ["Consumo"=>$Consumo, "Datos"=>$Datos]);
    }
}
