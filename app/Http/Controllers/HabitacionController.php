<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Habitacion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\HabitacionFormRequest;
use DB;

class HabitacionController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $Habitacion = DB::table('Habitacion as a')
            ->join('Nivel as c','a.IdNivel','=','c.IdNivel')
            ->join('TipoHabitacion as b','a.IdTipoHabitacion','=','b.IdTipoHabitacion')
            ->select('a.Num_Hab','a.Descripcion','a.Estado','a.Precio'
            ,'c.Denominacion as Nivel','b.Denominacion as TipoHabitacion')
            ->where('a.Descripcion','LIKE','%'.$query.'%')
            ->orwhere('b.Denominacion','LIKE','%'.$query.'%')
            ->orwhere('c.Denominacion','LIKE','%'.$query.'%')
            ->orderBy('c.Denominacion','asc')
            ->orderBy('Num_Hab','asc')
            ->paginate(7);
          return view('mantenimiento.habitacion.index',["Habitacion"=>$Habitacion,"searchText"=>$query]);
          }
    }
    public function create()
    {
        $Nivel=DB::table('Nivel')
        ->get();
        $TipoHabitacion=DB::table('TipoHabitacion')
        ->get();
        return view("mantenimiento.habitacion.create",["TipoHabitacion"=>$TipoHabitacion,"Nivel"=>$Nivel]);
    }
    public function store(HabitacionFormRequest $request)
    {
        $Habitacion=new Habitacion;
        $Habitacion->Num_Hab=$request->get('Num_Hab');
        $Habitacion->Descripcion=$request -> get ('Descripcion');
        $Habitacion->Estado =$request -> get ('Estado');
        $Habitacion->Precio =$request -> get ('Precio');
        $Habitacion->IdTipoHabitacion =$request -> get ('IdTipoHabitacion');
        $Habitacion->IdNivel =$request -> get ('IdNivel');
        $Habitacion->save();
        return Redirect::to('mantenimiento/habitacion');
    }
    public function show($id)
    {
        return view("mantenimiento.habitacion.show",["Habitacion"=>Habitacion::findOrFail($id)]);
    }
    public function edit($id)
    {
        $Habitacion = Habitacion::findOrFail($id);
        $TipoHabitacion = DB::table('TipoHabitacion')->get();
        $Nivel = DB::table('Nivel')->get();
        return view("mantenimiento.habitacion.edit",["Habitacion"=>$Habitacion,"Nivel"=>$Nivel,"TipoHabitacion"=>$TipoHabitacion]);
    }
    public function update(HabitacionFormRequest $request,$id)
    {
        $Habitacion=Habitacion::findOrFail($id);
        $Habitacion->Num_Hab=$request -> get ('Num_Hab');
        $Habitacion->Descripcion =$request -> get ('Descripcion');
        $Habitacion->Estado =$request -> get ('Estado');
        $Habitacion->Precio =$request -> get ('Precio');
        $Habitacion->IdTipoHabitacion =$request -> get ('IdTipoHabitacion');
        $Habitacion->IdNivel =$request -> get ('IdNivel');
        $Habitacion->update();
        return Redirect::to('mantenimiento/habitacion');
    }
    public function destroy(Request $request, $id){
        try{
            if ( $request->ajax() ) {
                $docu   = Habitacion::findOrFail( $id );

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
