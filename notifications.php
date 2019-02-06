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

        
            

        

     
                                    
                        
            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "AOM";
       



            


            //AQUI EMPIEZA EL PHP MAILER




           
            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';

            $mail = new PHPMailer;



            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'aomsubscriptionmanager@gmail.com';                 // SMTP username
            $mail->Password = 'Barcelona12345!';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('aomsubscriptionmanager@gmail.com', "AOM");
            $mail->addAddress($email);     // Add a recipient
//                $mail->addAddress('ellen@example.com');

//                $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;
          //  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                echo 'Mensaje no se ha podido enviar.';
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Mensaje enviado correctamente';
            }
        
        ?>
        
        
        
        
<!--        CONSULTA SQL: SELECT * from Subscription join users on Subscription.userID=users.userid
where date_add(DATE_ADD(firstBill, INTERVAL duration MONTH) , interval remainme day) >= curdate() -->
     
    </body>
</html>
