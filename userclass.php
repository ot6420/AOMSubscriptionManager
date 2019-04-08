<?php

require_once 'tablaClass.php';

class userClass extends Tabla {

    private $userID;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $email;
    private $pass;
    private $interfaceLanguage;
    private $userType;
    private $token;
    private $num_fields = 9;

    function __construct() {
        $show = ["firstName"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("Users", "userID", $fields, $show);
    }

    function getUserID() {
        return $this->userID;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getBirthDate() {
        return $this->birthDate;
    }

    function getEmail() {
        return $this->email;
    }

    function getPass() {
        return $this->pass;
    }

    function getPass1() {
        return $this->pass1;
    }

    function getInterfaceLanguage() {
        return $this->interfaceLanguage;
    }

    function getUserType() {
        return $this->userType;
    }

    function getToken() {
        return $this->token;
    }
    
    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setPass1($pass1) {
        $this->pass1 = $pass1;
    }

    function setInterfaceLanguage($interfaceLanguage) {
        $this->interfaceLanguage = $interfaceLanguage;
    }

    function setUserType($userType) {
        $this->userType = $userType;
    }

    function setToken($token) {
        $this->token = $token;
    }

    function __get($name) {
        $metodo = "get$name";
        if (method_exists($this, $metodo)) {
            return $this->$metodo();
        } else {
            throw new Exception("Propiedad no encontrada");
        }
    }

    function __set($name, $value) {
        $metodo = "set$name";
        if (method_exists($this, $metodo)) {
            return $this->$metodo($value);
        } else {
            throw new Exception("Propiedad no encontrada");
        }
    }

    function load($id) {
        $user = $this->getById($id);
        if (!empty($user)) {
            $this->userID = $id;
            $this->firstName = $user['firstName'];
            $this->lastName = $user['lastName'];
            $this->birthDate = $user['birthDate'];
            $this->email = $user['email'];
            $this->pass = $user['pass'];
            $this->interfaceLanguage = $user['interfaceLanguage'];
            $this->userType = $user['userType'];
            $this->token = $user['token'];
        } else {
            throw new Exception("No existe ese registro");
        }
    }

    function delete() {
        if (!empty($this->userID)) {
            $this->deleteById($this->userID);
            $this->userID = null;
            $this->firstName = null;
            $this->lastName = null;
            $this->birthDate = null;
            $this->email = null;
            $this->pass = null;
            $this->interfaceLanguage = null;
            $this->userType = null;
            $this->token = null;
        } else {
            throw new Exception("No hay registro para borrar");
        }
    }

    function valores() {
        $valores = array_map(function($v) {
            return $this->$v;
        }, $this->fields);
        return array_combine($this->fields, $valores);
    }

    function save() {
        $user = $this->valores();
        unset($user['userID']);
        if (empty($this->userID)) {
            $this->insert($user);
            $this->userID = self::$conn->lastInsertId();
        } else {
            $this->update($this->userID, $user);
        }
    }

    function login($user, $pass) {
        $info = ['email' => $user, 'pass' => $pass];
        $u = $this->getAll($info);
        if (!empty($u)) {
            return $u;
        }
    }
    
    function getDataToken($token) {
        $dataToken = $this->getAll(['token' => $token]);
        if (!empty($dataToken)) {
            return $dataToken;
        }
    }

    function showUserData($userID) {
        $data = $this->getAll(['userID' => $userID]);
        return $data;
    }

    function loadAll() {
        return $this->getAll();
    }

    function serialize() {
        return $this->valores();
    }
    
}