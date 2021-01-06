<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TipoCliente;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TipoClienteFormRequest;
use DB;

class TipoClienteController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $TipoCliente = DB::table('TipoCliente')->where('Denominacion','LIKE','%'.$query.'%')      
            ->orderBy('IdTipoCliente','desc')
            ->paginate(7);
          return view('almacen.TipoCliente.index',["TipoCliente"=>$TipoCliente,"searchText"=>$query]);
          }
    }
    public function create()
    {
        return view("almacen.TipoCliente.create");
    }
    public function store(TipoClienteFormRequest $request)
    {
        $TipoCliente = new TipoCliente;
        $TipoCliente -> Denominacion =$request -> get ('Denominacion');
        $TipoCliente -> save();
        return Redirect::to('almacen/TipoCliente');
    }
    public function show($id)
    {
        return view("almacen.TipoCliente.show",["TipoCliente"=>TipoCliente::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("almacen.TipoCliente.edit",["TipoCliente"=>TipoCliente::findOrFail($id)]);
    }
    public function update(TipoClienteFormRequest $request,$id)
    {
        $TipoCliente=TipoCliente::findOrFail($id);
        $TipoCliente->Denominacion=$request->get('Denominacion');
        $TipoCliente->update();
        return Redirect::to('almacen/TipoCliente');
    }
    public function destroy(Request $request, $id){
        try{
            if ( $request->ajax() ) {
                $docu   = TipoCliente::findOrFail( $id );
    
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
