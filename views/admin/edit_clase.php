<!-- archivo edit_clase.php dentro de admin dentro de views -->
<?php
session_start();
if (!isset($_SESSION["role"])  || $_SESSION["role"] !== 1 ) {
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
    <title>Editar Clase</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body>
    <div class="h-screen flex flex-col justify-center items-center">
        <h1>Editar clase</h1>
        <form action="/handle_db/admin/update_clase.php" class="flex flex-col border" method="post">

            <label>Nombre de la materia</label>

            <?php
            // Asegúrate de reemplazar 'id_clase' con el identificador único de la clase que quieres editar
            $id_clase = $_GET["materia_id"];

            require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

            // (1) Definir SQL
            $comando = $pdo->prepare("SELECT materia_nombre FROM materias WHERE materia_id = :id");
            $comando->execute(['id' => $id_clase]);

            // (2) Recuperar informacion
            $resultado = $comando->fetch(PDO::FETCH_ASSOC);
            $nombre_clase = $resultado["materia_nombre"];
            ?>

            <input type="hidden" name="materia_id" value="<?= $id_clase ?>">
            <input type="texto" name="materia_nombre" placeholder="" value="<?= $nombre_clase ?>">


            <label for="maestros">Maestros disponibles para la clase</label>
            <select id="maestro" name="usuario_id" optional>
                <option value="">Sin asignar</option>
                <?php
                require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

                // (1) Definir SQL
                $comando = $pdo->prepare("SELECT * FROM usuarios WHERE role_id = 2");

                // (3)Ejecutar SQL
                $comando->execute();

                // (4) Recuperar informacion
                $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultado as $maestro) {
                ?>
                    <option optional name="usuario_id" value="<?= $maestro["usuario_id"] ?>"><?= $maestro["usuario_nombre"] ?></option>
                <?php
                }
                ?>
            </select><br>

            <div class="flex justify-around gap-3">
                <a href="/views/admin/clases.php" class="bg-gray-500">Cerrar</a>
                <button type="submit">Guardar</button>
            </div>

        </form>

    </div>


</body>

</html>