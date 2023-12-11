<?php
include('conexion.php');
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_usuario"] <= 0) {
    header("location: login.php");
}

$sql = "SELECT p.* FROM carrito c
        JOIN productos p ON c.id_prod = p.id_prod
        WHERE c.id_usuario = " . $_SESSION['id_usuario'];
$result = $conn->query($sql);
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carrito</title>
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
    <h2>Carrito</h2>
    <div class="contain">
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row  = $result->fetch_assoc()) { ?>
                <div class="card">
                    <div class="img"><img src="<?= $row['img'] ?>" alt="img"></div>
                    <div class="acciones">
                        <h3><?= $row['codigo'] ?></h3>
                        <p><small><?= $row['descripcion'] ?></small></p> <br>
                        <p><?= "$" . number_format($row['precio_venta'], 2) ?></p> <br><br>
                    </div>
                </div>
            <?php
                $total += $row['precio_venta'];
            }
            ?>
            <div class="total">
                <p>Total: <?= "$" . number_format($total, 2) ?></p>
            </div>
        <?php }else{
            echo 'Carrito vacio';
        } ?>
    </div>
</body>

</html>