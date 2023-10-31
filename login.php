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
    <link rel="stylesheet" href="css/style-login.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>tienda On-line</title>
</head>
<body>
    <header>
       <?php include('includes/header.php'); ?>
    </header>
    <section>
        <?php
        if(isset($_GET['senial'])){
            echo '<div class="error">Para ver el carrito debe ingresar al sistema</div>';
        }
        ?>
            <div class="contenedor">
            <form action="" method="post">
                <label for="usuario">Usuario</label>
                <input type="text" name="user" id="usuario">
                <label for="pass">Contraseña</label>
                <input type="password" name="pass" id="pass">
                <input type="submit" name="login" value="LOGIN">
            </form>
            <?php
            if(isset($_POST['login'])){
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $sql = "SELECT * FROM users WHERE Name = '$user' AND Pass = '$pass'";
                $query = mysqli_query($conexion, $sql);
                if(mysqli_num_rows($query)>0){
                    $row= mysqli_fetch_array($query);
                    $_SESSION['user'] = $user;
                    $_SESSION['ID_user'] = $row['ID_user'];
                    header('location:index.php');
                }else{
                    echo '<div class="error">usuario y/o contraseña incorrecta</div>';
                    session_destroy();
                }
            }
            ?>
            </div>
    </section>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
</body>
</html>