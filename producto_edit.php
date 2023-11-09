<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - ROZE STORE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/index.css">
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
                <li class="nav-item">
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
                    if (isset($_SESSION["usuario_id"])) {
                        $idUsuario = $_SESSION["usuario_id"];
                        $nombreUsuario = $_SESSION["usuario_nombre"];
                        echo "<a class='nav-link' href='#'>¡Hola {$nombreUsuario}! | ID de usuario: {$idUsuario}</a>";
                    }
                    ?>
                </li>
                    <?php
                    if (isset($_SESSION["usuario_id"])) {
                        echo "<a class='nav-link' href='registrar_empleado.php'>Registrar un empleado nuevo</a>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION["usuario_id"])) {
                        echo "<a class='nav-link' href='logout.php'>Cerrar Sesión</a>";
                    } else {
                        echo "<a class='nav-link' href='login.php'>Iniciar Sesión</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Editar Producto</h2>

        <?php
        include("db.php"); // Incluye el archivo de conexión a la base de datos

        // Verificar si el usuario tiene la sesión iniciada (administrador)
        if (isset($_SESSION["usuario_id"])) {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
                $producto_id = $_GET["id"];
                $query = "SELECT * FROM productos WHERE id = $producto_id";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $nombre = $row["nombre"];
                    $descripcion = $row["descripcion"];
                    $stock = $row["stock"];
                    $imagen = $row["imagen"];
                } else {
                    echo "Producto no encontrado.";
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
                $producto_id = $_POST["producto_id"];
                $nombre = $_POST["nombre"];
                $descripcion = $_POST["descripcion"];
                $stock = $_POST["stock"];
                if (isset($_FILES["imagen"]) && $_FILES["imagen"]["size"] > 0) {
                    $imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);
                    $imagen = mysqli_real_escape_string($con, $imagen);
                }
                
                if (isset($imagen)) {
                    $query = "UPDATE productos SET imagen = '$imagen', nombre = '$nombre', descripcion = '$descripcion', stock = '$stock' WHERE id = $producto_id";
                } else {
                    $query = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', stock = '$stock' WHERE id = $producto_id";
                }

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
        <?php if (isset($_SESSION["usuario_id"])) { ?>
            <form action="producto_edit.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" name="descripcion" required><?php echo $descripcion; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" class="form-control" name="stock" value="<?php echo $stock; ?>" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del Producto:</label>
                    <input type="file" class="form-control-file" name="imagen" accept="image/*">
                </div>
                <button type="submit" name="guardar" class="btn btn-primary">Guardar Cambios</button>
            </form>
        <?php } ?>
    </div>
    <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
