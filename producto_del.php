<?php
include("db.php");
session_start();
if (isset($_SESSION["usuario_id"])) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $producto_id = $_GET["id"];
        
        $query = "DELETE FROM productos WHERE id = $producto_id";

        if (mysqli_query($con, $query)) {
            header("Location: productos.php");
            exit();
        } else {
            echo "Error en la base de datos: " . mysqli_error($con);
        }
    }
} else {
    echo "Acceso no autorizado. Debes iniciar sesión como administrador.";
}
?>