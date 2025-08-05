<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Datos</title>
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

$nick = $_POST["nick"];
$contra = $_POST["contra"];
$dni = $_POST["dni"];
$nombre = $_POST["nombre"];
$ap1 = $_POST["ap1"];
$ap2 = $_POST["ap2"];
$telef = $_POST["tlf"];
$email = $_POST["email"];
$tipovia = $_POST["tipo_via"];
$nombrevia = $_POST["nombre_via"];
$numevia = $_POST["num_via"];
$bloque = $_POST["bloque"];
$portal = $_POST["portal"];
$escalera = $_POST["escalera"];
$planta = $_POST["planta"];
$puerta = $_POST["puerta"];
$localidad = $_POST["nom_loc"];
$provincia = $_POST["nom_prov"];
$fecha = $_POST["fecha"];


$sql_user = "SELECT Nick,contrasenia FROM cliente WHERE Nick = '$nick' OR contrasenia = '$contra'";

$user_existe = $conexion->query($sql_user);


if ($user_existe->num_rows > 0) {//Si la consulta devuelve más de 0 resultados
    echo "El usuario y/o la contraseña ya están en uso.";
} else {
    
    $conexion->query("SET FOREIGN_KEY_CHECKS=0");

    $sql = "INSERT INTO cliente (Nick, dni, ap1, ap2, tlf, email, tipo_via, nombre_via, num_via, bloque, 
                                                  portal, escalera, planta, puerta, fecha_alta, nom_loc, nom_prov, contrasenia, nombre) 
                             VALUES ('$nick', '$dni', '$ap1', '$ap2', '$telef', '$email', '$tipovia', '$nombrevia', '$numevia', '$bloque', 
                                     '$portal', '$escalera', '$planta', '$puerta', '$fecha', '$localidad', '$provincia', '$contra', '$nombre')";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario creado correctamente.¡Hola $nick!";
    } else {
        echo "Ha ocurrido un Error: " . $conexion->error;
    }

    $conexion->query("SET FOREIGN_KEY_CHECKS=1");
}


$conexion->close();

?>
<br>
<a href="Index.html"><button>Ir al menu</button></a>

</body>
</html>

