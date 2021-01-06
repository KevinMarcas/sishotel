<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $Cliente = DB::table('Cliente as a')
            ->select('a.IdCliente','a.Nombre','a.Apellido','a.Celular'
            ,'a.Correo','a.TipDocumento','a.NumDocumento','a.Direccion')
            ->where('a.Nombre','LIKE','%'.$query.'%')
            ->orwhere('a.NumDocumento','LIKE','%'.$query.'%')
            ->orderBy('IdCliente','desc')
            ->paginate(7);
          return view('reserva.clientes.index',["Cliente"=>$Cliente,"searchText"=>$query]);
          }
    }
    public function create()
    {

        return view("reserva.clientes.create");
    }
    public function store(ClienteFormRequest $request)
    {
        $Cliente = new Cliente;
        $Cliente -> Nombre =$request->get ('Nombre');
        $Cliente ->Apellido =$request -> get ('Apellido');
        $Cliente ->Celular =$request -> get ('Celular');
        $Cliente ->Correo =$request -> get ('Correo');
        $Cliente ->TipDocumento =$request -> get ('TipDocumento');
        $Cliente ->NumDocumento =$request -> get ('NumDocumento');
        $Cliente ->Direccion =$request -> get ('Direccion');
        $Cliente -> save();
        return Redirect::to('reserva/clientes');
    }
    public function show($id)
    {
        return view("reserva.clientes.show",["Cliente"=>Cliente::findOrFail($id)]);
    }
    public function edit($id)
    {
        $Cliente =Cliente::findOrFail($id);
        return view("reserva.clientes.edit",["Cliente"=>$Cliente]);
    }
    public function update(ClienteFormRequest $request,$id)
    {
        $Cliente= Cliente::findOrFail($id);
        $Cliente ->Nombre =$request -> get ('Nombre');
        $Cliente ->Apellido =$request -> get ('Apellido');
        $Cliente ->Celular =$request -> get ('Celular');
        $Cliente ->Correo =$request -> get ('Correo');
        $Cliente ->TipDocumento =$request -> get ('TipDocumento');
        $Cliente ->NumDocumento =$request -> get ('NumDocumento');
        $Cliente ->Direccion =$request -> get ('Direccion');
        $Cliente->update();
        return Redirect::to('reserva/clientes');
    }
    public function destroy(Request $request, $id){
        try{
            if ( $request->ajax() ) {
                $docu   = Cliente::findOrFail( $id );

                if ( $docu->delete() ) {
                    return response()->json( [
                        'success' => true,
                        'message' => '¡Satisfactorio!, Registro eliminado con éxito.',
                    ] );
                } else {
                    return response()->json( [
                        'success' => false,
                        'message' => '¡Error!, No se pudo eliminar.',
                    ] );
                }
            }
        }catch(\Exception $e){
            if ( $request->ajax() ) {
                return response()->json( [
                    'success' => false,
                    'message' => '¡Error!, Este registro tiene enlazado uno o mas registros de Productos.',
                ] );
            }

        }
    }
}
