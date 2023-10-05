<!-- archivo create_maestro.php dentro de admin dentro de views -->
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
    <title>Document</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body>
    <div class="h-screen flex flex-col justify-center items-center">
        <h1>Agregar Maestro</h1>
        <form action="/handle_db/admin/create_maestro.php" class="flex flex-col border" method="post">

            <label>Correo Electrónico</label>
            <input type="email" name="correo" placeholder="Ingresa Email">

            <label>Nombre(s)</label>
            <input type="text" name="nombre" placeholder="Ingresa nombre(s)">

            <label>Apellido(s)</label>
            <input type="text" name="apellido" placeholder="Ingresa apellido(s)">

            <label>Dirección</label>
            <input type="text" name="direccion" placeholder="Ingresa la dirección">

            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" placeholder="mm/dd/yyyy">

            <label for="materia">Clase Asignada</label>
                <select id="materia" name="materia_id">
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