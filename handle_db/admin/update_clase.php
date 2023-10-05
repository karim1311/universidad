<!-- archivo update_clase.php dentro de admin dentro de handle_db -->
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $materia_id = $_POST["materia_id"];
    $materia_nombre = $_POST["materia_nombre"];
    $usuario_id = $_POST["usuario_id"];

    try {
        // Actualizar el nombre de la materia
        $comando = $pdo->prepare("UPDATE materias SET materia_nombre = :nombre WHERE materia_id = :id");
        $comando->execute(['nombre' => $materia_nombre, 'id' => $materia_id]);

        // Si se seleccionó un maestro, asignarlo a la materia
        if (!empty($usuario_id)) {
            $comando = $pdo->prepare("INSERT INTO maestros_materias (maestro_id, materia_id) VALUES (:maestro_id, :materia_id)");
            $comando->execute(['maestro_id' => $usuario_id, 'materia_id' => $materia_id]);
        }

        header("Location: /views/admin/clases.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
