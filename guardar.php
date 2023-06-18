<!DOCTYPE html>
<html>
<head>
    <title>Guardar Datos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php
              if ($_POST) {
                // Obtener los datos del formulario
                $nombre = $_POST['nombre'];
                $apellido1 = $_POST['apellido1'];
                $apellido2 = $_POST['apellido2'];
                $email = $_POST['email'];
                $login = $_POST['login'];
                $passwordForm = $_POST['password'];

                // Validar los datos

                // Validar el formato de correo electrónico
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo '<script>alert("El formato de correo electrónico no es válido.");</script>';
                    echo '<script>window.location.href = "formulario.html";</script>';
                    exit;
                }

                // Validar la extensión del password
                if (strlen($passwordForm) < 4 || strlen($passwordForm) > 8) {
                    echo '<script>alert("La contraseña debe tener entre 4 y 8 caracteres.");</script>';
                    echo '<script>window.location.href = "formulario.html";</script>';
                    exit;
                }

                // Crear la conexión a la base de datos
                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "cursofinal";

                try {
                    // Conectar a la base de datos
                    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                    // Verificar si la conexión fue exitosa
                    if ($conn->connect_error) {
                        throw new Exception("Error de conexión a la base de datos: " . $conn->connect_error);
                    }

                    // Establecer la codificación de caracteres
                    $conn->set_charset("utf8mb4");

                    // Verificar si el email ya está registrado en la base de datos
                    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<script>alert("El email ingresado ya está registrado.");</script>';
                        echo '<script>window.location.href = "formulario.html";</script>';
                        exit;
                    }

                    // Insertar los datos en la tabla de la base de datos
                    $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, password) 
                        VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$passwordForm')";

                    if ($conn->query($sql) === TRUE) {
                        echo '<script>alert("Registro completado con éxito.");</script>';
                        echo '<script>window.location.href = "formulario.html";</script>';
                    } else {
                        throw new Exception("Error al guardar los datos: " . $conn->error);
                    }

                    // Cerrar la conexión
                    $conn->close();
                } catch (mysqli_sql_exception $e) {
                    echo '<script>alert("Error en la base de datos: ' . $e->getMessage() . '");</script>';
                    echo '<script>window.location.href = "formulario.html";</script>';
                    exit;
                } catch (Exception $e) {
                    echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
                    echo '<script>window.location.href = "formulario.html";</script>';
                    exit;
                }
              }
            ?>
        </div>
    </div>
</body>
</html>
