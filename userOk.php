<?php
require_once 'tabla.php';

class userOk extends Tabla {

    private $userID;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $email;
    private $pass;
    private $pass1;
    private $interfaceLanguage;
    private $userType;
    private $num_fields = 8;

    function __construct() {
        $show = ["firstName"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("Users", "userID", $fields, $show);
    }

    function getIdUser() {
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

    function setIdUser($userID) {
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

//    function getAlumnoByCentro($id){
//        $alumnos=$this->getAll(['idcentro'=>$id]);
//        //Convertirlo en un array de objetos Alumno
//        $obj_al=[];
//        foreach ($alumnos as $a){
//        $alumno=new Alumno();
//        $alumno->load($a['idalumno']);
//        $obj_al[]=$alumno;
//        }
//        return $obj_al;
//    }
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
        } else {
            throw new Exception("No hay registro para borrar");
        }
    }

    private function valores() {
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

    function showUserData($userID) {
        $data = $this->getAll(['userID' => $userID]);
        return $data;
    }

}

$user = new userOk();
echo $user->toHTMLTable($user->showUserData(2));
$user->load(2);
?>
<form method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" class="form-control" id="idalumno" name="firstName" value="<?= $user->firstName ?>">
    <div class="form-group">
        <label for="nombre">Apellidos:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $user->lastName ?>">
    </div>
    <div class="form-group">
        <label for="nombre">Fecha de Nacimiento:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $user->birthDate ?>">
    </div>
    <div class="form-group">
        <label for="mail">Email:</label>
        <input type="text" class="form-control" id="mail"  name="mail" value="<?= $user->email ?>">
    </div>
    <div class="form-group">
        <label for="mail">Lenguaje de la interfaz:</label>
        <input type="text" class="form-control" id="mail"  name="mail" value="<?= $user->interfaceLanguage ?>">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php ?>