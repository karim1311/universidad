<!-- archivo create_alumno.php dentro de admin dentro de handle_db -->
<?php

var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["correo"];
    $nombre = $_POST["nombre"] . " " . $_POST["apellido"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $direccion = $_POST["direccion"];
    $materia_id = $_POST["materia_id"];

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    try {
        // Crear un nuevo usuario
        $stmnt = $pdo->prepare("INSERT INTO usuarios (correo, contrasena, usuario_nombre, fecha_nacimiento, direccion, role_id) VALUES (:email, '', :nombre, :fecha_nacimiento, :direccion, 2)");
        $result = $stmnt->execute([
            'email' => $email,
            'nombre' => $nombre,
            'fecha_nacimiento' => $fecha_nacimiento,
            'direccion' => $direccion
        ]);

        if ($result) {
            // Obtener el ID del usuario recién creado
            $usuario_id = $pdo->lastInsertId();

            // Asignar una materia al usuario
            $stmnt = $pdo->prepare("INSERT INTO maestros_materias (maestro_id, materia_id) VALUES (:maestro_id, :materia_id)");
            $result = $stmnt->execute([
                'maestro_id' => $usuario_id,
                'materia_id' => $materia_id
            ]);

            if ($result) {
                header("Location: /views/admin/maestros.php");
            } else {
                echo "Error al asignar una materia al usuario";
            }
        } else {
            echo "Error al registrar un usuario";
        }
    } catch (PDOException $e) {
        if ($pdo === 1062) {
            session_start();
            $_SESSION["duplicado"] = "El correo ya existe";
            header("Location: /index.php");
        } else {
            echo "Error al registrar: " . $e->getMessage();
        }
    }
}
