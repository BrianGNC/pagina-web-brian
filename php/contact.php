<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            $destinatario = "bgncbrian.09@gmail.com";
            $asunto = "Nuevo mensaje de contacto de $nombre";
            
            $cuerpo = "Nombre: $nombre\n";
            $cuerpo .= "Correo: $email\n\n";
            $cuerpo .= "Mensaje:\n$mensaje\n";

            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
        
            if (mail($destinatario, $asunto, $cuerpo, $headers)) {
                echo "El mensaje se ha enviado correctamente.";
            } else {
                echo "Error: No se pudo enviar el mensaje.";
            }
        } else {
            echo "Por favor, ingresa un correo electrónico válido.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "Error: El formulario no ha sido enviado correctamente.";
}
?>