<?php
include('../db/conexion.php');
    if(!empty($_POST['buscar'])){
        $sql = "SELECT * FROM articles WHERE Name_art LIKE '%".$_POST['buscar']."%' ";
        }else{
        $sql="SELECT * FROM articles";
    }
    $consulta = mysqli_query($conexion, $sql);
    while($registro=mysqli_fetch_assoc($consulta)){
        echo '<div class="card">
            <img src="images/'.$registro['Img_art'].'" alt="">
            <p class="art">'.$registro['Name_art'].'</p>
            <p class="cost">$'.number_format($registro['Price_art'],2,",",".").'</p>
            <p class="stock">disponibilidad: '.$registro['Stock_art'].'</p>
            <a href="carrito.php?ID_prod='.$registro['ID_art'].'"><i class="fa-solid fa-cart-plus"></i> Agregar</a>
            </div>';
    };

?>