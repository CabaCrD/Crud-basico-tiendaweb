<?php
/**
 * 
 * 
 * Author: CabaCrD
 * 
 * ESTO ES UN ARCHIVO QUE MUESTRA UN MENU DESPLEGABLE CON LAS FAMILIAS DE LOS PRODUCTOS, CUANDO SELECCIONAMOS UNA FAMILIA
 * NOS MUESTRA UN LISTADO CON TODOS LOS PRODUCTOS DE LA FAMILIA SELECCIONADA
 * 
 */

 /*
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
*/

    require "controller.php"
?>
<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="bootstrap.css"> <!-- MODIFICADO DE ORIGEN REMOTO A ORIGEN LOCAL -->
    <title>listado.php</title>
</head>

<body>

    <header>
        <div class="container mt-1 mb-3">
            <div class="col-12 d-flex border border-dark bg-secondary text-light">
                <div class="col-md-12 text-center justify-content-center">
                    <h1>Tienda Web</h1>

                    <form class="col-md-12 col-sm-6 w-100" method="POST">
                        <input type="text" id="buscador" name="buscador" placeholder="Buscar un producto" class="col-md-10">
                        <input type="submit" value="Buscar" id="btnBuscar" name="btnBuscar" class="col-md-1 col-sm-1 btn btn-primary mb-2 mt-2">
                    </form>

                    <form class="col-md-12 col-sm-6 w-100" method="POST">
                        <label for="combo" class="col-md-1 col-sm-2">Familias: </label>
                        <select id="combo" name="combo" class="form-select col-md-3 col-sm-3" required>
                            <option selected disabled >Seleccione una familia</option>

                                <?php
                                    $combo = controller::getFamilias();//LLAMAMOS AL METODO PARA LLAMAR A LAS FAMILIAS
                                    for ($i = 0; $i < count($combo); $i++) {//USAMOS EL BUCLE PARA RELLENAR EL COMBO
                                        echo "<option value='" . $combo[$i]["cod"] . "'>" . $combo[$i]["nombre"] . "</option>";//COPN ESTO RELLENAREMOS LAS OPCIONES
                                    }
	                            ?>

                        </select>
                        <input type="submit" value="Mostrar" id="btnEnv" name="btnEnv" class="col-md-1 col-sm-1 btn btn-primary mb-2 mt-2">
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="col-12 d-flex">
                <div class="col-md-12 text-center justify-content-center">
                    <h3>Productos</h3>
                </div>
            </div>            
        </div>
        <div class="container">
            <div class="col-12 d-flex">
                <div class="col-md-12 text-left justify-content-start align-items-start ">

                            <?php

                                $busqueda = $_POST['buscador'];
                                if(isset($_POST['btnBuscar'])){//SI SE ENVIO...
                                    if(empty($busqueda)){
                                        header("Refresh:0");
                                    }
                                    $buscador = controller::getBuscador($_POST["buscador"]);
                                    echo "Resultados para: <b>" . $busqueda . "</b>";

                                    for ($i = 0; $i < count($buscador); $i++) {

                                        echo  "<form action='editar.php' method='POST' class='form-inline border bg-light mt-2 mb-2'>";
                                        echo '<label for="editar">' . $buscador[$i]["nombre_corto"] . '&nbsp;</label>';             
                                        echo '<input type="submit" value="Editar" id="btnEdit" name="btnEdit" class="col-md-1 col-sm-1 btn btn-success mb-2 mt-2">';
                                        echo '<input type="hidden" value="' . $buscador[$i]["cod"] . '" id="cod" name="cod">';    
                                        echo  "</form>";

                                    }

                                }
                                
	                        ?>

                        <?php
                            if(isset($_POST['btnEnv'])){//SI SE ENVIO...
                                $prod= controller::getProductos($_POST['combo']);//LLAMAMOS A LA FUNCION Y LE PASAMOS LA VARIABLE QUE CONTIENE EL CODIGO DE LA FAMILIA          
                                for( $i=0; $i<count($prod);$i++){//BUCLE PARA RECCORRER Y MOSTRAR                               
                                    echo  "<form action='editar.php' method='POST' class='form-inline border bg-light mt-2 mb-2'>";
                                        echo '<label for="editar">' . $prod[$i]["nombre_corto"] . '&nbsp;</label>';//ETIQUETA CON EL NOMBRE DEL PRODUCTO               
                                        echo '<input type="submit" value="Editar" id="btnEdit" name="btnEdit" class="col-md-1 col-sm-1 btn btn-success mb-2 mt-2">';
                                        echo '<input type="hidden" value="' . $prod[$i]["cod"] . '" id="cod" name="cod">';    
                                    echo  "</form>";
                                }
                            }
                    ?>

                </div>
            </div>            
        </div>
    </main>

</body>

</html>
