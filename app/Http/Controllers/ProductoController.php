<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductoFormRequest;
use App\Http\Requests\ProductoEditFormRequest;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
       if($request)
        {
            $query = trim ($request -> get('searchText'));
            $Producto = DB::table('Producto as a')
            ->join('Categoria as c','a.IdCategoria','=','c.IdCategoria')
            ->select('a.IdProducto','a.NombProducto','a.Imagen','a.Precio'
            ,'a.Descripcion','c.Denominacion as Denominacionc',)
            ->where('a.NombProducto','LIKE','%'.$query.'%')
            ->orwhere('c.Denominacion','LIKE','%'.$query.'%')
            ->orderBy('IdProducto','desc')
            ->paginate(5);
          return view('almacen.producto.index',["Producto"=>$Producto,"searchText"=>$query]);
          }
    }
    public function create()
    {
        $Categoria=DB::table('Categoria')
        ->get();
        return view("almacen.producto.create",["Categoria"=>$Categoria]);
    }
    public function store(ProductoFormRequest $request)
    {
        $Producto = new Producto;
        $Producto -> NombProducto =$request -> get ('NombProducto');
        if($request->hasFile('Imagen')){
            $file = $request->file('Imagen');
            $file->move(public_path().'/Imagenes/Productos/',$file->getClientOriginalName());
            $Producto -> Imagen=$file->getClientOriginalName();
        }
        $Producto -> Precio =$request -> get ('Precio');
        $Producto -> Descripcion =$request -> get ('Descripcion');
        $Producto -> IdCategoria =$request -> get ('IdCategoria');
        $Producto -> save();
        return Redirect::to('almacen/producto');
    }
    public function show($id)
    {
        return view("almacen.producto.show",["Producto"=>Producto::findOrFail($id)]);
    }
    public function edit($id)
    {
        $Producto = Producto::findOrFail($id);
        $Categoria = DB::table('Categoria')->get();
        return view("almacen.producto.edit",["Producto"=>$Producto,"Categoria"=>$Categoria]);
    }
    public function update(ProductoEditFormRequest $request,$id)
    {
        $Producto=Producto::findOrFail($id);
        $Producto -> NombProducto =$request -> get ('NombProducto');
        if($request->hasFile('Imagen')){
            $file = $request->file('Imagen');
            $file->move(public_path().'/Imagenes/Productos/',$file->getClientOriginalName());
            $Producto -> imagen=$file->getClientOriginalName();
        }
        $Producto -> Precio =$request -> get ('Precio');
        $Producto -> Descripcion =$request -> get ('Descripcion');
        $Producto -> IdCategoria =$request -> get ('IdCategoria');
        $Producto->update();
        return Redirect::to('almacen/producto');
    }
    public function destroy(Request $request, $id){
        try{
            if ( $request->ajax() ) {
                $docu   = Producto::findOrFail( $id );

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
