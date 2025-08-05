<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Panel de Administrador</title>
</head>

<body>

<?php
session_start();
$admin = "admin";

echo "Hola $admin.";

$servidor = "localhost";
$usuario = "tienda";
$password = "tienda";
$basedatos = "tiendareal";
?>

<h1>ELIJA OPCIÓN</h1>
<br>
<center>
    <a href="formulario_registro2.html"><button>Introducir Clientes</button></a><br>
    <br>
    <a href="Actualizar.php"><button>Actualizar Clientes</button></a><br>
    <br>
    <a href="Borrar.php"><button>Deshabilitar Clientes</button></a><br>
    <br>
    <a href="formulario_producto.php"><button>Introducir Productos</button></a><br>
    <br>
    <a href="ActualizarProductos.php"><button>Actualizar Productos</button></a><br>
    <br>
    <a href="BorrarProductos.php"><button>Deshabilitar Productos</button></a><br>
    <br>
    <a href="admincomprasver.php"><button>Compritas</button></a><br>
    <br>
    <form action="matasesion.php" method="post">
        <input type="submit" value="Desconectarse">
    </form>
</center>

</body>
</html>
