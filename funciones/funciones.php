<?php 
error_reporting(E_ALL);
include("class.phpmailer.php");
include("class.smtp.php");

function enviar_mail($email,$name,$site,$sourcemail,$passmail)
{
$mail = new PHPMailer();

/// Envio el link de la activación a mi sitio, redirigido a un script en php que leera el archivo de usuarios
/// y cambiara el estado de activación de 0 a 1 en el caso de encontrarlo y que este en 0
/// el link de propio de cada equipo  

// utilizo la funcion de php base64_encode para enviar información medianamente segura sin que el usuario vea facilmente
//$linkactivacion=$site.'?tagged='.base64_encode($email);
//<h3><b> Enlace de activacion '.$linkactivacion.':</b></h3>


$body='<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="STYLESHEET" type="text/css" href="http://isft177.servehttp.com/colegio/css/mail.css"> 
    <link rel="STYLESHEET" type="text/css" href="./css/style.css"> 
</head></head> 

<body style="margin: 0; padding: 0; background-color: white;">
    <center>
            <table class="contenido_tabla" width="700" style="background-color:rgb( 113, 117, 109 ); color:white; font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;border:6px solid #13353F; border-spacing: 0; padding: 0 25px; border-color: rgb( 12, 12, 12 ); ">
                <thead>
                    <tr>
                        <td><left><b><img src="https://images7.memedroid.com/images/UPLOADED298/62be59449fef3.jpeg" width="650px"></td>
                    </tr>
                    <tr><br>
                        <td><center><h2><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirmaci&oacute;n de Registro</b></h2></center></td>
                    </tr>
                </thead>
                <tbody border="0"> 
                    <tr>
                        <td style="color:white;" colspan="2">
                            <h3><b>Estimado/a '.$name.':</b></h3>
                            Gracias por registrarse en nuestro sitio web. Le pedimos que si al menos el meme le hizo sonreir considere subirle un puntito al parcial.. Muchas gracias!.<br><br>
                    
                            <!--.................. WELCOME TO THE CLUB OF THOSE WHO DO NOT SLEEP .............................-->
                            
                            <br><br>                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top:1px solid #cccccc; margin-top:2px; font-size:15px;"><br>
                            <left>
                                <strong> Mi sitio Web </strong><br>
                                Escribo mi mail de contacto<br><br>
                            </left>
                        </td>
                    </tr>
                </tbody>
            </table>
    </center>
</body> 
</html>';

// Atención para poder enviar a traves de gmail se debe permitir a google enviar mails desde otras aplicaciones
// para ello deberán entrar al link de abajo, se realiza por única vez
// https://myaccount.google.com/u/0/lesssecureapps?pli=1

$mail->IsSMTP(); // telling the class to use SMTP
// instrucciones de la funcion ///
//$mail->Host       = "mail.yourdomain.com"; // SMTP server
//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
//$mail->SMTPAuth   = true;                  // enable SMTP authentication
//$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
//$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = '587';                   // set the SMTP port for the GMAIL server
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username   = $sourcemail;  // GMAIL username
$mail->Password   = $passmail;            // GMAIL password
$mail->SetFrom("systemmss2023@gmail.com", 'Mi sitio WEB');
$mail -> AddAddress($email,$name);
$mail->Subject    = "Confirmar Registro en sitio web.... ";
$mail->AltBody    = "...---..."; // optional, comment out and test
$mail->MsgHTML($body);
$Errrrror="";
//
// si deseo adjuntar algun archivo 
///$mail->AddAttachment("archivarchivivoivo.tar.xz");

if(!$mail->Send())
{
    $Errrrror="<br>.<br>Mailer Error: " . $mail->ErrorInfo;
}
else
{
    return true;
}
}
?> 