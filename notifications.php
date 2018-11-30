<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

        if (!isset($_POST['Enviar'])) {
            ?>



            <FORM METHOD="POST" id="contacto"> 

                <label for="first_name">Nombre</label> <INPUT type="text" size=36 name="first_name" required=""></INPUT> 
                <label for="last_name">Apellido</label> <INPUT type="text" size=36 name="last_name" required=""></INPUT> 
                <label for="email">E-mail</label> <INPUT type="email" size=36 name="email" required=""></INPUT> 
                <label for="telephone">Telefono</label> <INPUT type="tel" size=36 name="telephone"required=""></INPUT> 
                <label for="message">Mensaje</label> <TEXTAREA rows=5 cols=30 name="message"required=""></TEXTAREA> 
            <br>
            <INPUT type="reset" value="Borrar"> <INPUT type="submit" value="Enviar" name="Enviar">
             
            </FORM> 
                                    
                        
            <?php
        } else {



            $nombre = $_POST['first_name'];
            $apellido = $_POST['last_name'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $message = $_POST['message'];



            //AQUI EMPIEZA EL PHP MAILER




           
        require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';

            $mail = new PHPMailer;



            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'marcroigchueca@gmail.com';                 // SMTP username
            $mail->Password = 'cinccopes8.';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom($email, "$nombre $apellido");
            $mail->addAddress('marcroigchueca@gmail.com', 'OHHMUSIC');     // Add a recipient
//                $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($email, 'Information');


//                $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'COSULTA';
            $mail->Body = "Nombre: $nombre <br> Teléfono: $telephone <br>Consulta: $message <br>Email del usuario: $email ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                echo 'Mensaje no se ha podido enviar.';
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Mensaje enviado correctamente';
            }
        }
        ?>
     
    </body>
</html>
