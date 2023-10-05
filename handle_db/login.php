<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");
    try {
        $stmnt = $pdo->query("SELECT * FROM usuarios WHERE correo = '$correo'");

        if ($stmnt->rowCount() === 1) {
            // Después de corroborar el hash de la contraseña...

            switch ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                case $row["role_id"] === 1:
                    $_SESSION["role"] = 1;
                    header("Location: /views/admin/dashboard.php");
                    break;
                case $row["role_id"] === 2;
                    $_SESSION["role"] = 2;
                    $_SESSION["usuario_id"] = $row["usuario_id"];
                    $_SESSION["usuario_nombre"] = $row["usuario_nombre"];
                    header("Location: /views/maestro/dashboard.php");
                    break;
                case $row["role_id"] === 3;
                    $_SESSION["role"] = 3;
                    $_SESSION["usuario_id"] = $row["usuario_id"];
                    header("Location: /views/alumno/dashboard.php");
                    break;

                default:
                    echo "No tienes ningún rol, lo siento no puedes ingresar";
                    break;
            }
        } else {
            echo "el correo no existe";
        }
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage();
    }
}