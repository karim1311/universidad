<!--archivo editrol.php  -->
<?php
session_start();
if (!isset($_SESSION["role"])  || $_SESSION["role"] !== 1 ) {
    echo "No existe una sesion iniciada o no tienes permisos para acceder a esta pagina";
    header("Location: /index.php");
    exit();
}
?>
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
    <title>Editar Usuario</title>
    <link href="/dist/output.css" rel="stylesheet" defer>
    <link rel="stylesheet" href="/src/input.css">
</head>

<body class="h-screen flex justify-center box-border w-screen">
    <section class="bg-[#fff5d2] w-full">
        <div class="bg-white p-4 rounded-md border flex flex-col justify-center items-center">
            <form action="/handle_db/admin/updateuser.php" method="post">
                <h1>Editar Permiso:</h1>
                <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                <label for="correo">Correo:</label><br>
                <input type="text" id="correo" name="correo" value="<?= $usuario['correo'] ?>"><br>
                <!-- Aquí puedes agregar un selector para el rol -->
                <label for="rol">Rol del usuario:</label><br>
                <select id="rol" name="rol">
                    <?php
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

                    // (1) Definir SQL
                    $comando = $pdo->prepare("SELECT * FROM roles");

                    // (3)Ejecutar SQL
                    $comando->execute();

                    // (4) Recuperar informacion
                    $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $rol) {
                    ?>
                        <option value="<?= $rol["role_id"] ?>"><?= $rol["role_nombre"] ?></option>
                    <?php
                    }
                    ?>
                </select><br>
                <button type="submit" name="update" class=" bg-blue-500 rounded-md">Guardar cambios</button>
            </form>
        </div>
    </section>
</body>

</html>