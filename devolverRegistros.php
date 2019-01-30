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
        
        print_r($row);
        $email=$row['email'];
        $subject="Renovación..-";
        $body="Hola ".$row['firstName']." tu suscripción de ".$row['subscriptionName']."te caduca en ".$row['remainMe']." dias, recuerda renovar la sucripción."
                . "Gracias."
                . "Atentamente AOM.";
        sendMail($email, $subject, $body);

      

    }
    

}


} catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
}


use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

        
            

        

     
                                    
  



            


            //AQUI EMPIEZA EL PHP MAILER




           
            

            
            function sendMail($email,$subject, $body){
                
            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';
            $mail = new PHPMailer;



            $mail->isSMTP();  
            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'aomsubscriptionmanager@gmail.com';                 // SMTP username
            $mail->Password = 'Barcelona12345!';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;   
            $mail->charSet="UTF-8";// TCP port to connect to

             $mail->setFrom('aomsubscriptionmanager@gmail.com', "AOM");
            $mail->addAddress($email);     // Add a recipient
//                $mail->addAddress('ellen@example.com');

//                $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;
            if (!$mail->send()) {
                echo 'Mensaje no se ha podido enviar.';
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Mensaje enviado correctamente';
            }
            
            }