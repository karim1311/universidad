<!-- archivo create_alumno.php dentro de admin dentro de handle_db -->
<?php

var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["correo"];
    $nombre = $_POST["nombre"] . " " . $_POST["apellido"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $direccion = $_POST["direccion"];    

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    try {
        $stmnt = $pdo->prepare("INSERT INTO usuarios (correo, contrasena, usuario_nombre, fecha_nacimiento, direccion, role_id) VALUES (:email, '', :nombre, :fecha_nacimiento, :direccion, 3)");
        $result = $stmnt->execute([
            'email' => $email,
            'nombre' => $nombre,
            'fecha_nacimiento' => $fecha_nacimiento,
            'direccion' => $direccion
        ]);

        if($result) {
            header("Location: /views/admin/alumnos.php");
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


