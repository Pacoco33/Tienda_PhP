<?php

session_start();

    $habilitar = $_POST["delnuevo"];

    $servidor = "localhost";
    $usuario = "admin";
    $password = "admin";
    $basedatos = "tiendareal";

    $conexion = new mysqli($servidor, $usuario, $password, $basedatos);

    if ($conexion->connect_error) {
        echo "La conexión ha fallado: " . $conexion->connect_error;
    } else {
        $conexion->select_db($basedatos);
        $conexion->set_charset("utf8");

        $conexion->query("SET FOREIGN_KEY_CHECKS=0");

        
        $sql = "UPDATE cliente SET borrar = 0 WHERE Nick = '$habilitar'";

        if ($conexion->query($sql) === TRUE) {
            echo "Se ha habilitado al cliente $habilitar correctamente";
        } else {
            echo "Ha ocurrido un Error: " . $conexion->error;
        }

        $conexion->query("SET FOREIGN_KEY_CHECKS=1");

        $conexion->close();
    }

?>

<br>
<a href="Menuadministrador.php"><button>Ir al menú</button></a>