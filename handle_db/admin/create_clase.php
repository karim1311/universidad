<!-- archivo create_clase.php dentro de admin dentro de handle_db -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $materia_nombre = $_POST["materia_nombre"];
    $profesor_id = isset($_POST["maestro_id"]) ? $_POST["maestro_id"] : null; // puede ser null si no se seleccionó un profesor

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    try {
        // Crear una nueva clase
        $stmnt = $pdo->prepare("INSERT INTO materias (materia_nombre) VALUES (:nombre)");
        $result = $stmnt->execute(['nombre' => $materia_nombre]);

        if ($result) {
            // Obtener el ID de la clase recién creada
            $materia_id = $pdo->lastInsertId();

            // Si se seleccionó un profesor, asignar la clase al profesor
            if ($profesor_id !== null) {
                $stmnt = $pdo->prepare("INSERT INTO maestros_materias (maestro_id,materia_id) VALUES (:maestro_id, :materia_id)");
                $result = $stmnt->execute([
                    'maestro_id' => $profesor_id,
                    'materia_id' => $materia_id
                ]);

                if (!$result) {
                    echo "Error al asignar la clase al profesor";
                }
            }

            header("Location: /views/admin/clases.php");
        } else {
            echo "Error al crear una clase";
        }
    } catch (PDOException $e) {
        echo "Error al crear: " . $e->getMessage();
    }
}
