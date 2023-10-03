<!-- archivo create_alumno.php dentro de admin dentro de views -->
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
        <h1>Agregar Alumno</h1>
        <form action="/handle_db/admin/create_alumno.php" class="flex flex-col border" method="post">

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
         
            <div class="flex justify-around gap-3">
                <a href="/views/admin/alumnos.php" class="bg-gray-500">Cerrar</a>
                <button type="submit">Crear</button>
            </div>

        </form>

    </div>


</body>

</html>