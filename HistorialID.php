<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar</title>
</head>
<body>

<?php


session_start();
$user = $_SESSION["usuario"];

$fecha = $_POST["fechaproducto"];

$servidor = "localhost";
$usuario = "cliente";
$password = "cliente";
$basedatos = "tiendareal";

$conexion = new mysqli($servidor, $usuario, $password, $basedatos);

if ($conexion->connect_error) {
    echo "La conexión ha fallado: " . $conexion->connect_error;
}

$sql_historial = "SELECT compras_producto.nick, compras_producto.id_compra, compras_producto.nombre_producto, compras.fech_compra, compras_producto.cantidad,compras.total
                  FROM compras_producto
                  INNER JOIN compras ON compras_producto.id_compra = compras.id_compra
                  WHERE compras_producto.nick = '$user' AND compras.fech_compra = '$fecha'";

               
$resultado_historial = $conexion->query($sql_historial);

echo "<h2>Tu historial con fecha $fecha, $user:</h2>";

if ($resultado_historial->num_rows > 0) {
    echo "<table border=1><tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Total Producto</th><th>Total de compra</th><th>Fecha</th></tr>";
    while ($fila = $resultado_historial->fetch_assoc()) {
        $id_compra = $fila["id_compra"];
        $nombre_producto = $fila["nombre_producto"];
        $cantidad = $fila["cantidad"];
        $fech_compra = $fila["fech_compra"];
        $total_compra = $fila["total"];
        
        $sql_precio_unitario = "SELECT precio FROM Producto WHERE nombre = '$nombre_producto'"; // Obtener el precio unitario del producto
        $resultado_precio_unitario = $conexion->query($sql_precio_unitario);
        $fila_precio_unitario = $resultado_precio_unitario->fetch_assoc();
        $precio_unitario = $fila_precio_unitario["precio"];

        
        $precio_total = $cantidad * $precio_unitario; // Calcular el precio total de la compra del producto

        echo "<tr>";
        echo "<td>$id_compra</td>";
        echo "<td>$nombre_producto</td>";
        echo "<td><center>$cantidad</center></td>";
        echo "<td>$precio_unitario €</td>";
        echo "<td>$precio_total €</td>";
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

<br>
<a href="inicio.php"><button>A la portada de productos</button></a><br>
</html>

