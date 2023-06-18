<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cursofinal";

            try {
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    throw new Exception("Error de conexión a la base de datos: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM usuarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2>Usuarios registrados:</h2>";
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["apellido1"] . "</td>";
                        echo "<td>" . $row["apellido2"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["login"] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No hay usuarios registrados.";
                }

                $conn->close();
            } catch (mysqli_sql_exception $e) {
                echo "Error en la base de datos: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
            
            <button id ="volver" onclick="goBack()">Volver</button>
        </div>
    </div>

    <script>
    function goBack() {
        history.back();
    }
    </script>
</body>
</html>
