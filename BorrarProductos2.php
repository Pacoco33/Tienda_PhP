<?php

session_start();

    $borrar = $_POST["delviejo"];

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

        

        // Utilizamos el mismo nombre de campo que enviamos desde el formulario
        $sql = "UPDATE producto SET borrar = 1 WHERE nombre = '$borrar' OR id = '$borrar'";

        if ($conexion->query($sql) === TRUE) {
            echo "Se ha deshabilitado el producto $borrar correctamente";
        } else {
            echo "Ha ocurrido un Error: " . $conexion->error;
        }


        $conexion->close();
    }

?>

<br>
<a href="Menuadministrador.php"><button>Ir al menú</button></a>
