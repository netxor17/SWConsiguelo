<?php
namespace es\fdi\ucm\aw;
//require_once __DIR__ . '/Aplicacion.php';
require_once __DIR__ . '/funciones.inc';


class Imagen
{
    private function __construct($nombre, $nombreUsuario, $password,  $dni, $direccion, $email, $telefono, $ciudad, $codigoPostal, $tarjetaCredito )


    private static function inserta($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        //console_log($usuario);
        $query=sprintf("INSERT INTO `usuarios` (`dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `carrito`, `tarjeta credito`) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%i', '%i')"
            , $conn->real_escape_string($usuario->dni)    
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->telefono)
            , $conn->real_escape_string($usuario->ciudad)
            , $conn->real_escape_string($usuario->codigoPostal)
            , $conn->real_escape_string($usuario->carrito)
            , $conn->real_escape_string($usuario->tarjetaCredito));

        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
    
    private static function actualiza($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios U SET nombre='%s', password='%s', nombreUsuario='%s',  dni='%s', direccion='%s', email='%s', telefono='%s', ciudad='%s', codigo postal='%s', carrito='%i', trajeta credito='%i'   WHERE U.id=%i"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->telefono)
            , $conn->real_escape_string($usuario->codigoPostal)
            , $conn->real_escape_string($usuario->carrito )
            , $conn->real_escape_string($usuario->tarjetaCredito )
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }

    
    private $id;

    private $password;

    private $dni;

    private $direccion;

    private $email;

    private $telefono;

    private $ciudad;

    private $codigoPostal;

    private $carrito;

    private $tarjetaCredito;

    private $nombreUsuario;


    private function __construct($nombre, $nombreUsuario, $password,  $dni, $direccion, $email, $telefono, $ciudad, $codigoPostal, $tarjetaCredito )
    {
        $this->nombre = $nombre;
        $this->nombreUsuario= $nombreUsuario;
        $this->password = $password;
        $this->dni = $dni;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->ciudad = $ciudad;
        $this->codigoPostal = $codigoPostal;
        $this->carrito = 0; //new carrito
        $this->tarjetaCredito = $tarjetaCredito;
    }

    public function id()
    {
        return $this->id;
    }

    public function password()
    {
        return $this->password;
    }

    public function nombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function dni()
    {
        return $this->dnis;
    }

    public function direccion()
    {
        return $this->direccion;
    }

    public function email()
    {
        return $this->email;
    }

    public function telefono()
    {
        return $this->telefono;
    }

    public function ciudad()
    {
        return $this->ciudad;
    }

    public function codigoPostal()
    {
        return $this->codigoPostal;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function carrito()
    {
        return $this->carrito;
    }

    public function compruebaPassword($password)
    {
       /* echo $password;
        echo "<br>";
        
        echo $this->password;
        echo "<br>";*/

        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
}