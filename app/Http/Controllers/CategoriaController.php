<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $Categoria = DB::table('Categoria')->where('Denominacion','LIKE','%'.$query.'%')      
            ->orderBy('IdCategoria','desc')
            ->paginate(7);
          return view('almacen.categoria.index',["Categoria"=>$Categoria,"searchText"=>$query]);
          }
    }
    public function create(){
        return view("almacen.categoria.create");
    }

    public function store(CategoriaFormRequest $request){
        $Categoria = new Categoria;
        $Categoria -> Denominacion =$request -> get ('Denominacion');
        $Categoria -> save();
        return Redirect::to('almacen/categoria');
    }
    
    public function show($id){
        return view("almacen.categoria.show",["Categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("almacen.categoria.edit",["Categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaFormRequest $request,$id)
    {
        $Categoria=Categoria::findOrFail($id);
        $Categoria->Denominacion=$request->get('Denominacion');
        $Categoria->update();
        return Redirect::to('almacen/categoria');
    }
    public function destroy(Request $request, $id){
        try{
            if ( $request->ajax() ) {
                $docu   = Categoria::findOrFail( $id );
    
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
