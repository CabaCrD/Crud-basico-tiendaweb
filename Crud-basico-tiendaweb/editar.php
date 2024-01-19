<?php
/**
 * 
 * 
 * Author: CabaCrD
 * 
 * ESTO ES UN ARCHIVO QUE NOS PERMITE MODIFICAR LOS PRODUCTOS
 * 
 */

/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/
    require "controller.php";

    $cod =  $_REQUEST["cod"];
    if (isset($_POST["btnEdit"])) {//SI SE ENVIO LA INFO DEL FORM DE LISTADO
        $prod = controller::getProducto($cod);//LLAMAMOS AL METODO
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="bootstrap.css"> <!-- MODIFICADO DE ORIGEN REMOTO A ORIGEN LOCAL -->
    <title>editar.php</title>
</head>

<body>

    <header>
        <div class="container mt-1 mb-3">
            <div class="col-12 d-flex border border-dark bg-secondary text-light">
                <div class="col-md-12 text-center justify-content-center">
                    <h1>Tarea</h1>
                    <h2>Edicion de un producto</h2>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="col-12 d-flex">
                <div class="col-md-12 justify-content-start">
                    <h3>Productos de la familia</h3>
                </div>
            </div>            
        </div>

        <div class="container"> 
            <div class="d-flex bg-light border justify-content-md-start justify-content-xs-start align-items-md-start align-items-xs-start col-md-12 mb-3">
                <div class="col-md-6 col-xs-12" >
                    <form action ="actualizar.php" method="POST" class="">
                        <input type="hidden" name="cod" id="cod" value="<?php echo $prod[0]["cod"] ?>" />



                        <label for="nombreC">Nombre corto</label>
                        <input type="text" maxlength="50" title="Nombre corto" tabindex="1" id="nombreC" name="nombreC" class="form-control" value="<?php echo $prod[0]["nombre_corto"] ?>" required>
                        
                        <label for="nombre">Nombre</label>
                        <textarea type="textarea" maxlength="200" title="Nombre" tabindex="2" id="nombre" name="nombre" class="form-control" required> <?php echo $prod[0]["nombre"] ?> </textarea>

                        <label for="descripcion">Descripcion</label>
                        <textarea type="textarea" maxlength="400" title="descripcion" tabindex="2" id="descripcion" name="descripcion" class="form-control" required> <?php echo $prod[0]["descripcion"];?> </textarea> 

                        <label for="pvp">PVP</label>
                        <input type="text" pattern="^\d*(\.\d{0,2})?$" title="pvp" tabindex="4" id="pvp" name="pvp" class="form-control" value="<?php echo $prod[0]["PVP"] ?>" required> 
                        

                        <div class="form-inline mt-3 mb-3">
                            <input type="submit" tabindex="5" class="btn btn-success me-3" value="Actualizar" id="btnUpd" name="btnUpd" >
                            <input type="submit" tabindex="6" class="btn btn-danger " value="Eliminar" id="btnDel" name="btnDel">
                            <input type="submit" tabindex="7" class="btn btn-secondary me-3" value="Cancelar" id="btnCan" name="btnCan">                      
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>