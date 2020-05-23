<?php
namespace es\fdi\ucm\aw;
//require_once __DIR__.'/Form.php';
//require_once __DIR__.'/Usuario.php';

class FormularioFiltrar extends Form
{
    public function __construct() {
        parent::__construct('formFiltrar');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $nombreProd = '';
        $precioProd ='';
        $nombreCat='';
        if ($datos) {
            $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : $nombreProd;
            //$precioProd = isset($datos['precio']) ? $datos['precio'] : $precioProd;
            $nombreCat = isset($datos['tipo']) ? $datos['tipo'] : $nombreCat;
        }
        $html = <<<EOF
        <fieldset>
            <legend>Buscar un producto</legend></br>
            <form method="post" action="Producto.php">
            <p><label>Filtrar por nombre:</label> <input type="text" name="nombre"/></p>
            <p><label>Filtrar por categoria:</label> <input type="text" name="tipo"/></p>
            <button type="submit" name="search">Buscar</button>
            </form>
        </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $nombreProd = isset($datos['nombre']) ? $datos['nombre'] : null;
        $nombreCat = isset($datos['tipo']) ? $datos['tipo'] : null;
                
       if ( empty($nombreProd) && empty($nombreCat)) {
            $result[] = "Debes rellenar al menos algun campo para filtrar";
        }
        
        if (count($result) === 0) {
            if(strlen($nombreProd)>0){
            Producto::muestraProductosPorNombre($nombreProd);
            }
            else{
            Producto::muestraProductosPorCat($nombreCat);
            }
            /*if ( !$producto ) {
                // No se da pistas a un posible atacante
                $result[] = "No existen productos";
            }
             if ( !$categoria ) {
                // No se da pistas a un posible atacante
                $result[] = "No existe esa categoria";
            }*/

    }
        return $result;
    }
}