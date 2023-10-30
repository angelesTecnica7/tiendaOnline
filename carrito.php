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
    <link rel="stylesheet" href="css/style-carrito.css">
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>tienda On-line</title>
</head>
<body>
    <header>
       <?php include('includes/header.php'); ?>
    </header>
    <section>
    <p class="title">Carrito</p>
    <div class="carrito">
        <div class="producto">
            <p class="eliminar"><i class="fa-solid fa-trash"></i></p>
            <img src="" alt="">{Img_art}
            <p>{Name_art}</p>
            <p>Cantidad: - | 1 | +</p>
            <p>Precio Unit: {Price_art}</p>
            <p class="SubTotal">Sutotal: {Cantidad * Price_art}</p>
            <hr>  
        </div>

        <p class="total">Total: {Suma subtotales}</p>
        <a href="" class="comprar">Finalizar Compra</a>
        <div class="link">
        <a href="">Vaciar Carrito</a>
        <a href="">Seguir Comprando</a>
        </div>
    </div>
    </section>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
</body>
</html>