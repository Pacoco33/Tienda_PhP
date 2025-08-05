<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
</head>

<body>

    <h1>Pacoco's Place. Compra barato</h1>
    <br>

    <h2>Productos disponibles:</h2>
    <br>

    <form action="comprar.php" method="post">
        <center><table border="1">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Cantidad</th>
                <th>Imagen</th>
            </tr>
            <?php

            session_start();
            $user = $_SESSION["usuario"];

            echo "Hola $user!";

            $servidor = "localhost";
            $usuario = "cliente";
            $password = "cliente";
            $basedatos = "tiendareal";

            $conexion = new mysqli($servidor, $usuario, $password, $basedatos);

            if ($conexion->connect_error) {
                die("La conexión ha fallado: " . $conexion->connect_error);
            }

            $sql = "SELECT nombre, precio, stock FROM Producto WHERE borrar = 0";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {

                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";

                    $nombre_producto = $fila["nombre"];
                    $precio = $fila["precio"];
                    $stock = $fila["stock"];

                    
                    if ($stock > 0) { //Si el stock es mayor que 0 para mostrar la imagen correspondiente
                        $ruta_imagen = "imagenes/$nombre_producto.jpg";
                    } else {
                        $ruta_imagen = "imagenes/prohibido.jpg";
                    }

                    
                    if ($stock > 0) { //Si el stock es mayor que 0 para permitir al cliente marcar el producto
                        echo "<td><input type='checkbox' name='productos[]' value='$nombre_producto'> $nombre_producto</td>";
                    } else {
                        echo "<td>$nombre_producto</td>";
                    }

                    echo "<td>$precio €</td>";
                    echo "<td><center>$stock</center></td>";

                    
                    if ($stock > 0) { //Si el stock es mayor que 0, dejamos que el cliente seleccione cantidad
                        echo "<td><input type='number' name='cantidad[$nombre_producto]' value='NULL' min='0' max='$stock'></td>";
                    } else {
                        echo "<td>0</td>";
                    }

                    echo "<td><img src='$ruta_imagen' alt='$nombre_producto' style='width: 100px;'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay nada.</td></tr>";
            }

            $conexion->close();

            ?>
        </table></center>
        <input type="submit" value="Comprar">
    </form>
    <br>
    <a href="Actualizar_cliente.php"><button>Actualice sus datos</button></a><br>
    <br>
    <form action="matasesion.php" method="post">
        <input type="submit" value="Desconectarse">
    </form>
    <br>
    <a href="historial.php"><button>Historial</button></a><br>
    <br>
</body>

</html>
