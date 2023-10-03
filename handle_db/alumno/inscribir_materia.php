<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    $studentId = 5;
    $stmnt = $pdo->prepare("INSERT INTO alumnos_materias(alumno_id, materia_id) VALUES (:a_id, :m_id) ");
    $stmnt->bindParam(":a_id", $studentId, PDO::PARAM_INT);
    $stmnt->bindParam(":m_id", $materia_id, PDO::PARAM_INT);
    $stmnt->execute();
    header("Location: /views/dashboard.php");
}


