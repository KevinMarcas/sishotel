<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Nivel;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\NivelFormRequest;
use Illuminate\Support\Facades\DB;
class NivelController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $Nivel = DB::table('Nivel')->where('Denominacion','LIKE','%'.$query.'%')
            ->orderBy('IdNivel','desc')
            ->paginate(7);
          return view('mantenimiento.nivel.index',["Nivel"=>$Nivel,"searchText"=>$query]);
          }
    }
    public function create()
    {
        return view("mantenimiento.nivel.create");
    }
    public function store(NivelFormRequest $request)
    {
        $Nivel = new Nivel;
        $Nivel -> Denominacion =$request -> get ('Denominacion');
        $Nivel -> save();
        return Redirect::to('mantenimiento/nivel');
    }
    public function show($id)
    {
        return view("mantenimiento.nivel.show",["Nivel"=>Nivel::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("mantenimiento.nivel.edit",["Nivel"=>Nivel::findOrFail($id)]);
    }
    public function update(NivelFormRequest $request,$id)
    {
        $Nivel=Nivel::findOrFail($id);
        $Nivel->Denominacion=$request->get('Denominacion');
        $Nivel->update();
        return Redirect::to('mantenimiento/nivel');
    }
    public function destroy(Request $request, $id){
        try{
            if ( $request->ajax() ) {
                $docu   = Nivel::findOrFail( $id );

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
