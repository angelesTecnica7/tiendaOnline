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
            <p class="eliminar"><a href="carrito.php?id_borrar='.$producto['ID_prod'].'"><i class="fa-solid fa-trash"></i></a></p>
            <img src="images/'.$producto['img_prod'].'" alt="">
            <p>'.$producto['nbr_prod'].'</p>
            <p>Cantidad:<a href="carrito.php?id_restar='.$producto['ID_prod'].'"><i class="fa-regular fa-square-minus"></i></a> | '.$producto['cantidad'].' | <a href="carrito.php?id_sumar='.$producto['ID_prod'].'"><i class="fa-regular fa-square-plus"></i></a> </p>
            <p>Precio Unit: $'.$producto['precio_prod'].'</p>
            <p class="SubTotal">Subtotal: $'.$producto['cantidad'] * $producto['precio_prod'].'</p>
            <hr>  
        </div>';
        $total = $total + $producto['cantidad'] * $producto['precio_prod'];
    }
    echo '
        <p class="total">Total:$'.$total.'</p>
        <a href="index.php?finCompra" class="comprar" onClick="return confirm(\'Seguro desea proceder a comprar\')">Finalizar Compra</a>
    <div class="link">
        <a href="carrito.php?vaciarCarrito">Vaciar Carrito</a>
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
        $primer_prod[]= array(
                    'ID_prod'=>$registro['ID_art'],
                    'img_prod'=> $registro['Img_art'],
                    'nbr_prod'=>$registro['Name_art'],
                    'precio_prod'=>$registro['Price_art'],
                    'cantidad' => 1,
                    'stock' =>$registro['Stock_art']
                    );
        $_SESSION['carrito'] = $primer_prod;
    }else{
        $carrito = $_SESSION['carrito'];

        if(!ExisteYaProdEnCarrito($ID_prod)){

        $nuevo_prod= array(
                    'ID_prod'=>$registro['ID_art'],
                    'img_prod'=> $registro['Img_art'],
                    'nbr_prod'=>$registro['Name_art'],
                    'precio_prod'=>$registro['Price_art'],
                    'cantidad' => 1,
                    'stock' =>$registro['Stock_art']
                    );
        array_push($carrito, $nuevo_prod);
        $_SESSION['carrito'] = $carrito;
                }else{
                    sumarCantProd($ID_prod);
                }
        }
    
}

function ExisteYaProdEnCarrito($ID_prod){
    $carrito = $_SESSION['carrito'];
    foreach ($carrito as $indice => $producto) {
        if($producto['ID_prod']== $ID_prod){
            return true;
        }
    }
}



function borrarProdCarrito($id_borrar){
    $carrito = $_SESSION['carrito'];
    foreach ($carrito as $indice => $producto) {
        if($producto['ID_prod']== $id_borrar){
            unset($carrito[$indice]);
        }
    }
    if(count($carrito)>0){
        $_SESSION['carrito'] = $carrito;
    }else{
        unset($_SESSION['carrito']);
    }
}

function vaciarCarrito(){
    unset($_SESSION['carrito']);
}

function sumarCantProd($id_sumar){
    $carrito = $_SESSION['carrito'];
    foreach ($carrito as $indice => $producto) {
        if($producto['ID_prod'] == $id_sumar){
            if($producto['cantidad'] < $producto['stock']){
            $carrito[$indice]['cantidad']++;
            }
        }
    }
    $_SESSION['carrito'] = $carrito;
}

function restarCantProd($id_restar){
    $carrito = $_SESSION['carrito'];
    foreach ($carrito as $indice => $producto) {
        if($producto['ID_prod'] == $id_restar){
            if($producto['cantidad'] >= 2){
            $carrito[$indice]['cantidad']--;
            $_SESSION['carrito'] = $carrito;
            }else{
                borrarProdCarrito($id_restar);
            }
        }   
    }
}


/*implode($array) = convierte un array es un string)*/
/*explode('separador', $string) = convierte un string en un array, utilizando el separador elegido */

function finalizarCompra(){
    include('db/conexion.php');
    $carrito = $_SESSION['carrito'];

    /*Recorremos el carrito para generar el array de id_prod/precio/cant y para actualizar la disponibilidad de los productos */
    foreach($carrito as $indice => $producto){
        /*genero un vector $order con ID_prod/precio/cantidad separado prod a prod por un espacio en blanco*/
        $order[] = ' '.$producto['ID_prod'].'/'.$producto['precio_prod'].'/'.$producto['cantidad'];
        /*el espacio en blanco adelante hace que $order[0] quede vacio*/

        /* Actualizo la disponibilidad de cada producto */
        $id_prod = $producto['ID_prod'];
        $nuevo_stock = $producto['stock'] - $producto['cantidad'];
        $sql_update = "UPDATE Articles SET stock_art = '$nuevo_stock' WHERE ID_art = '$id_prod'";
        $update_stock = mysqli_query($conexion, $sql_update);
    }

    // veo/reviso que los datos del array $order sean los correctos
    // echo '<pre>';
    // print_r($order);
    // echo '</pre>';
  
    /*Asigno el valor a las variable que utilizare para grabar el registro */
    $fecha = date("Y/m/d");
    $productos = implode($order); //convierto el array $order en un string para guardarlo en la db
    $id_usuario = $_SESSION['ID_user'];

    /*Guardo el registro de orden el la tabal 'orders' */
    $sql = "INSERT INTO orders (Date_order, Articles, ID_user) VALUES ('$fecha','$productos','$id_usuario')";
    $insertar = mysqli_query($conexion, $sql);

    /*Si se crea el registro, elimino la variable de session, con lo cual vacio el carrito y muestro mensaje */
    if($insertar){
        unset($_SESSION['carrito']);
        print ('<script>alert("Pedido Generado Exitosamente")</script>');
    }else{
        print ('<script>alert("Error al Generar Pedido")</script>');
    }
}


function mostrarPedidos($ID_user){
    include('db/conexion.php');

    $sql = "SELECT * FROM orders WHERE ID_user = '$ID_user' ORDER BY Date_order DESC";
    $consulta = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($consulta)>0){
        while($registro=mysqli_fetch_assoc($consulta)){
            /* muestro Nro de orden y Fecha */
            echo '<details>
            <summary>Nro. de Orden: '.$registro['ID_order']. ' | Fecha: '.$registro['Date_order'].'</summary>';
            

            /*convierto el campor Article nuevamente en un vector utilizando la funcion explode() */
            $articulos = explode(' ' , $registro['Articles']);

            $total = 0;
            for($x=1; $x<count($articulos); $x++){
                    /*utilizando nuevamente la funcion explote() generos las variables para guardar el id_prod, el precio y la cantidad */
                    list($id, $precio, $cant) = explode('/' , $articulos[$x]);

                    /*Con el $id traigo imagen y nombre de producto */
                    $sql2 = "SELECT Name_art, Img_art FROM articles WHERE ID_art='$id'";
                    $consulta2 = mysqli_query($conexion, $sql2);
                    $reg_art = mysqli_fetch_assoc($consulta2);

                    /* muestro detalle de pedido */
                    echo '
                    <div class="detalle">
                        <div class="img"> <img src="images/'.$reg_art['Img_art'].'"></div>
                        <div class="datos">
                            <span>'.$reg_art['Name_art'].'</span>
                            <span> $'.number_format($precio,2,",",".").'</span>
                            <span> Cantidad:'.$cant.'</span>
                            <span> Subtotal: $'.number_format($precio*$cant,2,",",".").'</span>
                        </div>
                    </div>
                    '; 
                    $total = $total + ($precio*$cant);     
            }
            echo '
            <div class="total">
            <span> TOTAL: $'.number_format($total,2,",",".").'</span>
            </div>
            ';
            echo '</details>';
           
        }
    }else{
        echo 'No tiene Pedidos';
    }
}
?>
