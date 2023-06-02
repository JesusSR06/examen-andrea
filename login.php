<?php
// Inicializa la sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Redirigir al usuario a la página correspondiente
    header("location: catalogo.php");
    exit;
}

// Incluir el archivo de configuración
require_once "conexion.php";

// Definir variables e inicializar con valores vacíos
$username = $password = $username_err = $password_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Comprobar si el nombre de usuario está vacío
    if (empty(trim($_POST["txtUsuario"]))) {
        $username_err = "Por favor ingrese su usuario.";
    } else {
        $username = trim($_POST["txtUsuario"]);
    }

    // Comprobar si la contraseña está vacía
    if (empty(trim($_POST["txtContraseña"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["txtContraseña"]);
    }

    // Validar información del usuario
    if (empty($username_err) && empty($password_err)) {

        // Preparar la consulta select
        $sql = "SELECT Id, Usuario, contraseña FROM usuarios WHERE Usuario = ?";

        if ($stmt = mysqli_prepare($conexion, $sql)) {

            /* Vincular variables a la declaración preparada como parámetros, 's' es por la
            variable de tipo string */
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Asignar parámetros
            $param_username = $username;

            // Intentar ejecutar la declaración preparada
            if (mysqli_stmt_execute($stmt)) {

                // Almacenar el resultado de la consulta
                mysqli_stmt_store_result($stmt);

                /* Verificar si existe el nombre de usuario, si es así,
                verificar la contraseña */
                if (mysqli_stmt_num_rows($stmt) == 1) {

                    // Vincular las variables del resultado
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    // Obtener los valores de la consulta
                    if (mysqli_stmt_fetch($stmt)) {

                        /* Comprobar que la contraseña ingresada sea igual a la 
                        almacenada con hash */
                        if (password_verify($password, $hashed_password)) {

                            // La contraseña es correcta, así que se inicia una nueva sesión
                            session_start();

                            // Almacenar los datos en las variables de la sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user"] = $username;

                            // Redirigir al usuario a la página correspondiente
                            header("location: catalogo.php");
                            exit;
                        } else {
                            // Mostrar un mensaje de error si la contraseña no es válida
                            $password_err = "La contraseña que ha ingresado no es válida.";
                        }
                    }
                } else {
                    // Mostrar un mensaje de error si el nombre de usuario no existe
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }

        // Cerrar la sentencia de consulta
        mysqli_stmt_close($stmt);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}

?>


<?php
require_once("vista/parte-superior.php")
?>
<link rel="stylesheet" href="formularios.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-md-8">
            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1 class="login-form-title">Login</h1>
                <!-- Usuario input -->
                <div class="form-group">
                    <input type="text" id="form1Example1" class="form-control" name="txtUsuario" />
                    <label class="form-label" for="form1Example1">Usuario</label>
                    <span class="text-danger">
                        <?php echo $username_err; ?>
                    </span>
                </div>
                <!-- Password input -->
                <div class="form-group">
                    <input type="password" id="form1Example2" class="form-control" name="txtContraseña" />
                    <label class="form-label" for="form1Example2">Contraseña</label>
                    <span class="text-danger">
                        <?php echo $password_err; ?>
                    </span>
                </div>
                <!-- Checkbox y enlace -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                            <label class="form-check-label" for="form1Example3">
                                Recordar contraseña
                            </label>
                        </div>
                    </div>
                    <div class="col text-center">
                        <a class="form-link" href="#!">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once("vista/parte-inferior.php")
?>