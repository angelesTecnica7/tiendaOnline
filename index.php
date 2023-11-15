<?php
session_start();
require_once('db/conexion.php');
require_once('includes/functionCart.php');
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <title>tienda On-line</title>
</head>
<body>
    <header>
       <?php include('includes/header.php'); ?>
    </header>
    <section>
    <p class="title">Nuestros Productos</p>

    <div id="buscador">
            <label for="">buscar</label><input type="text" name="buscar_prod" id="buscar" onkeyup="buscar_prod($('#buscar').val());" >
        </div>
   
        <div id="datos_buscador"></div>

    <?php
        if(isset($_GET['finCompra'])){
            finalizarCompra();
        }
    // mostrarProductos();
   
    ?>
            
    </section>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
    <script src="js/buscador.js"></script>
</body>
</html>