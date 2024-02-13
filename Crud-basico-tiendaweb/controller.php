<?php
/**
 * 
 * 
 * Author: CabaCrD
 * 
 * ESTO ES UN ARCHIVO QUE CONTIENE LAS FUNCIONES QUE LE DARAN FUNCIONALIDAD A LA APLICACION WEB
 * 
 */

 /*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/

 require "config.php";

class controller{

    /** FUNCION ESTATICA PARA CONECTAR CON LA BASE DE DATOS **/
    static function getConnection(){
        try {
            $conex = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);//LOGIN EN MYSQL
            $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conex;//DEVUELVE LA CONEXION
        }catch (PDOException $e) {
            die("Hubo un error al conectar con la base de datos ".DB_NAME." :" . $e->getMessage());//MENSAJE DE ERROR    
        }
    }

    /** FUNCION PARA OBTENER LAS FAMILIAS **/
    public static function getFamilias(){
        try{
            $conex= self :: getConnection();
            $familias = $conex -> query("SELECT * FROM familia");//CONSULTA QUE HAREMOS
            $familias ->execute();//EJECUTAMOS CONSULTA
            $resultado = $familias->fetchAll();//EXTRAEMOS TODAS LAS FAMILIAS
            return $resultado;//SE DEVUELVE EL RESULTADO
        }catch(PDOException $e){
            die("Ha surgido un error al recuperar las familias \n Error: " . $e->getMessage());
        }
    }

    public static function getProductos($id){
        try{
            $conex= self :: getConnection();
            $productos = $conex -> query("SELECT producto.* FROM producto WHERE producto.familia =  '$id'");//CONSULTA QUE HAREMOS
            $productos ->execute();//EJECUTAMOS CONSULTA
            $resultado = $productos->fetchAll();//EXTRAEMOS TODAS LAS FAMILIAS
            return $resultado;//SE DEVUELVE EL RESULTADO
        }catch(PDOException $e){
            die("Ha surgido un error al recuperar los productos de la familia \n Error: " . $e->getMessage());
        }
    }

    public static function getProducto($cod){
        try{
            $conex= self :: getConnection();
            $producto = $conex -> query("SELECT * FROM producto WHERE  cod = '$cod'");//CONSULTA QUE HAREMOS
            $producto ->execute();//EJECUTAMOS CONSULTA
            $resultado = $producto->fetchAll();//EXTRAEMOS TODAS LAS FAMILIAS
            return $resultado;//SE DEVUELVE EL RESULTADO
        }catch(PDOException $e){
            die("Ha surgido un error al recuperar el producto \n Error: " . $e->getMessage());
        }
    }

    public static function updateProducto($cod, $n_corto, $nombre, $desc, $pvp){
        try{
            $conex= self :: getConnection();
            $producto = $conex -> query("UPDATE producto SET nombre_corto = '$n_corto', nombre = '$nombre', descripcion = '$desc', PVP = '$pvp' WHERE cod = '$cod' ");//CONSULTA QUE HAREMOS
            $producto ->execute();//EJECUTAMOS CONSULTA
            return true;//SE DEVUELVE EL RESULTADO
        }catch(PDOException $e){
            return false;
            die("Ha surgido un error al eliminar el producto \n Error: " . $e->getMessage());
        }
    }

    public static function deleteProducto($cod){
        try{
            $conex= self :: getConnection();
            $producto = $conex -> query("DELETE FROM producto WHERE cod = '$cod'");//CONSULTA QUE HAREMOS
            $producto ->execute();//EJECUTAMOS CONSULTA
            $cod = $producto->fetchAll();
            return true;//SE DEVUELVE EL RESULTADO
        }catch(PDOException $e){
            return false;
            die("Ha surgido un error al eliminar el producto \n Error: " . $e->getMessage());
        }
    }

    public static function isStock($cod){
        try{
            $conex= self :: getConnection();
            $stock = $conex -> query("SELECT producto, unidades FROM stock WHERE producto = '$cod'");//CONSULTA QUE HAREMOS
            $stock ->execute();//EJECUTAMOS CONSULTA
            $resultado = $stock->fetchAll();
            if($resultado == false){             
                return false;
            }
            if( $resultado[0]['unidades'] == 0 || $resultado[0]['unidades'] == null){ 
                return false;
            }else{
                return true;
            }
        }catch(PDOException $e){
            return false;
            die("Ha surgido un error al comprobar el stock del producto \n Error: " . $e->getMessage());
        }
    }
    public static function getBuscador($busqueda){
        try{
            $conex= self :: getConnection();
            $productos = $conex -> query("SELECT producto.* FROM producto, familia WHERE (producto.nombre_corto LIKE '%$busqueda%') OR ((producto.descripcion LIKE '%$busqueda%')) GROUP BY producto.nombre_corto");//CONSULTA QUE HAREMOS
            $productos ->execute();//EJECUTAMOS CONSULTA
            $resultado = $productos->fetchAll();//EXTRAEMOS TODAS LAS FAMILIAS
            return $resultado;//SE DEVUELVE EL RESULTADO
        }catch(PDOException $e){
            die("Ha surgido un error al buscar los productos en la base de datos \n Error: " . $e->getMessage());
        }
    }
}

 ?>
