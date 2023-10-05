<!-- archivo permisos dentro de carpeta admin dentro de views -->
<?php
session_start();
if (!isset($_SESSION["role"])  || $_SESSION["role"] !== 2) {
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
            <p><?= ["usuario_nombre"] ?></p>
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
            <table class="border justify-center items-center bg-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre de alumno</th>
                        <th>Calificacion</th>
                        
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usuario_id = $_SESSION["usuario_id"];
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

                    // Define la consulta SQL para obtener las clases asignadas
                    $consulta = $pdo->prepare("
                    SELECT maestros_materias.materia_id, materias.materia_nombre
                    FROM maestros_materias 
                    JOIN materias ON maestros_materias.materia_id = materias.materia_id
                    WHERE maestros_materias.maestro_id = :usuario_id
                    ");

                    // Asigna el valor del ID de usuario a la consulta
                    $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

                    // Ejecuta la consulta SQL
                    $consulta->execute();

                    // Recupera la información
                    $materias_asignadas = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($materias_asignadas as $materia) {
                        // Obtiene los alumnos inscritos en esta materia
                        $consulta_alumnos = $pdo->prepare("
                            SELECT usuarios.usuario_id, usuarios.usuario_nombre, alumnos_materias.calificacion
                            FROM usuarios
                            JOIN alumnos_materias ON usuarios.usuario_id = alumnos_materias.alumno_id
                            WHERE alumnos_materias.materia_id = :materia_id
                        ");
                        $consulta_alumnos->bindParam(':materia_id', $materia['materia_id'], PDO::PARAM_INT);
                        $consulta_alumnos->execute();
                        $alumnos = $consulta_alumnos->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($alumnos as $alumno) {
                    ?>
                            <tr>
                                <td class="px-3 py-1"><?= $alumno["usuario_id"] ?></td>
                                <td class="px-3 py-1"><?= $alumno["usuario_nombre"] ?></td>
                                <td class="px-3 py-1"><?= $alumno["calificacion"] ?></td>
                                
                                <td class="px-3 py-1">
                                    <div class="flex gap-4">
                                        <div class="modal">
                                            <form action="/index.php" method="post">
                                                <input type="text" hidden name="id" value="<?= $alumno["usuario_id"] ?>">
                                            </form>
                                        </div>
                                        <a href="/views/admin/editrol.php?usuario_id=<?= $alumno["usuario_id"] ?>" class="bg-blue-400 px-2 py-1 rounded-md">Editar</a>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>


</html>