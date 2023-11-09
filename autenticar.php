<?php
session_start();
include("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["email"];
    $contrasena = $_POST["password"];
    $query = "SELECT * FROM empleados WHERE correo = '$correo'";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row["contrasena"];
            if (password_verify($contrasena, $hashed_password)) {
                $_SESSION["usuario_id"] = $row["id"];
                $_SESSION["usuario_nombre"] = $row["nombre"];
                header("Location: index.php");
                exit();
            } else {
                header("Location: login.php");
                exit();
            }
        } else {
            header("Location: login.php");
            exit();
        }
    } else {
        echo "Error en la base de datos: " . mysqli_error($con);
    }
}
?>