<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/src/input.css" defer>
</head>

<body class="h-screen flex flex-col justify-center items-center bg-[#fff5d2] box-border">
    <section class="h-screen flex flex-col justify-center items-center w-full min-h-screen">
        <div class="w-[300px] h-[300px] flex justify-center ">
            <img src="/assets/logo.jpg" alt="logo" width="100%" class="flex justify-center">
        </div>
        <div class="flex flex-col justify-center items-center bg-white p-4 border rounded-md drop-shadow-lg w-fit">
            <form action="/handle_db/login.php" method="post" class="flex flex-col gap-3">
                <label>Bienvenido Ingresa con tu cuenta</label>
                <div class="border flex justify-around rounded-md">
                    <input type="email" name="correo" class="focus:outline-none" placeholder="Email">
                    <span class="material-symbols-rounded d-flex justify-content-center p-1">mail</span>
                </div>
                <div class="border flex justify-around rounded-md">
                    <input type="password" name="contrasena" placeholder="Password" class="focus:outline-none">
                    <span class="material-symbols-rounded d-flex justify-content-center p-1">lock</span>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-2 py-1 bg-blue-500 text-white w-6/12 rounded-md justify-end">Ingresar</button>

                </div>
            </form>
        </div>

        </div>
    </section>
    <div class="flex flex-col h-screen justify-center self-center bg-white border w-fit p-3 rounded-md pb-2">
        <h1 class="border-b-2 w-full">Informacion Acceso</h1>
        <div>
            <h1>Admin</h1>
            <p>pass:admin</p>
        </div>
        <div>
            <h1>Maestros</h1>
            <p>user: maestro@maestro</p>
            <p>pass:maestro</p>
        </div>
        <div>
            <h1>Alumno</h1>
            <p>user:alumno@alumno</p>
            <p>pass:alumno</p>
        </div>




</body>

</html>