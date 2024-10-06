<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bilibcom";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $total = $_POST['total'];
    
    // Crear venta
    $sql = "INSERT INTO ventas (cliente_id, total) VALUES ('$cliente_id', '$total')";
    
    if ($conn->query($sql) === TRUE) {
        $venta_id = $conn->insert_id;
        
        // Agregar detalles de la venta
        foreach ($_SESSION['carrito'] as $producto_id) {
            $sql = "INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, subtotal) VALUES ('$venta_id', '$producto_id', 1, (SELECT precio FROM productos WHERE id = '$producto_id'))";
            $conn->query($sql);
        }

        // Limpiar carrito
        unset($_SESSION['carrito']);

        echo "Compra completada.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
