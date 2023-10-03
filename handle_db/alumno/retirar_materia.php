<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    $studentId = 5;
    $stmnt = $pdo->prepare("DELETE FROM alumnos_materias WHERE alumno_id = :a_id AND materia_id = :m_id");
    $stmnt->bindParam(":a_id", $studentId, PDO::PARAM_INT);
    $stmnt->bindParam(":m_id", $materia_id, PDO::PARAM_INT);
    $stmnt->execute();
    header("Location: /views/dashboard.php");
}