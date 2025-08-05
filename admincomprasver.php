<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Panel de compras administrador</title>
</head>

<body>

<?php
session_start();
$admin = "admin";

echo "Hola $admin.";
echo "<br>";

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

$sql = "SELECT Nick,fecha_alta FROM cliente";
$res = $conexion->query($sql);

echo "Usuarios de tu página";

if ($res) {
    echo "<table border=1><tr><th>Nick</th><th>Fecha de Alta</th></tr>";
    while ($fila = $res->fetch_assoc()) {
        echo "<tr><td>{$fila["Nick"]}</td>";
        echo "<td>{$fila["fecha_alta"]}</td></tr>";
    }
    echo "</table>";
    $res->close();
} else {
    echo "Fallo al obtener la lista de clientes";
}



?>
<b>Seleccione un nick para ver sus compras</b>
<br>

<form action="chequeacomprasadmin.php" method="post">

        <p><b>Escoge Nick</b></p>
        <br>
        <label for="compras"><b>Ver las compras de:</b></label><br>
        <input type="text" name="compras" id="compras" size="25" maxlength="40" required /><br>
        <br>
        <button type="submit">Ver</button>
    </form>
<br>

<a href="Menuadministrador.php"><button>Volver a menú administrar productos</button></a><br>
<br>
</body>
</html>
