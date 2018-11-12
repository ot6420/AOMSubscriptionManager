<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "test";
try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
//Con esta línea indicamos que si hay algún error se trate como una excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql="insert into test(nombre) values ('pepe')";
    //$conn->exec($sql);
    //var_dump($conn);
//Y si así fuera así capturamos la excepción
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}