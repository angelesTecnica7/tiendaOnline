<div class="title">
    <a href="index.php"><p>Tienda On-line</p></a>
</div>
<div class="icons">
    <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
    <?php
            if(isset($_SESSION['user'])){
                echo '
                <a href="perfil.php">
                <i class="fa-regular fa-user"></i>'. $_SESSION['user'];
            }else{
                echo '
                <a href="login.php">
                <i class="fa-regular fa-user"></i>';
            }
        ?>
    </a>
    <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
</div>