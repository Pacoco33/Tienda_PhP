<?php

session_start();

$servidor = "localhost";
$usuario = "admin";
$password = "admin";
$basedatos = "tiendareal";

$conexion = new mysqli($servidor, $usuario, $password, $basedatos);

if ($conexion->connect_error) {
    die("La conexión ha fallado: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");


$conexion->select_db($basedatos);

$sql = "SELECT id,nombre FROM producto";
$res = $conexion->query($sql);

if ($res) {
    echo "<table border=1><tr><th>ID</th><th>Nombre</th></tr>";
    while ($fila = $res->fetch_assoc()) {
        echo "<tr><td>{$fila["id"]}</td>";
        echo "<td>{$fila["nombre"]}</td></tr>";
    }
    echo "</table>";
    $res->close(); 
} else {
    echo "Fallo al obtener la lista de productos";
}

$conexion->close(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Deshabilitar un producto</title>
</head>
<body>
    <h1>Escoja el nombre o ID a deshabilitar</h1>
    <form action="BorrarProductos2.php" method="post">

        <p><b>El valor a deshabilitar</b></p>
        <label for="delviejo"><b>Borrar:</b></label><br>
        <input type="text" name="delviejo" id="delviejo" size="25" maxlength="40" required /><br>

        <button type="submit">Borrar</button>
    </form>
    <br>
<a href="Menuadministrador.php"><button>Volver al menú de administrador</button></a><br>
</body>
</html>