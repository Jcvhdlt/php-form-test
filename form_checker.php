<?php

$errores = []; // array para guardar errores
$datos_recibidos = []; // array para ir guardando toda la info

// Verificar si el formulario fue enviado usando el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validación del Nombre (obligatorio)
    if (empty(trim($_POST["name"]))) {
        $errores["name"] = "El nombre es obligatorio.";
        $datos_recibidos["name"] = "";
    } else {
        $datos_recibidos["name"] = htmlspecialchars(trim($_POST["name"]));
    }


    // Validacion del primer apellido
    if (empty(trim($_POST["firstsurname"]))) {
        $errores["firstsurname"] = "El primer apellido es obligatorio.";
    } else {
        $datos_recibidos["firstsurname"] = htmlspecialchars(trim($_POST["firstsurname"]));
    }

    //Validación del segundo apellido
    if (isset($_POST["secondsurname"]) && !empty(trim($_POST["secondsurname"]))) {
        $datos_recibidos["secondsurname"] = htmlspecialchars(trim($_POST["secondsurname"]));
    } else {
        $datos_recibidos["secondsurname"] = "";
    }


    // Validacion del email
    if (empty(trim($_POST["email"]))) {
        $errores["email"] = "El correo electrónico es obligatorio.";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores["email"] = "Formato de correo electrónico inválido.";
        } else {
            $datos_recibidos["email"] = htmlspecialchars($email);
        }
    }

    // Validacion del telefono
    if (isset($_POST["telefono"]) && !empty(trim($_POST["telefono"]))) {
        $telefono = trim($_POST["telefono"]);
        // Ejemplo de validación para 9 dígitos numéricos
        if (!preg_match("/^[0-9]{9}$/", $telefono)) {
            $errores["telefono"] = "El teléfono debe contener 9 dígitos numéricos.";
        } else {
            $datos_recibidos["telefono"] = htmlspecialchars($telefono);
        }
    } else {
        $datos_recibidos["telefono"] = "";
    }


    // para mostrar resultados
    if (empty($errores)) {
        // Si no hay errores, el formulario es válido
        echo "<h1>¡Formulario enviado con éxito!</h1>";
        echo "<p>Datos recibidos:</p>";
        echo "<ul>";
        foreach ($datos_recibidos as $campo => $valor) {
            echo "<li><strong>" . ucfirst(str_replace('_', ' ', $campo)) . ":</strong> " . $valor . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="index.html">Volver al formulario</a></p>'; // Enlace para volver
    } else {
        // Si hay errores, mostrar la lista de errores
        echo "<h1>Se encontraron los siguientes errores:</h1>";
        echo "<ul>";
        foreach ($errores as $campo => $mensaje) {
            echo "<li><strong>" . ucfirst(str_replace('_', ' ', $campo)) . ":</strong> " . $mensaje . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="index.html">Volver al formulario</a></p>'; // Enlace para volver
    }

} else {
    echo "<h1>Error: método de acceso no permitido.</h1>";
    echo '<p><a href="index.html">Volver al formulario</a></p>';
}

?>