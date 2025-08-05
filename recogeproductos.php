<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Datos productos</title>
</head>
<body>

<?php

$servidor = "localhost";
$usuario = "admin";
$password = "admin";
$basedatos = "tiendareal";

$conexion = new mysqli($servidor, $usuario, $password, $basedatos);

if ($conexion->connect_error) {
    echo "La conexión ha fallado: " . $conexion->connect_error;
}

$conexion->set_charset("utf8");

$nombre = $_POST["nombre"];
$editorial = $_POST["editorial"];
$tipo = $_POST["tipo"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$id = $nombre.$editorial.$tipo;

$sql_producto = "SELECT id FROM producto WHERE id = '$id'";
$producto_existe = $conexion->query($sql_producto);

if ($producto_existe->num_rows > 0) {
    echo "El producto ya está registrado.";
} else {
    $sql = "INSERT INTO producto (id, nombre, editorial, tipo, precio, stock) 
            VALUES ('$id', '$nombre', '$editorial', '$tipo', '$precio', '$stock')";

    if ($conexion->query($sql) === TRUE) {
        echo "El producto $nombre se ha agregado a la base de datos";
    } else {
        echo "Ha ocurrido un error: " . $conexion->error;
    }
}

$conexion->close();

?>
<br>
<a href="Menuadministradorproductos.html"><button>Ir al menú</button></a>

</body>
</html>
