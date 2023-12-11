<?php
include('conexion.php');
session_start();

$id_producto = $_GET['id'];

$sql = "INSERT INTO carrito SET id_usuario = $_SESSION[id], id_prod = $id_producto, cantidad = null";

$result = $conn->query($sql);

if ($result) { ?>
    <script>
        if (confirm("Se agrego el producto al carrito")) {
            window.location = 'index.php'
        }else{
            window.location = 'index.php'
        }
    </script>
<?php
} else { ?>

    <script>
        if (confirm("Ocurrio un error, no se pudo agregar el producto")) {
            window.location = 'index.php'
        }else{
            window.location = 'index.php'
        }
    </script>
<?php
}
?>