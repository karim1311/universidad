<!-- archivo permisos dentro de carpeta admin dentro de views -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="/dist/output.css" rel="stylesheet" defer>
    <link rel="stylesheet" href="/src/input.css">
</head>
<body class="h-screen flex justify-center box-border w-screen">
    <aside class="flex flex-col min-h-screen border">
        <header class="flex border-b-2 border-gray-500 w-auto ">
            <div class="flex w-auto ">
                <img src="/assets/logo.jpg" alt="logo-pequeño" width="100px" height="100px" class="border rounded-full object-cover">
                <h1>Universidad</h1>
            </div>
        </header>
        <div  class="bg-slate-500">
            <p>admin</p>
            <p></p>
        </div>
        <section class="flex flex-col">
            <h1>MENU ADMINISTRACION</h1>
            <div>
                <a href="permisos.php">Permisos</a>
            </div>
            <div>
                <a href="maestros.php">Maestros</a>
            </div>
            <div>
                <a href="alumnos.php">Alumnos</a>
            </div>
            <div>
                <p>Clases</p>
            </div>
        </section>
    </aside>
    <section class="bg-[#fff5d2] w-full">
        <div class="flex justify-evenly">
            <p>Informacion de Clases</p>
            <a href="create_alumno.php">Agregar Clase</a>
        </div>
    <div class="bg-blue-200 p-4 rounded-md flex justify-center items-center">
            <table class="border justify-center items-center bg-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Clase</th>
                        <th>Maestro</th>
                        <th>Alumnos inscritos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Cambiar el nombre de la base de datos, usuario y clave
                    $pdo = new PDO('mysql:host=localhost;dbname=universidad','root','');

                    // (1) Definir SQL
                    $comando = $pdo->prepare("SELECT materias.materia_id, materias.materia_nombre, usuarios.usuario_nombre, COUNT(alumnos_materias.alumno_id) AS numero_de_alumnos
                    FROM materias
                    LEFT JOIN maestros_materias ON materias.materia_id = maestros_materias.materia_id
                    LEFT JOIN usuarios ON maestros_materias.maestro_id = usuarios.usuario_id
                    LEFT JOIN alumnos_materias ON materias.materia_id = alumnos_materias.materia_id
                    GROUP BY materias.materia_id, materias.materia_nombre, usuarios.usuario_nombre;
                    ");

                    // (3)Ejecutar SQL
                    $comando->execute();

                    // (4) Recuperar informacion
                    $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultado as $usuario) {
                    ?>
                        <tr>
                            <td class="px-3 py-1"><?= $usuario["materia_id"] ?></td>
                            <td class="px-3 py-1"><?= $usuario["materia_nombre"] ?></td>
                            <td class="px-3 py-1"><?= $usuario["usuario_nombre"] ?></td>
                            <td class="px-3 py-1"><?= $usuario["numero_de_alumnos"] ?></td>
                            <td class="px-3 py-1">
                                <div class="flex gap-4">
                                    <a href="/views/admin/edit_materia.php?usuario_id=<?= $usuario["materia_id"] ?>" class="bg-blue-400 px-2 py-1 rounded-md">Editar</a>
                                    <button value=<?= $usuario["materia_id"] ?> class="btn-delete bg-red-300 px-2 py-1 rounded-md">Eliminar</button>
                                    <div class="modal">
                                        <form action="/index.php" method="post">
                                            <input type="text" hidden name="id" value="<?= $usuario["materia_id"] ?>">
                                            <button type="submit" class="bg-red-300 px-2 py-1 rounded-md">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    
</body>
</html>