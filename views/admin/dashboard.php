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

    <aside class="flex flex-col h-screen w-[250px] border bg-[#353a40]">
        <header class="flex border-b-2 border-gray-500 w-auto">
            <div class="flex w-auto">
                <img src="/assets/logo.jpg" alt="logo-pequeño" width="100px" height="100px" class="border rounded-full object-cover">
                <h1>Universidad</h1>
            </div>
        </header>
        <div>
            <p>admin</p>
            <p></p>
        </div>
        <section class="flex flex-col">
            <h1>MENU ADMINISTRACION</h1>
            <div>
                <a href="/views/admin/permisos.php">Permisos</a>
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
        <nav class="flex h-screen">
            <div></div>
            <div>Home</div>
        </nav>
    </section>


</body>

</html>