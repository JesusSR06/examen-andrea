<?php
// se incluye el archivo de configuración
require_once "conexion.php";

// Definir variables e inicializar con valores vacíos
$nombre = $username = $correo = $password = $confirm_password = "";
$nombre_err = $username_err = $correo_err = $password_err = $confirm_password_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar el nombre
    if (empty(trim($_POST["txtNombre"]))) {
        $nombre_err = "Por favor ingrese su nombre.";
    } else {
        $nombre = trim($_POST["txtNombre"]);
    }

    // Validar el nombre de usuario
    if (empty(trim($_POST["txtUsuario"]))) {
        $username_err = "Por favor ingrese un usuario.";
    } else {
        // Preparar la consulta
        $sql = "SELECT id FROM usuarios WHERE usuario = ?";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Asignar parámetros
            $param_username = trim($_POST["txtUsuario"]);
            // Intentar ejecutar la declaración preparada
            if (mysqli_stmt_execute($stmt)) {
                // Almacenar resultado
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este usuario ya fue tomado.";
                } else {
                    $username = trim($_POST["txtUsuario"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }

    // Validar correo electrónico
    if (empty(trim($_POST["txtCorreo"]))) {
        $correo_err = "Por favor ingrese su correo electrónico.";
    } else {
        $correo = trim($_POST["txtCorreo"]);
    }

    // Validar contraseña
    if (empty(trim($_POST["txtContraseña"]))) {
        $password_err = "Por favor ingresa una contraseña.";
    } elseif (strlen(trim($_POST["txtContraseña"])) < 6) {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = trim($_POST["txtContraseña"]);
    }

    // Validar confirmación de contraseña
    if (empty(trim($_POST["txtConfirmarContraseña"]))) {
        $confirm_password_err = "Confirma tu contraseña.";
    } else {
        $confirm_password = trim($_POST["txtConfirmarContraseña"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Verificar los errores de entrada antes de insertar en la base de datos
    if (empty($nombre_err) && empty($username_err) && empty($correo_err) && empty($password_err) && empty($confirm_password_err)) {
        // Preparar una declaración de inserción
        $sql = "INSERT INTO usuarios (Nombre, Usuario, Correo, Contraseña) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ssss", $param_nombre, $param_username, $param_correo, $param_password);
            // Establecer parámetros
            $param_nombre = $nombre;
            $param_username = $username;
            $param_correo = $correo;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Crear una contraseña hash
            // Intentar ejecutar la declaración preparada
            if (mysqli_stmt_execute($stmt)) {
                // Redirigir a la página de inicio de sesión (login.php)
                header("location: login.php");
            } else {
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
        // Cerrar declaración
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
<form class="registro-form bg-white rounded shadow-5-strong p-5" action="register.php" method="post">
    <h1 class="form-title">Registro</h1>
    <!-- Name input -->
    <div class="form-group">
        <input type="text" id="form1Example1" class="form-control" name="txtNombre" />
        <label class="form-label" for="form1Example1">Nombre</label>
    </div>
    <!-- Usuario input -->
    <div class="form-group">
        <input type="text" id="form1Example2" class="form-control" name="txtUsuario" />
        <label class="form-label" for="form1Example2">Usuario</label>
    </div>
    <!-- Email input -->
    <div class="form-group">
        <input type="email" id="form1Example3" class="form-control" name="txtCorreo" />
        <label class="form-label" for="form1Example3">Correo electrónico</label>
    </div>
    <!-- Password input -->
    <div class="form-group">
        <input type="password" id="form1Example4" class="form-control" name="txtContraseña" />
        <label class="form-label" for="form1Example4">Contraseña</label>
    </div>
    <!-- Confirmar contraseña input -->
    <div class="form-group">
        <input type="password" id="form1Example5" class="form-control" name="txtConfirmarContraseña" />
        <label class="form-label" for="form1Example5">Confirmar contraseña</label>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block">Registrarte</button>
</form>

<?php
require_once("vista/parte-inferior.php")
?>