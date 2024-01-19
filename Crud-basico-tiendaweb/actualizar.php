<?php 
/**
 * 
 * 
 * Author: CabaCrD
 * 
 * ESTO ES UN ARCHIVO QUE SE ENCARGA DE LLEVAR A CABO LA ACCION TOMADA EN EL ARCHIVO "editar.php".
 * NOS MOSTRARA UN MENSAJE CON EL RESULTADO DE ACCION
 * 
 * 
 */

/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/
require "controller.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type= "text/css" href="bootstrap.css"> <!-- MODIFICADO DE ORIGEN REMOTO A ORIGEN LOCAL -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar.php</title>
</head>
<body>
    <main>
        <div id="container">
            <div class="col-12 d-flex mt-5 mb-5">
                <form class="col-md-12 justify-items-center align-items-center text-center mt-5 mb-5" action="listado.php">
                    <?php
                        $cod = $_POST['cod'];
                        $n_corto = $_POST['nombreC'];
                        $nombre = $_POST['nombre'];
                        $desc = $_POST['descripcion'];
                        $pvp = $_POST['pvp'];
                        /******* ACTUALIZAR *******/
                        if (isset($_POST['btnUpd'])) {

                            $resultado = controller::updateProducto($cod, $n_corto, $nombre, $desc, $pvp);

                            if (!is_numeric($pvp)) { //SI SE INTRODUCE UN PVP QUE NO SEA NUMERICO    

                                echo "<h3> El precio debe ser númerico</h3>";      

                            }    

                            if ($resultado === true) { //SI SE INTRODUCE CORRECTAMENTE 

                                echo "<h3>Los datos se han actualizado correctamente.</h3>";  

                            }else{ //SI SURGE ALGUN OTRO ERROR   

                                echo "<h3>Se ha producido un error al actualizar los datos: </h3>" . $resultado;

                            }

                        } 
                        /******* ELIMINAR *******/
                        
                        if (isset($_POST['btnDel'])) {      

                            $stock = controller::isStock($cod);  

                            if ($stock == true) {                 

                                echo '<h3>No se puede eliminar el producto porque hay existencias en stock</h3>';  

                            }else{                 

                                controller::deleteProducto($cod);                    
                                echo "<h3>Producto eliminado</h3>";     

                            }    

                        }         
                        /******* CANCELAR *******/

                        if(isset($_POST['btnCan'])) {//SI PULSAMOS CANCELAR 

                            echo '<h3>Se ha cancelado la operacion</h3>';

                        }
                        
                    ?>
                    <input type="submit" value="Aceptar" class="btn btn-success">
                </form>
            </div>
        </div>
    </main>
</body>
</html>