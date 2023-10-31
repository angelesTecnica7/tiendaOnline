<?php
function mostrarProductos(){
    include('db/conexion.php');
    $sql="SELECT * FROM articles";
    $consulta=mysqli_query($conexion, $sql);
    while($registro=mysqli_fetch_assoc($consulta)){
        echo '<div class="card">
            <img src="images/'.$registro['Img_art'].'" alt="">
            <p class="art">'.$registro['Name_art'].'</p>
            <p class="cost">$'.$registro['Price_art'].'</p>
            <p class="stock">disponibilidad: '.$registro['Stock_art'].'</p>
            <a href=""><i class="fa-solid fa-cart-plus"></i> Agregar</a>
        </div>';
    };
}



?>