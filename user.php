<?php

//session_start();
require_once 'bbdd.php';

class user extends bbdd {
    private $idUser;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $email;
    private $pass;
    private $pass1;
    private $interfaceLanguage;
    private $userType;

    function __construct(string $firstName, string $lastName, string $birthDate, string $email, string $pass, string $pass1, string $interfaceLanguage, int $userType = 0) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->pass = $pass;
        $this->pass1 = $pass1;
        $this->interfaceLanguage = $interfaceLanguage;
        $this->userType = $userType;
        parent::__construct('Users', 'UserID');
    }

    //Función encargada de insertar lo valores del formulario de registro
    function insert_values() {
        if ($this->pass == $this->pass1) {
            $this->insert(['firstName' => $this->firstName, 'lastName' => $this->lastName, 'birthDate' => $this->birthDate, 'email' => $this->email, 'pass' => $this->pass, 'interfaceLanguage' => $this->interfaceLanguage, 'userType' => $this->userType]);
        } else {
            return "Las contraseñas no coinciden";
        }
    }
    
    //Funciones encargadas de modificar los datos de un usuario
    function setName($name) {
        $this->firstName = $name;
    }
    
    function setLastName($name) {
        $this->lastName = $name;
    }
    
    function birthDate($date) {
        $this->birthDate = $date;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }
    
    function setPass($pass) {
        $this->pass = $pass;
    }
    
    function setInterfaceLanguage($interfaceLanguage) {
        $this->interfaceLanguage = $interfaceLanguage;
    }
    
    //Función encargada de borrar un usuario
    function delete() {
       if (!empty($this->idUser)) {
           $this->deleteById($this->idUser);
       } else {
           throw new Exception("No hay registro para borrar");
       }
   }
   
   //Función encargada de cargar todos los datos de un usario con una id en concreto
   function load($id) {
       $user = $this->getById($id);

       if (!empty($user)) {
           $this->idUser = $id;
           $this->firstName = $user['firstName'];
           $this->lastName = $user['lastName'];
           $this->birthDate = $user['birthDate'];
           $this->email = $user['email'];
           $this->pass = $user['pass'];
           $this->interfaceLanguage = $user['interfaceLanguage'];
           
//           $centro = new Centro();
//           $centro->load($alumno['idcentro']);
//           $this->centro=$centro;
       } else {
           throw new Exception("No existe ese registro");
       }
   }

}

$u = new user("Ot", "Trivino", "1999-11-05", "ot.trivino.calsina@gmail.com", "1234", "catalan", 1);
//$u->insert(['firstName' => 'Ot', 'lastName' => 'Trivino', 'birthDate' => "1999-11-05", 'email' => 'ot.trivino.calsina@gmail.com', 'pass' => '123d', 'interfaceLanguage' => 'catalan', 'userType' => 1]);
$u->load(9);
var_dump($u);