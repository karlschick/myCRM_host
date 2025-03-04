<?php

// Clase encargada de control de seguridad de el sistema de informacion

class seguridad{
    private $usuario = null;

    function __construct ()
    {
        //iniciamos la sesion
        session_start();
        if(isset($_SESSION["usuario"])) $this ->$usuario=$_SESSION["usuario"];
    }

    public function getUsuario(){
        return $this->$usuario;
    }

    public function addUsuario($usuario){
        $_SESSION["usuario"]=$usuario;
        $this->usuario=$usuario;
    }
}

?>