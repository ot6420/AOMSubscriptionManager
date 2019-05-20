<?php

require_once 'tablaClass.php';

class feedbackClass extends Tabla {

    private $feedbackID;
    private $vote;
    private $description;
    private $userID;
    private $num_fields = 4;

    function __construct() {
        $show = ["vote"];
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
        $feedback = $this->getById($id);
        if (!empty($feedback)) {
            $this->feedbackID = $id;
            $this->vote = $feedback['vote'];
            $this->description = $feedback['description'];
            $this->userID = $feedback['userID'];
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
        $feedback = $this->valores();
        unset($feedback['feedbackID']);
        if (empty($this->feedbackID)) {
            $this->insert($feedback);
            $this->feedbackID = self::$conn->lastInsertId();
        } else {
            $this->update($this->feedbackID, $feedback);
        }
    }

    function loadAll() {
        return $this->getAll();
    }

    function serialize() {
        return $this->valores();
    }

}
