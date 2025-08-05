<?php
session_start();

$nicky = $_POST["nicky"];
$atributo = $_POST["atributo"];
$viejo = $_POST["viejo"];
$nuevo = $_POST["nuevo"];

$servidor = "localhost";
$usuario = "admin";
$password = "admin";
$basedatos = "tiendareal";

$conexion = new mysqli($servidor, $usuario, $password, $basedatos);

if ($conexion->connect_error) {
    die("La conexión ha fallado: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
$conexion->query("SET FOREIGN_KEY_CHECKS=0");

$sql = "UPDATE cliente SET $atributo = '$nuevo' WHERE $atributo = '$viejo' AND Nick = '$nicky'";


if (!empty($atributo) && !empty($viejo) && !empty($nuevo)) {
    if ($conexion->query($sql) === TRUE) {
        echo "Se ha actualizado la lista de clientes<br>";
        echo "<br>";
        echo "Se han modificado " . $conexion->affected_rows . " personas";
    } else {
        echo "Ha ocurrido un Error: " . $conexion->error;
    }
} else {
    echo "Falta uno o más campos requeridos.";
}

$conexion->query("SET FOREIGN_KEY_CHECKS=1");
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar al cliente</title>
</head>
<body>
<br>
<a href="Menuadministrador.php"><button>Ir al menu</button></a>
</body>
</html>