<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - ROZE STORE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        function confirmarEliminacion(productoID) {
            if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                window.location.href = "producto_del.php?id=" + productoID;
            }
        }
    </script>
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
                    <a class="nav-link active" href="productos.php">Productos</a>
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
        <h2>Productos</h2>
        <?php
        include("db.php");
        $query = "SELECT * FROM productos";
        $result = mysqli_query($con, $query);
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr><th>Producto</th><th>Nombre</th><th>Descripción</th><th>Stock</th>";
        if (isset($_SESSION["usuario_id"])) {
            echo "<th>Acción</th>";
        }

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><img src='imagen_producto.php?id=" . $row["id"] . "' alt='Producto' width='100'></td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td>" . $row["stock"] . "</td>";
                echo "<td>";

                if (isset($_SESSION["usuario_id"])) {
                    echo "<a href='producto_edit.php?id=" . $row["id"] . "' class='btn btn-primary'>Editar</a> ";
                    echo "<button class='btn btn-danger' onclick='confirmarEliminacion(" . $row["id"] . ")'>Eliminar</button>";
                }

                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay productos disponibles.</td>";
            if (isset($_SESSION["usuario_id"])) {
                echo "<td></td>";
            }
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        if (isset($_SESSION["usuario_id"])) {
            echo "<a href='producto_add.php' class='btn btn-primary'>Añadir producto</a>";
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
