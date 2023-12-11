<?php
include('conexion.php');
session_start();
error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['nombre'];
    $password = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE nombre='$username' AND clave='$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['correo'] = $row['correo'];
        ?>
        <script>
            alert('Inicio de sesión exitoso. ¡Bienvenido, <?= $username ?>!')
            window.location = "index.php";
        </script>
    <?php } else { ?>
        <script>
            alert('Credenciales inválidas. Por favor, inténtalo nuevamente.')
        </script>
<?php }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script>
        function validateForm() {
            var nombre = document.forms["loginForm"]["nombre"].value;
            var clave = document.forms["loginForm"]["correo"].value;

            if (username == "" || password == "") {
                alert("Por favor, completa todos los campos");
                return false;
            }
        }
    </script>
</head>

<body>
    <form name="loginForm" action="login.php" method="post" onsubmit="return validateForm()">
        <label for="nombre">Usuario:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave"><br><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>

</html>