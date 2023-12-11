<?php
include('conexion.php');
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_usuario"] <= 0) {
    header("location: login.php");
}

$sql = "SELECT * FROM productos WHERE id_prod NOT IN (SELECT id_prod FROM carrito WHERE id_prod = $_SESSION[id_usuario])";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            background-color: #f4f8f7;
        }

        .contain {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
        }

        .card {
            width: 90%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.08);
            margin: 10px 0;
            background-color: white;
            border-radius: 2%;
        }

        .img {
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .acciones {
            width: 60%;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h2>Productos</h2>
    <button onclick="window.location='carrito.php'">Ver carrito</button>

    <div class="contain">
        <?php while ($row  = $result->fetch_assoc()) { ?>
            <div class="card">
                <div class="img"><img src="<?= $row['img'] ?>" alt="img"></div>
                <div class="acciones">
                    <h3><?= $row['codigo'] ?></h3>
                    <p><small><?= $row['descripcion'] ?></small></p> <br>
                    <p>Cantidad disponible: <?= $row['cantidad'] ?></p><br>
                    <p><?= "$" . number_format($row['precio_venta'], 2) ?></p> <br><br>
                    <button onclick="addProduct(this.id)" id="<?= $row['id_prod'] ?>">Añadir al carrito</button>
                </div>
            </div>
        <?php } ?>
    </div>
    <script>
        function addProduct(id) {
            window.location = "accion.php?id=" + id;
        }
    </script>
</body>

</html>