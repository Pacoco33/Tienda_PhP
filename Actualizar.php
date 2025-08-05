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

$sql = "SELECT Nick,dni,ap1,ap2,tlf,email,tipo_via,nombre_via,num_via,bloque,portal,escalera,planta,puerta,
               nom_loc,nom_prov,contrasenia,nombre FROM cliente";
$res = $conexion->query($sql);

if ($res) {
    echo "<table border=1> <tr> <th>DNI</th><th>Nick</th><th>Password</th><th>Nombre</th><th>1er Apellido</th><th>2º Apellido</th><th>TLF</th><th>Email</th><th> Vía</th><th> Nomb.Via</th>
        <th> Nº Vía</th><th> Bloque</th><th> Portal</th><th> Escalera</th><th> Planta</th><th> Puerta</th><th> Localidad</th><th> Provincia</th></tr>";
    while ($fila = $res->fetch_assoc()) {
        echo "<tr> <td>{$fila["dni"]}</td>";
        echo "<td>{$fila["Nick"]}</td>";
        echo "<td>{$fila["contrasenia"]}</td>";
        echo "<td>{$fila["nombre"]}</td>";
        echo "<td>{$fila["ap1"]}</td>";
        echo "<td>{$fila["ap2"]}</td>";
        echo "<td>{$fila["tlf"]}</td>";
        echo "<td>{$fila["email"]}</td>";
        echo "<td>{$fila["tipo_via"]}</td>";
        echo "<td>{$fila["nombre_via"]}</td>";
        echo "<td>{$fila["num_via"]}</td>";
        echo "<td>{$fila["bloque"]}</td>";
        echo "<td>{$fila["portal"]}</td>";
        echo "<td>{$fila["escalera"]}</td>";
        echo "<td>{$fila["planta"]}</td>";
        echo "<td>{$fila["puerta"]}</td>";
        echo "<td>{$fila["nom_loc"]}</td>";
        echo "<td>{$fila["nom_prov"]}</td></tr>";
    }
    echo "</table>";
    $res->close(); 
} else {
    echo "Fallo al obtener la lista de personas";
}

$conexion->close(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar al cliente</title>
</head>
<body>
    <h1>Escoja el atributo a modificar</h1>
    <form action="Actualizar2.php" method="post">

        <p><strong>Elige el atributo que quieres modificar:</strong></p>
        <select name="atributo" id="atributo">
            <option value="DNI">DNI</option>
            <option value="Nick">Nick</option>
            <option value="contrasenia">Password</option>
            <option value="nombre">Nombre</option>
            <option value="ap1">Apellido Primero</option>
            <option value="ap2">Apellido Segundo</option>
            <option value="tlf">Teléfono</option>
            <option value="email">Email</option>
            <option value="tipo_via">Tipo de via</option>
            <option value="nombre_via">Nombre de la via</option>
            <option value="num_via">Número</option>
            <option value="bloque">Bloque</option>
            <option value="portal">Portal</option>
            <option value="escalera">Escalera</option>
            <option value="planta">Planta</option>
            <option value="puerta">Puerta</option>
            <option value="nom_loc">Localidad</option>
            <option value="nom_prov">Provincia</option>
        </select><br>
        <br>
        <label for="viejo"><b>Nick del cliente a cambiar:</b></label><br>
        <input type="text" name="nicky" id="nicky" size="25" maxlength="40" required /><br>
        <p><b>El valor a cambiar</b></p>
        <label for="viejo"><b>Valor antiguo:</b></label><br>
        <input type="text" name="viejo" id="viejo" size="25" maxlength="40" required /><br>
            
        <label for="nuevo"><b>Valor nuevo:</b></label><br>
        <input type="text" name="nuevo" id="nuevo" size="25" maxlength="30" required /><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="Menuadministrador.php"><button>Ir al menu</button></a>
</body>
</html>
