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

$sql = "SELECT Nick,borrar FROM cliente WHERE borrar = 0";
$res = $conexion->query($sql);

echo "<b>Clientes Habilitados</b>";

if ($res) {
    echo "<table border=1><tr><th>Nick</th></tr>";
    while ($fila = $res->fetch_assoc()) {
        echo "<tr><td>{$fila["Nick"]}</td></tr>";
    }
    echo "</table>";
    $res->close();
} else {
    echo "Fallo al obtener la lista de clientes";
}

echo "<br>";

$sql2 = "SELECT Nick,borrar FROM cliente WHERE borrar = 1";
$res2 = $conexion->query($sql2);

echo "<b>Clientes Deshabilitados</b>";

if ($res2) {
    echo "<table><tr><th>Nick</th></tr>";
    while ($fila = $res2->fetch_assoc()) {
        echo "<tr><td>{$fila["Nick"]}</td></tr>";
    }
    echo "</table>";
    $res2->close();
} else {
    echo "Fallo al obtener la lista de clientes";
}

echo "<br>";

$conexion->close(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Deshabilitar/Habilitar el cliente</title>
</head>
<body>
    <b>Escoja el nick del usuario a desactivar o a activar</b>
    <form action="Borrar2.php" method="post">

        <p><b>Escoge Nick</b></p>
        <label for="delviejo"><b>Deshabiliar:</b></label><br>
        <input type="text" name="delviejo" id="delviejo" size="25" maxlength="40" required /><br>
        <br>
        <button type="submit">Deshabilitar</button>
    </form>
    <br>
    <form action="Borrar3.php" method="post">

        <p><b>Escoge Nick</b></p>
        <label for="delnuevo"><b>Habilitar:</b></label><br>
        <input type="text" name="delnuevo" id="delnuevo" size="25" maxlength="40" required /><br>
        <br>
        <button type="submit">Habilitar</button>
    </form>
    <br>
<a href="Menuadministrador.php"><button>Volver al menú de administrador</button></a><br>
</body>
</html>