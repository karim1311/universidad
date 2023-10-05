<!-- archivo retirar_materia.php dentro de alumno dentro de handle_db -->
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    $studentId = $_SESSION["usuario_id"];
    $stmnt = $pdo->prepare("DELETE FROM alumnos_materias WHERE alumno_id = :a_id AND materia_id = :m_id");
    $stmnt->bindParam(":a_id", $studentId, PDO::PARAM_INT);
    $stmnt->bindParam(":m_id", $materia_id, PDO::PARAM_INT);
    $stmnt->execute();
    header("Location: /views/alumno/dashboard.php");
}