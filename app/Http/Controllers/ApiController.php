<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/Bogota');

use App\Producto;
use Illuminate\Http\Request;
use DB;
use Exception;

class ApiController extends Controller
{

    /**Función para obtener los productos. */
    public function getProductos()
    {
        $producto = Producto::all();
        return \Response::json(array("resp" => "success", "producto" => $producto));
        
    }    

    /**Función para el guardado del producto */
    public function guardarProducto(Request $request)
    {

        try {

            $nombre =  $request->input('nombre');
            $precio =  $request->input('precio');
            $cantidad =  $request->input('cantidad');
            $id_categoria =  $request->input('categoria');

            $this->validacionesCampos($nombre, $precio, $cantidad, $id_categoria);

            // se envian los datos a la transacción 
            \DB::beginTransaction();

            Producto::create([
                "nombre" => $nombre,
                "precio" => $precio,
                "cantidad" => $cantidad,
                "id_categoria" => $id_categoria
            ]);

            \DB::commit();

            return array("resp" => "success", "msj" => "El registro fue exitoso");

        } catch (\Exception $e) {

            \DB::rollback();
            return \Response::json(array("resp" => "error", "msj" => $e->getMessage()), 422);
        }
    }

    /**Función para editar producto seleccionado */
    public function editarProducto(Request $request, $id_producto)
    {
        // transacción de guardado
        try {

            $nombre =  $request->input('nombre');
            $precio =  $request->input('precio');
            $cantidad =  $request->input('cantidad');
            $id_categoria =  $request->input('categoria');

            //validar si el id producto existe
            $producto = Producto::find($id_producto);
            if(!isset($producto)){
                throw new Exception("El producto indicado no existe");
            }

            $this->validacionesCampos($nombre, $precio, $cantidad, $id_categoria);

            // se envian los datos a la transacción 
            \DB::beginTransaction();

            $producto->nombre = $nombre;
            $producto->precio = $precio;
            $producto->cantidad = $cantidad;
            $producto->id_categoria = $id_categoria;
            $producto->save();

            \DB::commit();

            return array("resp" => "success", "msj" => "El producto fue actualizado exitosamente");

        } catch (\Exception $e) {

            \DB::rollback();
            return \Response::json(array("resp" => "error", "msj" => $e->getMessage()), 422);
        }
    }

    /**Función para eliminar el producto */
    public function eliminarProducto($id_producto)
    {   
        
        //validar si el id producto existe
        $producto = Producto::find($id_producto);

        if(!isset($producto)){
            return \Response::json(array("resp" => "error", "msj" =>"El producto indicado no existe"), 422);
        }

        $producto->delete();

        return \Response::json(array("resp" => "success", "msj"=> "Producto eliminado exitosamente"));
    }

    /**Función para las validaciones de los campos */
    public function validacionesCampos($nombre, $precio, $cantidad, $id_categoria){

            // validar campos obligatorios
            if (!isset($nombre)) {
                throw new Exception("El campo nombre es requerido");
            }
            if (!isset($precio)) {
                throw new Exception("El campo precio es requerido");
            }
            if (!isset($cantidad)) {
                throw new Exception("El campo cantidad es requerido");
            }
            if (!isset($id_categoria)) {
                throw new Exception("El campo categoria es requerido");
            }

            //validar caracteres especiales
            $letras = "/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/";
            if (preg_match($letras, $nombre) == 0) {
                throw new Exception("El campo nombre no debe contener números ni caracteres especiales");
            }

            $numerosdouble = "/^[0-9]+([.]?[0-9]+)*$/";
            if (preg_match($numerosdouble, $precio) == 0) {
                throw new Exception("El campo precio es invalido");
            }

            if (!is_int($cantidad)) {
                throw new Exception("El campo cantidad es invalido");
            }

            //Validar si existe la categoria ingresada.
            $existencia = DB::table('categorias')
                ->select('id')
                ->where('id', '=', $id_categoria)
                ->get();

            if (count($existencia) == 0) {
                throw new Exception("La categoria no existe");
            }
    }

}
