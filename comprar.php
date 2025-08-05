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

if (isset($_POST["productos"]) && is_array($_POST["productos"])) {
    $_SESSION["productos"] = $_POST["productos"];
    $_SESSION["cantidades"] = $_POST["cantidad"]; 
} else {
    echo "Dale aunque sea a uno, anda.";
    exit();
}

$productos = $_SESSION['productos'];
$cantidades = $_SESSION['cantidades'];

$total = 0; // Inicializamos el total de la compra

foreach ($productos as $producto) {
    $cantidad = $cantidades[$producto];

    $sql_precio = "SELECT precio FROM Producto WHERE nombre = '$producto'";
    $resultado_precio = $conexion->query($sql_precio);
    $fila_precio = $resultado_precio->fetch_assoc();
    $precio = $fila_precio["precio"];

    $subtotal = $precio * $cantidad;
    $total += $subtotal; // Acumulamos el subtotal al total de la compra

    $sql = "UPDATE Producto SET stock = stock - $cantidad WHERE nombre = '$producto'";
    $result = $conexion->query($sql);

    if (!$result) {
        echo "Error al actualizar el stock: " . $conexion->error;
        exit;
    }
}

$sql_insert_compra = "INSERT INTO Compras (fech_compra, nick, total) 
                      VALUES (NOW(), '$user', $total)";

if ($conexion->query($sql_insert_compra) === TRUE) {
    $id_compra = $conexion->insert_id;

    foreach ($productos as $producto) {
        $cantidad = $cantidades[$producto];
        $sql_insert_producto = "INSERT INTO Compras_Producto (id_compra, nombre_producto, nick, cantidad) 
                                VALUES ($id_compra, '$producto', '$user', $cantidad)";
        
        if (!$conexion->query($sql_insert_producto)) {
            echo "Error al insertar los productos '$producto': " . $conexion->error;
        }
    }

    echo "Compra realizada, muchas gracias por sus dineros.";
} else {
    echo "Error al insertar la compra: " . $conexion->error;
}

echo "<h2>Lo que has comprado, $user:</h2>";

if (isset($_SESSION["productos"]) && is_array($_SESSION["productos"])) {
    echo "<table border=1>";
    echo "<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr>";
    foreach ($productos as $producto) {
        $sql_precio = "SELECT precio FROM Producto WHERE nombre = '$producto'";
        $resultado_precio = $conexion->query($sql_precio);
        $fila_precio = $resultado_precio->fetch_assoc();
        $precio = $fila_precio["precio"];

        $cantidad = $cantidades[$producto];
        $subtotal = $precio * $cantidad;

        echo "<tr><td>$producto</td>";
        echo "<td>$precio €</td>";
        echo "<td><center>$cantidad</center></td>";
        echo "<td>$subtotal €</td></tr>";
    }
    echo "</table>";
    echo "<p>Total: $total €</p>";
} else {
    echo "No has comprado nada por el momento.";
}

$sql_viejas = "SELECT cp.id_compra, cp.nombre_producto, cp.cantidad, c.fech_compra, c.total
                FROM Compras_Producto cp
                JOIN Compras c ON cp.id_compra = c.id_compra
                WHERE cp.nick = '$user' AND c.fech_compra < NOW()";

$resultado_viejas = $conexion->query($sql_viejas);

echo "<h2>Tus anteriores, $user:</h2>";

if ($resultado_viejas->num_rows > 0) {
    echo "<table border=1><tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Total Producto</th><th>Total de compra</th><th>Fecha</th></tr>";
    while ($fila = $resultado_viejas->fetch_assoc()) {
        $id_compra = $fila["id_compra"];
        $nombre_producto = $fila["nombre_producto"];
        $cantidad = $fila["cantidad"];
        $fech_compra = $fila["fech_compra"];
        $total_compra = $fila["total"]; // Cambiado de "Total de compra" a "total"

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
        echo "<td>$total_compra €</td>"; // Mostrar el total de la compra
        echo "<td>$fech_compra</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No has comprado nada anteriormente.";
    echo "<br>";
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>comprar</title>
</head>
<body>
<br>
<a href="Inicio.php"><button>Volver a la tienda</button></a><br>
</body>
</html>
