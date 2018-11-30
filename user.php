<?php

session_start();
require_once 'bbdd.php';

class user extends bbdd {

    private $firstName;
    private $lastName;
    private $birthDate;
    private $email;
    private $pass;
    private $pass1;
    private $language;
    private $userType;

    function __construct(string $firstName, string $lastName, string $birthDate, string $email, string $pass, string $pass1, string $language, int $userType = 0) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->pass = $pass;
        $this->pass1 = $pass1;
        $this->language = $language;
        $this->userType = $userType;
        parent::__construct('Users', 'UserID');
    }
    
//    function checkPass($pass, $pass1) {
//        if ($pass == $pass1){
//            $pass_checked = $pass;
//        } else {
//            return false;
//        }
//    }

    function insert_values() {
        $this->insert(['firstName' => $this->firstName, 'lastName' => $this->lastName, 'birthDate' => $this->birthDate, 'email' => $this->email, 'pass' => $this->pass, 'language' => $this->language, 'userType' => $this->userType]);
    }

}
$u = new user("Ot", "Trivino", "1999-11-05", "ot.trivino.calsina@gmail.com", "1234", "catalan", 1);
$u->insert(['firstName' => 'Ot', 'lastName' => 'Trivino', 'birthDate' => "1999-11-05", 'email' => 'ot.trivino.calsina@gmail.com', 'pass' => '123d', 'interfaceLanguage' => 'catalan', 'userType' => 1]);