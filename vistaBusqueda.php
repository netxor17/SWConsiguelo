<?php 
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\Producto;
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Mostrar busqueda</title>
    </head>

    <body>
        <div id="contenedor">
            <?php
                require("includes/common/cabecera.php");
            ?>
            <div id="contenido">
                <h1>Mostrando busqueda</h1>
                <?php
                foreach($array as $key => $fila){
                 echo $fila['tipo'];
                 echo $fila['descripcion'];
                }
                ?>
                </tbody>
                </table>

            </div>
        </div>
    </body>
    
</html>