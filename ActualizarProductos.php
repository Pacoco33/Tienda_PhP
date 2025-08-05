<?php

session_start();
$admin = "admin";


echo "Hola $admin!";

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

$sql = "SELECT id,nombre,editorial,tipo,precio,stock FROM producto";
$res = $conexion->query($sql);

if ($res) {
    echo "<table border=1><tr><th>ID</th><th>Nombre</th><th>Editorial</th><th>Tipo</th><th>Precio</th><th>Stock</th></tr>";
    while ($fila = $res->fetch_assoc()) {
        echo "<tr><td>{$fila["id"]}</td>";
        echo "<td>{$fila["nombre"]}</td>";
        echo "<td>{$fila["editorial"]}</td>";
        echo "<td>{$fila["tipo"]}</td>";
        echo "<td>{$fila["precio"]}</td>";
        echo "<td>{$fila["stock"]}</td></tr>";
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
    <title>Actualizar los productos</title>
</head>
<body>
    <h1>Escoja el atributo a modificar</h1>
    <form action="ActualizarProductos2.php" method="post">

        <p><strong>Elige el atributo que quieres modificar:</strong></p>
        <select name="atributo" id="atributo">
            <option value="id">ID</option>
            <option value="nombre">Nombre</option>
            <option value="editorial">Editorial</option>
            <option value="tipo">Tipo</option>
            <option value="precio">Precio</option>
            <option value="stock">Stock</option>
        </select><br>
        <br>
        <label for="viejo"><b>Nombre del producto a actualizar:</b></label><br>
        <input type="text" name="produc" id="produc" size="25" maxlength="40" required /><br>
        <p><b>El valor a cambiar</b></p>
        <label for="viejo"><b>Valor antiguo:</b></label><br>
        <input type="text" name="viejo" id="viejo" size="25" maxlength="40" required /><br>
            
        <label for="nuevo"><b>Valor nuevo:</b></label><br>
        <input type="text" name="nuevo" id="nuevo" size="25" maxlength="30" required /><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <br>
<a href="Menuadministrador.php"><button>Volver al menú de administrar productos</button></a><br>
</body>
</html>