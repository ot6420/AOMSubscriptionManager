<?php
require_once 'tablaClass.php';

class feedBackClass extends Tabla {
    private $feedbackID;
    private $vote;
    private $description;
    private $userID;
    private $num_fields = 4;
    
    function __construct() {
        $show = ["description"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("FeedBack", "feedbackID", $fields, $show);
    }
    
    function getFeedbackID() {
        return $this->feedbackID;
    }

    function getVote() {
        return $this->vote;
    }

    function getDescription() {
        return $this->description;
    }

    function getUserID() {
        return $this->userID;
    }

    function getNum_fields() {
        return $this->num_fields;
    }

    function setFeedbackID($feedbackID) {
        $this->feedbackID = $feedbackID;
    }

    function setVote($vote) {
        $this->vote = $vote;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setNum_fields($num_fields) {
        $this->num_fields = $num_fields;
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
        $feedBack = $this->getById($id);

        if (!empty($feedBack)) {
            $this->feedbackID = $id;
            $this->vote = $feedBack['vote'];
            $this->description = $feedBack['description'];
            $this->userID = $feedBack['userID'];
        } else {
            throw new Exception("No existe ese registro");
        }
    }
    
    function delete() {
        if (!empty($this->feedbackID)) {
            $this->deleteById($this->feedbackID);
            $this->feedbackID = null;
            $this->vote = null;
            $this->description = null;
            $this->userID = null;
        } else {
            throw new Exception("No hay ningún voto para borrar");
        }
    }
    
    private function valores() {
        $valores = array_map(function($v) {
            return $this->$v;
        }, $this->fields);
        return array_combine($this->fields, $valores);
    }

    function save() {
        $feedBack = $this->valores();
        unset($feedBack['feedbackID']);
        if (empty($this->feedbackID)) {
            $this->insert($feedBack);
            $this->feedbackID = self::$conn->lastInsertId();
        } else {
            $this->update($this->feedbackID, $feedBack);
        }
    }
}



//function addFeedBack($idUser) {
//    require_once 'bbdd.php';
//    bbddConnection();
//
//    $idUserFeedBack = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
//    $vote = filter_input(INPUT_GET, 'vote', FILTER_SANITIZE_NUMBER_INT);
//    $description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);
//    if ($idUser != $idUserFeedBack) {
//        if (!empty($vote)) {
//            //Segunda regla: Utilizar sentencias preparadas SIEMPRE (o casi siempre)
//            $sql = "insert into vote(vote, description) values (:vote, :description)";
//            $st = $conn->prepare($sql);
//            $st->execute(['nombre' => $nombre]);
//            echo "Voto registrado " . $conn->lastInsertID();
//        }
//    } else {
//        echo "Ya has votado";
//    }
//}
