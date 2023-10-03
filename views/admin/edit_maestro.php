<!--archivo edit_maestro.php dentro de admin dentro de views  -->
<?php
// Conexión a la base de datos
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

// Obtén el ID del usuario desde la URL
$usuario_id = $_GET['usuario_id'];

// Consulta SQL para obtener los detalles del usuario
$sql = "SELECT * FROM usuarios WHERE usuario_id = :id";
$stmnt = $pdo->prepare($sql);
$stmnt->execute(['id' => $usuario_id]);
$usuario = $stmnt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Maestro</title>
    <link href="/dist/output.css" rel="stylesheet" defer>
    <link rel="stylesheet" href="/src/input.css">
</head>

<body class="h-screen flex justify-center box-border w-screen">
    <section class="bg-[#fff5d2] w-full">
        <div class="bg-white p-4 rounded-md border flex flex-col justify-center items-center">
            <form action="/handle_db/admin/update_maestro.php" method="post">
                <h1>Editar Maestro:</h1>
                <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                <label for="correo">Correo:</label><br>
                <input type="text" id="correo" disabled name="correo" value="<?= $usuario['correo'] ?>" class="bg-gray-200"><br>

                <label for="nombre">Nombre(s):</label><br>
                <input type="text" id="nombre" name="nombre" value="<?= $usuario['usuario_nombre'] ?>"><br>

                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="<?= $usuario['direccion'] ?>"><br>

                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>"><br>

                <label for="fecha_nacimiento">Clase Asignada</label>
                <select id="rol" name="clase">
                    <?php
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

                    // (1) Definir SQL
                    $comando = $pdo->prepare("SELECT * FROM materias");

                    // (3)Ejecutar SQL
                    $comando->execute();

                    // (4) Recuperar informacion
                    $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $clase) {
                    ?>
                        <option value="<?= $clase["materia_id"] ?>"><?= $clase["materia_nombre"] ?></option>
                    <?php
                    }
                    ?>
                </select><br>
                <a href="maestros.php" class="bg-gray-400">Close</a>
                <button type="submit" name="update" class=" bg-blue-500 rounded-md">Guardar cambios</button>
            </form>
        </div>
    </section>
</body>

</html>