<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto_id = $_POST['producto_id'];

    // Verifica si el carrito ya existe en la sesión
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Agregar producto al carrito
    $_SESSION['carrito'][] = $producto_id;

    echo "Producto agregado al carrito.";
}
?>
