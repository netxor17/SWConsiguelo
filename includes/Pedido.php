<?php namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';


class Pedido
{

    public static function buscaPedido($nombreProd)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Productos P WHERE P.nombre = '%s'", $conn->real_escape_string($nombreProd));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $producto = new Producto($fila['nombre'], $fila['descripcion'], $fila['precio'],$fila['unidades'], $fila['unidadesDisponibles'],$fila['tallasDisponibles'],$fila['coloresDisponibles'],$fila['talla'],$fila['color'],$fila['categoria'],$fila['reseña'],$fila['agotado'],$fila['numEstrellas'],$fila['imagen']);
                $producto->id = $fila['id'];
                $result = $producto;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function muestraPedido($producto)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Productos P"); $conn->real_escape_string($producto);
        $rs = $conn->query($query);
        $result = false;
        ?>
        <centre>
        <table>
        <thead>
            <tr>
                 <th>Imagen</th>
                 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Precio</th>
                 <th>Unidades</th>
                 <th>Talla</th>
                 <th>Color</th>
                 <th>Categoria</th>
                 <th>Reseña</th>
                 <th>Agotado</th>
                 <th>Numero Estrellas</th>
            </tr>
        </thead>
        <tbody>
         <?php
        if ($rs) {
           // if ( $rs->num_rows >= 1) {
               while( $fila = $rs->fetch_assoc()){
                $id=$fila['id'];
                $nombre=$fila['nombre'];
                $descripcion=$fila['descripcion'];
                $precio=$fila['precio'];
                $udDisp=$fila['unidadesDisponibles'];
                $talla=$fila['talla'];
                $color=$fila['color'];
                $categoria=$fila['categoria'];
                $reseña=$fila['reseña'];
                $agotado=$fila['agotado'];
                $numEstrellas=$fila['numEstrellas'];
                ?>
                
        <tr>
        <td><img src="<?php echo $fila['imagen']; ?>" width='85' height='85'/></td>
        <td><?php echo $nombre; ?></td>
        <td><?php echo $descripcion; ?></td>
        <td><?php echo $precio; ?></td>
        <td><?php echo $udDisp;?></td>
        <td><?php echo $talla;?></td>
        <td><?php echo $color; ?></td>
        <td><?php echo $categoria; ?></td>
        <td><?php echo $reseña; ?></td>
        <td><?php echo $agotado; ?></td>
        <td><?php echo $numEstrellas; ?></td>
        <form method="get" action="add">
        </form>
        <td><a href="./añadirAlCarrito.php?id=<?php echo $fila['id'];?>">Añadir al carrito</td>
        </tr>
        <?php
            }
        ?>
            </tbody>
            </table>
            </centre>
            <?php
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

	
	//filas tabla pedido
    
    private $id;

    private $nombre;

    private $descripcion;

    private $precio;
	
    private $unidadesDisponibles;
	
    private $tallasDisponibles;
	
    private $coloresDisponibles;
	
    private $talla;
	
    private $color;
	
    private $categoria;
	
    private $agotado;
	
    private $reseña;

    private $numEstrellas;
	
    private $imagen;

    private $unidades;

    private function __construct($nombreProd, $descripcion, $precio,$unidades, $unidadesDisponibles, $tallasDisponibles, $coloresDisponibles, $talla, $color, $categoria, $reseña, $agotado, $numEstrellas, $imagen)
    {
        $this->nombre = $nombreProd;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->unidades = $unidades;
        $this->unidadesDisponibles = $unidadesDisponibles;
		$this->tallasDisponibles= $tallasDisponibles;
        $this->coloresDisponibles = $coloresDisponibles;
        $this->talla = $talla;
        $this->color = $color;
		$this->categoria= $categoria;
        $this->agotado = $agotado;
        $this->reseña = $reseña;
        $this->numEstrellas = $numEstrellas;
		$this->imagen = $imagen;
    }

    public function id()
    {
        return $this->id;
    }

    public function nombre()
    {
        return $this->nombre;
    }

	public function descripcion()
    {
        return $this->descripcion;
    }

	public function unidades()
    {
        return $this->unidades;
    }
    public function precio()
    {
        return $this->precio;
    }
    
    public function tallasDisponibles()
    {
        return $this->tallasDisponibles; 
    }

    public function unidadesDisponibles()
    {
        return $this->unidadesDisponibles;
    }

    public function coloresDisponibles()
    {
        return $this->coloresDisponibles;
    }

    public function talla()
    {
        return $this->talla;
    }
    
    public function categoria()
    {
        return $this->categoria;
    }

    public function agotado()
    {
        return $this->agotado;
    }


    public function color()
    {
        return $this->color;
    }

    public function reseña()
    {
        return $this->reseña;
    }
    
    public function numEstrellas()
    {
        return $this->numEstrellas;
    }

    public function imagen()
    {
        return $this->imagen;
    }
}