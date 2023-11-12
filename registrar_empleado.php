<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de empleados - ROZE STORE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
        <h2>Registrar Empleado</h2>
        <?php
        include("db.php");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $correo = $_POST["correo"];
            $puesto = $_POST["puesto"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $query = "INSERT INTO empleados (nombre, apellido, correo, puesto, contrasena) VALUES ('$nombre', '$apellido', '$correo', '$puesto', '$password')";
            if (mysqli_query($con, $query)) {
                header("Location:   productos.php");
            } else {
                echo "Error en la base de datos: " . mysqli_error($con);
            }
        }
        ?>
        <form action="registrar_empleado.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" class="form-control" name="correo" required>
            </div>
            <div class="form-group">
                <label for="puesto">Puesto:</label>
                <select class="form-control" name="puesto" required>
                    <option value="Empleado">Empleado</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Empleado</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>