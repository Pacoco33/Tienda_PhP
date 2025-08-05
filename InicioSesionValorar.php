 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>

<?php
    
        $servidor = "localhost";
        $usuarioDB = "root";
        $passwordDB = "";
        $basedatos = "tiendareal";

        $conexion = new mysqli($servidor, $usuarioDB, $passwordDB, $basedatos);

        if ($conexion->connect_error) {
            echo "La conexión ha fallado: " . $conexion->connect_error;
        }

        $conexion->set_charset("utf8");

        $usuario = $_POST["nombre"];
        $pass = $_POST["pass"];

        
        $sql = "SELECT Nick,contrasenia,borrar FROM cliente WHERE Nick = '$usuario' AND contrasenia = '$pass'";
        
        $resultado = $conexion->query($sql);//Metemos la consulta en una variable
        
        
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();//Metemos la consulta en un array
                
    
                if ($fila["borrar"] == 0) {//Hacemos la consulta a partir del array, cogiendo el atributo "borrar"
                    
                    session_start();
                    $_SESSION["usuario"] = $usuario;

                    echo "Hellou $usuario!";

                    header("Location: Inicio.php");
                    exit();

                } else {
                    echo "¡Ay señor señor, usted está deshabilitado!";
                     
                }
            } else {
                echo "Usuario/Contraseña Incorrectos";
            }
        } 
      
        

        if ($usuario == "admin" && $pass == "admin"){

            session_start();
            $_SESSION["usuario"] = $usuario;
            echo "Hellou $usuario!";

            header("Location: Menuadministrador.php");
            exit();
        }
        

        $conexion->close();
    
?>
</body>
<br>
<a href="index.html"><button>Al inicio de sesión</button></a><br>
</html>
