<?php
session_start();
require_once('db/conexion.php');
require_once('includes/funtionCar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-main.css">
    <link rel="stylesheet" href="css/style-header.css">
    <link rel="stylesheet" href="css/style-footer.css">
    <link rel="stylesheet" href="css/style-articles.css">
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>tienda On-line</title>
</head>
<body>
    <header>
       <?php include('includes/header.php'); ?>
    </header>
    <section>
    <p class="title">Nuestros Productos</p>
            <div class="card">
                <img src="images/default_art.jpg" alt="">
                <p class="art">{Nbr-prod}</p>
                <p class="cost">$380 {Precio}</p>
                <p class="stock">disponibilidad{Stock}: 4000</p>
                <a href=""><i class="fa-solid fa-cart-plus"></i> Agregar</a>
            </div>
    </section>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
</body>
</html>