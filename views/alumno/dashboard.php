<!-- archivo dashboard.php dentro de alumno dentro de views -->
<!-- archivo permisos dentro de carpeta admin dentro de views -->
<?php
session_start();
if (!isset($_SESSION["role"])  || $_SESSION["role"] !== 3) {
    echo "No existe una sesion iniciada o no tienes permisos para acceder a esta pagina";
    header("Location: /index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Maestro</title>
    <link href="/dist/output.css" rel="stylesheet" defer>
    <link rel="stylesheet" href="/src/input.css">
</head>

<body class="h-screen flex justify-center box-border w-screen">
    <aside class="flex flex-col min-h-screen border ">
        <header class="flex border-b-2 border-gray-500 w-auto ">
            <div class="flex w-auto">
                <img src="/assets/logo.jpg" alt="logo-pequeño" width="100px" height="100px" class="border rounded-full object-cover">
                <h1>Universidad</h1>
            </div>
        </header>
        <div class="bg-slate-500">
            Nombre
        </div>
        <?php
        $usuario_id = $_SESSION["usuario_id"];
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");
        // Define la consulta SQL para obtener las clases asignadas
        $consulta = $pdo->prepare("
        SELECT materias.materia_nombre
        FROM maestros_materias
        JOIN materias ON maestros_materias.materia_id = materias.materia_id
        WHERE maestros_materias.maestro_id = :usuario_id
        ");

        // Asigna el valor del ID de usuario a la consulta
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

        // Ejecuta la consulta SQL
        $consulta->execute();

        // Recupera la información
        $clases_asignadas = $consulta->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section class="flex flex-col">
            <h1>MENU</h1>
            <h2>Clases Asignadas:</h2>
            <ul>
                <?php
                foreach ($clases_asignadas as $clase) {
                ?>
                    <p><?= $clase["materia_nombre"] ?></p>
                <?php
                }
                ?>
            </ul>
        </section>
    </aside>
    <section class="bg-[#fff5d2] w-full">
        <div>
            <a href="/handle_db/logout.php">Cerrar sesión</a>
        </div>
        <div class="bg-blue-200 p-4 rounded-md flex justify-center items-center">
        <?php

if (!isset($_SESSION["usuario_id"])) {
    // Si la sesión no está iniciada, redirige a la página de inicio de sesión o muestra un mensaje de error.
    header("Location: /index.php");
    exit();
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

// Ahora puedes obtener el ID del alumno desde la sesión.
$studentId = $_SESSION["usuario_id"];

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
	and am.alumno_id = :id
where
	am.am_id is null
";

$stmnt = $pdo->prepare($query);
$stmnt->bindParam(":id", $studentId, PDO::PARAM_INT);
$stmnt->execute();
$faltantes = $stmnt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
    <thead>
        <tr>
            <th>Materia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($inscritas as $inscrita) {
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
    <select multiple name="materia[]">
        <?php foreach ($faltantes as $faltante) {
        ?>
            <option value="<?= $faltante["materia_id"] ?>">
                <?= $faltante["materia_nombre"] ?>
            </option>
        <?php
        }
        ?>
    </select>
    <button type="submit">Inscribirse</button>
</form>
        </div>
    </section>
</body>


</html>
