<?php
include("db.php");
if (isset($_GET["id"])) {
    $idProducto = $_GET["id"];
    $query = "SELECT imagen FROM productos WHERE id = $idProducto";
    $result = mysqli_query($con, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        header("Content-type: image/jpeg");
        echo $row["imagen"];
    }
}
?>