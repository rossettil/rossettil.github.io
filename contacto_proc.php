<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];

    $destinatario = "lucasirossetti10@gmail.com";

    $asunto = "Mensaje de contacto desde ROZE STORE";
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo Electrónico: $correo\n";
    $contenido .= "Mensaje:\n$mensaje";
    
    $headers = "From: $correo" . "\r\n" .
        "Reply-To: $correo" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();
    if (mail($destinatario, $asunto, $contenido, $headers)) {
        header("Location:   contacto.php");
        exit;
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contacto - ROZE STORE</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/index.css">
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="index.php">
                    <img src="images/R.png" alt="LR STORE" width="30" height="30" class="d-inline-block align-top">
                    ROZE STORE
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <?php
                            session_start();
                            if (isset($_SESSION["usuario_id"]))
                            $idUsuario = $_SESSION["usuario_id"];
                            $nombreUsuario = $_SESSION["usuario_nombre"];
                            echo "<a class='nav-link' href='#'>¡Hola {$nombreUsuario}! | ID de usuario: {$idUsuario}</a>";
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION["usuario_id"])) {
                                echo '<a class="nav-link" href="logout.php">Cerrar Sesión</a>';
                            } else {
                                echo '<a class="nav-link" href="login.php">Iniciar Sesión</a>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
                <?php
                echo "<p>Error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.</p>";
                ?>
            </nav>
            <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    }
} else {
    echo "Acceso no autorizado.";
}
?>