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
    <aside class="flex flex-col min-h-screen border ">
        <header class="flex border-b-2 border-gray-500 w-auto ">
            <div class="flex w-auto">
                <img src="/assets/logo.jpg" alt="logo-pequeño" width="100px" height="100px" class="border rounded-full object-cover">
                <h1>Universidad</h1>
            </div>
        </header>
        <div class="bg-slate-500">
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
        <div class="bg-blue-200 p-4 rounded-md flex justify-center items-center">
            <table class="border justify-center items-center bg-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email/Usuario</th>
                        <th>Permiso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Cambiar el nombre de la base de datos, usuario y clave
                    $pdo = new PDO('mysql:host=localhost;dbname=universidad', 'root', '');

                    // (1) Definir SQL
                    $comando = $pdo->prepare("SELECT usuarios.usuario_id, usuarios.correo, roles.role_nombre
                    FROM usuarios
                    JOIN roles
                    ON usuarios.role_id = roles.role_id;");

                    // (3)Ejecutar SQL
                    $comando->execute();

                    // (4) Recuperar informacion
                    $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultado as $usuario) {
                    ?>
                        <tr>
                            <td class="px-3 py-1"><?= $usuario["usuario_id"] ?></td>
                            <td class="px-3 py-1"><?= $usuario["correo"] ?></td>
                            <td class="px-3 py-1 text-end"><?= $usuario["role_nombre"] ?></td>
                            <td class="px-3 py-1">
                                <div class="flex gap-4">
                                    <button value=<?= $usuario["usuario_id"] ?> class="btn-delete bg-red-300 px-2 py-1 rounded-md">Eliminar</button>
                                    <div class="modal">
                                        <form action="/index.php" method="post">
                                            <input type="text" hidden name="id" value="<?= $usuario["usuario_id"] ?>">
                                            <button type="submit" class="bg-red-300 px-2 py-1 rounded-md">Eliminar</button>
                                        </form>
                                    </div>
                                    <a href="/views/admin/editrol.php?usuario_id=<?= $usuario["usuario_id"] ?>" class="bg-blue-400 px-2 py-1 rounded-md">Editar</a>
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