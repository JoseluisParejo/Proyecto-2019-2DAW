<?php 
   //este fragmento de codigo proviene de tutoriales y github de PHPMailer, no es solo mio
use PHPMailer\PHPMailer\PHPMailer;

require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/SMTP.php";
require_once "PHPMailer/src/Exception.php";
//podemos incluir de distintas maneras PHPMailer, como por ejemplo con composer. Aqui lo llamamos a la carpeta descargada desde github
$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";  //Este es el host que manda los correos
$mail->SMTPAuth = true; //aqui pedira la autentificacion al mandatario del correo
$mail->Username = "correo1@gmail.com"; //mail del mandatario
$mail->Password = 'contraseña';  //contraseña de dicho mail
$mail->port = 465;   //puerto por el que lo envia
$mail->SMTPSecure = 'tls'; //tipo de seguridad
$mail->SMTPDebug = 0;   //esto comprobara los fallos si no llegase el correo. Cambiar por 1 o por 2 para mas detalles


$mail->isHTML(true); //el tipo de correo
$mail->setFrom('correo1@gmail.com', 'John Wick'); //el correo que se mostrara al enviado con informacion de quien lo envia
$mail->addAddress('correo2@gmail.com');   //correo del destinatario, podemos incluir uno que llege por POST
$mail->Subject = 'Informacion de la reserva';   //Titulo del correo
$mail->Body = "Su reserva a sido realizada"; //mensaje del correo
//esto es un condicional si el correo es enviado o si no
if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
//aqui redirige a otro php al terminar este
header('location: cuenta.php');


?>

