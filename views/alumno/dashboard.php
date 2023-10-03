<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");
$query = "
select
	am.alumno_id, am.materia_id, m.materia_nombre, am.calificacion, am.mensaje
from
	alumnos_materias am
inner join materias m on
	am.materia_id = m.materia_id
where
    am.alumno_id = :id
";

$studentId = 5;

$stmnt = $pdo->prepare($query);
$stmnt->bindParam(":id", $studentId, PDO::PARAM_INT);
$stmnt->execute();
$inscritas = $stmnt->fetchAll(PDO::FETCH_ASSOC);

$query = "
select
	m.materia_id, m.materia_nombre
from
	materias m
left join alumnos_materias am on
	m.materia_id = am.materia_id
	and am.alumno_id = 4
where
	am.am_id is null
";

$stmnt = $pdo->prepare($query);
$stmnt->bindParam(":id", $studentId, PDO::PARAM_INT);
$faltantes = $stmnt->fetchAll(PDO::FETCH_ASSOC);
var_dump($faltantes);

?>

<table>
    <thead>
        <tr>
            <th>Materia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($inscritas as $inscrita) {
        ?>
            <tr>
                <td><?= $inscrita["materia_nombre"] ?></td>
                <td>
                    <form action="/handle_db/alumno/retirar_materia.php" method="post">
                        <input type="number" hidden value="<?= $inscrita["materia_id"] ?>" name="materia_id">
                        <button type="submit">Darse de baja</button>
                    </form>
                </td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<h2>Materias disponibles:</h2>

<form action="/handle_db/alumno/inscribir_materia.php" method="post">
    <label>Escoge tus materias:</label>
    <select multiple name="materias">
        <?php
        foreach ($faltantes as $faltante) {
        ?>
            <option name="materia[]" value="<?= $faltante["materia_id"] ?>">
                <?= $faltante["materia_nombre"] ?>
            </option>
        <?php
        }
        ?>
    </select>
    <button type="submit">Inscribirse</button>
</form>