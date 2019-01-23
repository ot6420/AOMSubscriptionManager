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


    }
    

}


} catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
}