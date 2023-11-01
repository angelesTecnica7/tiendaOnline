<?php
function mostrarProductos(){
    include('db/conexion.php');
    $sql="SELECT * FROM articles";
    $consulta=mysqli_query($conexion, $sql);
    while($registro=mysqli_fetch_assoc($consulta)){
        echo '<div class="card">
            <img src="images/'.$registro['Img_art'].'" alt="">
            <p class="art">'.$registro['Name_art'].'</p>
            <p class="cost">$'.number_format($registro['Price_art'],2,",",".").'</p>
            <p class="stock">disponibilidad: '.$registro['Stock_art'].'</p>
            <a href="carrito.php?ID_prod='.$registro['ID_art'].'"><i class="fa-solid fa-cart-plus"></i> Agregar</a>
        </div>';
    };
}

function mostrarCarrito(){
    echo '
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
        <a href="index.php">Seguir Comprando</a>
        </div>
    </div>';
}



?>