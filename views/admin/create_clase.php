<!-- archivo create_maestro.php dentro de admin dentro de views -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body>
    <div class="h-screen flex flex-col justify-center items-center">
        <h1>Agregar Maestro</h1>
        <form action="/handle_db/admin/create_maestro.php" class="flex flex-col border" method="post">

            <label>Nombre de la materia</label>
            <input type="texto" name="materia" placeholder="">

            

            <label for="materia">Maestros disponibles para la clase</label>
                <select id="materia" name="materia_id">
                    <?php
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

                    // (1) Definir SQL
                    $comando = $pdo->prepare("SELECT * FROM usuarios WHERE id = 2");

                    // (3)Ejecutar SQL
                    $comando->execute();

                    // (4) Recuperar informacion
                    $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $clase) {
                    ?>
                        <option name="materia_id" value="<?= $clase["materia_id"] ?>"><?= $clase["materia_nombre"] ?></option>
                    <?php
                    }
                    ?>
                </select><br>
         
            <div class="flex justify-around gap-3">
                <a href="/views/admin/maestros.php" class="bg-gray-500">Cerrar</a>
                <button type="submit">Crear</button>
            </div>

        </form>

    </div>


</body>

</html>