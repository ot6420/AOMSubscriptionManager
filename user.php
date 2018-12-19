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
    function showUserData($userID) {
        $data = $this->getAll(['userID' => $userID]);
        return $data;
    }

}

$u = new user("Ot", "Trivino", "1999-11-05", "ot.trivino.calsina@gmail.com", "1234", "catalan", 1);
//$u->insert(['firstName' => 'Ot', 'lastName' => 'Trivino', 'birthDate' => "1999-11-05", 'email' => 'ot.trivino.calsina@gmail.com', 'pass' => '123d', 'interfaceLanguage' => 'catalan', 'userType' => 1]);
//$u->load(9);
//var_dump($u);

//Aqui cambiando el numero que está entre parentesis, podemos mostrar las suscripciones de cada usuario.
echo $u->toHTMLTable($u->showUserData(2));

        $user = $u->getById(1);
?>

            <form method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="idalumno" name="firstName" value="<?= $user['firstName'] ?>">
                <div class="form-group">
                    <label for="nombre">Apellidos:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $user['lastName'] ?>">
                </div>
                <div class="form-group">
                    <label for="nombre">Fecha de Nacimiento:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $user['birthDate'] ?>">
                </div>
                <div class="form-group">
                    <label for="mail">Email:</label>
                    <input type="text" class="form-control" id="mail"  name="mail" value="<?= $user['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="mail">Lenguaje de la interfaz:</label>
                    <input type="text" class="form-control" id="mail"  name="mail" value="<?= $user['interfaceLanguage'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            <?php
        

?>


