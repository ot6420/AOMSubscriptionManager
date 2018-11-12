<?php

class user {

    private $firstName;
    private $lastName;
    private $birthDate;
    private $email;
    private $pass;
    private $pass1;
    private $language;
    private $userType;

    function __construct(string $firstName, string $lastName, date $birthDate, string $email, string $pass, string $pass1, string $language, int $userType = 0) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->pass = $pass;
        $this->pass1 = $pass1;
        $this->language = $language;
        $this->userType = $userType;
    }

    function checkPass($pass, $pass1) {
        if ($pass == $pass1) {
            
        } else {
            return false;
        }
    }

}
