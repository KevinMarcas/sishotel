<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Consumo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ConsumoFormRequest;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ConsumoController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $reserva=DB::table('reserva as r')
            ->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')
            ->join('tipohabitacion as th', 'h.IdTipoHabitacion', '=', 'th.IdTipoHabitacion')
            ->select('r.Num_Hab', 'th.Denominacion', 'r.IdReserva', 'r.Estado')
            ->where('r.Estado', '=','HOSPEDAR')
            ->paginate(15);
            return view('ventas.consumo.index',["reserva"=>$reserva]);
        }
    }
    public function create(){

    }

    public function store(ConsumoFormRequest $request){
        echo "sad";
    }

    public function show($id){

    }

    public function edit($id){

        $reserva=DB::table('reserva as r')
        ->join('habitacion as h', 'r.Num_Hab', '=', 'h.Num_Hab')
        ->join('cliente as c', 'r.IdCliente', '=', 'c.IdCliente')
        ->join('usuario as u', 'r.IdUsuario', '=', 'u.IdUsuario')
        ->join('tipohabitacion as th', 'h.IdTipoHabitacion', '=', 'th.IdTipoHabitacion')
        ->select('r.IdReserva', 'r.IdCliente', 'FechEntrada','FechSalida', 'c.NumDocumento as Ndcliente',
        'CostoAlojamiento','Observacion', 'r.Estado as EsReser', 'c.Celular', 'c.Direccion',
        'r.Num_Hab', 'u.NumDocumento', 'u.Nombre',
        'h.Precio as prehab', 'th.Denominacion',
        'c.Nombre as nomcli', 'c.Apellido as apecli')
        ->where('r.IdReserva', '=', $id)
        ->first();

        $producto=DB::table('producto')->get();
        return view("ventas.consumo.edit",["reserva"=>$reserva,"producto"=>$producto]);
    }

    public function update(ConsumoFormRequest $request,$id){
            DB::beginTransaction();
            $idproducto = $request->get('idproducto');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $consumo = $request->get('detalle');
            $estado = $request->get('Estado');
            $cont = 0;
            $mytime = Carbon::now('America/Lima');
            while ($cont < count($idproducto)) {
                $consumo = new Consumo();
                $consumo->IdReserva=$id;
                $consumo->IdProducto=$idproducto[$cont];
                $consumo->FechConsumo=$mytime->toDateTimeString();
                $consumo->Cantidad = $cantidad[$cont];
                $consumo->Total = $precio_venta[$cont];
                $consumo->Estado = $estado;
                $consumo->save();

                $cont=$cont+1;
            }

            DB::commit();
            return Redirect::to('ventas/consumo');
    }
    public function destroy(Request $request, $id){

    }
}
