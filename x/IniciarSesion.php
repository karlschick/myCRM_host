<?php   
    session_start();
    include('Conexion.php');

    if (isset($_POST['usuario']) && isset($_POST['clave']) ) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = validate($_POST['usuario']); 
    $clave = validate($_POST['clave']);

    if (empty($usuario)) {
        header("Location: Login.php?error=El usuario Es Requerido");
        exit();
    }elseif (empty($clave)) {
        header("Location: Login.php?error=La clave Es Requerida");
        exit();
    }else{

        // $Clave = md5($Clave);

        $Sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave='$clave'";
        $result = mysqli_query($conexion, $Sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['usuario'] === $usuario && $row['clave'] === $clave) {
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['Nombre_Completo'] = $row['Nombre_Completo'];
                $_SESSION['Id'] = $row['Id'];
                header("Location: ../Inicio.php");
                exit();
            }else {
                header("Location: Login.php?error=El usuario o la clave son incorrectas");
                exit();
            }

        }else {
            header("Location: Login.php?error=El usuario o la clave son incorrectas");
            exit();
        }
    }

} else {
    header("Location: Login.php");
            exit();
}

