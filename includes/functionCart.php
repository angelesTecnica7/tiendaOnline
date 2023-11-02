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
    $carrito = $_SESSION['carrito'];
    $total=0;
    foreach ($carrito as $indice => $producto) {
    echo '
    <div class="carrito">
        <div class="producto">
            <p class="eliminar"><i class="fa-solid fa-trash"></i></p>
            <img src="images/'.$producto['img_prod'].'" alt="">
            <p>'.$producto['nbr_prod'].'</p>
            <p>Cantidad: - | '.$producto['cantidad'].' | + </p>
            <p>Precio Unit: $'.$producto['precio_prod'].'</p>
            <p class="SubTotal">Subtotal: $'.$producto['cantidad'] * $producto['precio_prod'].'</p>
            <hr>  
        </div>';
        $total = $total + $producto['cantidad'] * $producto['precio_prod'];
    }
    echo '
        <p class="total">Total:$'.$total.'</p>
        <a href="" class="comprar">Finalizar Compra</a>
    <div class="link">
        <a href="">Vaciar Carrito</a>
        <a href="index.php">Seguir Comprando</a>
        </div>
    </div>';
}

function mostrarCarritoVacio(){
    echo '
    <div class="carrito">
    <div class="error">Carrito vacio <a href="index.php">Ir a Tienda</a></div>
    </div>';
}

function agregarProdCarrito($ID_prod){
    include('db/conexion.php');
    $sql="SELECT * FROM articles WHERE ID_art = '$ID_prod'";
    $consulta=mysqli_query($conexion, $sql);
    $registro=mysqli_fetch_assoc($consulta);
    
    if(!isset($_SESSION['carrito'])){
        $nuevo_prod[]= array('img_prod'=> $registro['Img_art'],
                    'nbr_prod'=>$registro['Name_art'],
                    'precio_prod'=>$registro['Price_art'],
                    'cantidad' => 1);
        $_SESSION['carrito'] = $nuevo_prod;
    }else{
        $carrito = $_SESSION['carrito'];
        $nuevo_prod= array('img_prod'=> $registro['Img_art'],
                    'nbr_prod'=>$registro['Name_art'],
                    'precio_prod'=>$registro['Price_art'],
                    'cantidad' => 1);
        array_push($carrito, $nuevo_prod);
        $_SESSION['carrito'] = $carrito;
    }
}

?>