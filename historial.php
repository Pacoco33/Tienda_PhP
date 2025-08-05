<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
</head>
<body>

<?php
session_start();
$user = $_SESSION["usuario"];

$servidor = "localhost";
$usuario = "cliente";
$password = "cliente";
$basedatos = "tiendareal";

$conexion = new mysqli($servidor, $usuario, $password, $basedatos);

if ($conexion->connect_error) {
    echo "La conexión ha fallado: " . $conexion->connect_error;
}

$sql_historial = "SELECT cp.id_compra, cp.nombre_producto, cp.cantidad, c.fech_compra, c.total
                  FROM Compras_Producto cp
                  JOIN Compras c ON cp.id_compra = c.id_compra
                  WHERE cp.nick = '$user' AND c.fech_compra < NOW()";

$resultado_historial = $conexion->query($sql_historial);

echo "<h2>Tu historial de compra, $user:</h2>";

if($resultado_historial) {
    echo "<table border=1><tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Total Producto</th><th>Total de compra</th><th>Fecha</th></tr>";
    while ($fila = $resultado_historial->fetch_assoc()) {
        $id_compra = $fila["id_compra"];
        $nombre_producto = $fila["nombre_producto"];
        $cantidad = $fila["cantidad"];
        $fech_compra = $fila["fech_compra"];
        $total_compra = $fila["total"];
        // Obtener el precio unitario del producto
        $sql_precio_unitario = "SELECT precio FROM Producto WHERE nombre = '$nombre_producto'";
        $resultado_precio_unitario = $conexion->query($sql_precio_unitario);
        $fila_precio_unitario = $resultado_precio_unitario->fetch_assoc();
        $precio_unitario = $fila_precio_unitario["precio"];

        // Calcular el precio total del producto
        $precio_total_producto = $cantidad * $precio_unitario;

        echo "<tr>";
        echo "<td>$id_compra</td>";
        echo "<td>$nombre_producto</td>";
        echo "<td><center>$cantidad</center></td>";
        echo "<td>$precio_unitario €</td>";
        echo "<td>$precio_total_producto €</td>";
        echo "<td>$total_compra €</td>"; 
        echo "<td>$fech_compra</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No has comprado nada anteriormente.";
    echo "<br>";
}

?>
<form action="HistorialID.php" method="POST">
    <label for="fechaproducto">Escriba fecha para buscar producto:</label><br>
    <input type="text" id="fechaproducto" name="fechaproducto" maxlength="50" required><br><br>
    <input type="submit" value="Historial por Fecha">
</form>
<br>
<a href="inicio.php"><button>A la portada de productos</button></a><br>
</body>
</html>
