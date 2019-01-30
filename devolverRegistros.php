<?php

$server = "localhost";
$user = "root";
            $password = "";
            $db = "AOM";
            
            
            try {

                $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
       

$sql = "SELECT * from Subscription join users on Subscription.userID=users.userid
where date_add(DATE_ADD(firstBill, INTERVAL duration MONTH) , interval remainme day) >= curdate() ";

$resul = $conn->query($sql);

if ($resul->rowCount() > 0) {

    while ($row = $resul->fetch()) {
        
        sendMail();

      

    }
    

}


} catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
}


use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

        
            

        

     
                                    
  



            


            //AQUI EMPIEZA EL PHP MAILER




           
            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';

            
            function sendMail(){
                
            
            $mail = new PHPMailer;



            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'aomsubscriptionmanager@gmail.com';                 // SMTP username
            $mail->Password = 'Barcelona12345!';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom($email, "$nombre $apellido");
            $mail->addAddress('aomsubscriptionmanager@gmail.com');     // Add a recipient
            $mail->addReplyTo($email, 'Information');


//                $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'RECORDATORIO PAGO SUBCRIPCIÓN';
            $mail->Body = "Nombre: $nombre <br> Teléfono: $telephone <br>Consulta: $message <br>Email del usuario: $email ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                echo 'Mensaje no se ha podido enviar.';
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Mensaje enviado correctamente';
            }
            
            }