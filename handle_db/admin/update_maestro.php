<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

// Comprobar si el formulario fue enviado
if (isset($_POST['update'])) {
    // Obtén los datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $clase = $_POST["clase"];

    // Verificar si el maestro tenía una asignación previa
    $comando = $pdo->prepare("SELECT * FROM maestros_materias WHERE maestro_id = :usuario_id");
    $comando->execute(['usuario_id' => $usuario_id]);
    $asignacion_previa = $comando->fetch(PDO::FETCH_ASSOC);

    // Si había una asignación previa, eliminarla
    if ($asignacion_previa) {
        $sql_eliminar = "DELETE FROM maestros_materias WHERE mm_id = :mm_id";
        $stmnt_eliminar = $pdo->prepare($sql_eliminar);
        $stmnt_eliminar->execute(['mm_id' => $asignacion_previa['mm_id']]);
    }

    // Consulta SQL para actualizar los detalles del usuario
    $sql = "UPDATE usuarios SET usuario_nombre = :nombre, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE usuario_id = :id";
    $stmnt = $pdo->prepare($sql);
    $stmnt->execute(['nombre' => $nombre, 'direccion' => $direccion, 'fecha_nacimiento' => $fecha_nacimiento, 'id' => $usuario_id]);

    // Asignar la nueva clase al maestro
    if ($clase != "Sin asignar") {
        $sql_asignar_clase = "INSERT INTO maestros_materias (maestro_id, materia_id) VALUES (:maestro_id, :materia_id)";
        $stmnt_asignar_clase = $pdo->prepare($sql_asignar_clase);
        $stmnt_asignar_clase->execute(['maestro_id' => $usuario_id, 'materia_id' => $clase]);
    }

    // Redirigir al usuario a la página de maestros
    header("Location: /views/admin/maestros.php");
}
?>