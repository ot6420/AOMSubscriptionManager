<?php
require_once 'tabla.php';

class subscriptionOk extends Tabla {

    private $subscriptionID;
    private $subscriptionName;
    private $description;
    private $cycle;
    private $firstBill;
    private $duration;
    private $remainMe;
    private $price;
    private $userID;
    private $num_fields = 9;

    function __construct() {
        $show = ["subscriptionName"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("Subscription", "subscriptionID", $fields, $show);
    }
    
    function getSubscriptionID() {
        return $this->subscriptionID;
    }

    function getSubscriptionName() {
        return $this->subscriptionName;
    }

    function getDescription() {
        return $this->description;
    }

    function getCycle() {
        return $this->cycle;
    }

    function getFirstBill() {
        return $this->firstBill;
    }

    function getDuration() {
        return $this->duration;
    }

    function getRemainMe() {
        return $this->remainMe;
    }

    function getPrice() {
        return $this->price;
    }

    function getUserID() {
        return $this->userID;
    }

    function getNum_fields() {
        return $this->num_fields;
    }

    function setSubscriptionID($subscriptionID) {
        $this->subscriptionID = $subscriptionID;
    }

    function setSubscriptionName($subscriptionName) {
        $this->subscriptionName = $subscriptionName;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setCycle($cycle) {
        $this->cycle = $cycle;
    }

    function setFirstBill($firstBill) {
        $this->firstBill = $firstBill;
    }

    function setDuration($duration) {
        $this->duration = $duration;
    }

    function setRemainMe($remainMe) {
        $this->remainMe = $remainMe;
    }

    function setPrice($price) {
        $this->price = $price;
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
        $user = $this->getById($id);

        if (!empty($user)) {
            $this->subscriptionID = $id;
            $this->subscriptionName = $user['subscriptionName'];
            $this->description = $user['description'];
            $this->cycle = $user['cycle'];
            $this->firstBill = $user['firstBill'];
            $this->duration = $user['duration'];
            $this->remainMe = $user['remainMe'];
            $this->price = $user['price'];
            $this->userID = $user['userID'];
        } else {
            throw new Exception("No existe ese registro");
        }
    }

    function delete() {
        if (!empty($this->subscriptionID)) {
            $this->deleteById($this->subscriptionID);
            $this->subscriptionID = null;
            $this->subscriptionName = null;
            $this->description = null;
            $this->cycle = null;
            $this->firstBill = null;
            $this->duration = null;
            $this->remainMe = null;
            $this->price = null;
            $this->userID = null;
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
        $subscription = $this->valores();
        unset($subscription['subscriptionID']);
        if (empty($this->subscriptionID)) {
            $this->insert($subscription);
            $this->subscriptionID = self::$conn->lastInsertId();
        } else {
            $this->update($this->subscriptionID, $subscription);
        }
    }

    function showSubscriptionData($subscriptionID) {
        $data = $this->getAll(['subscriptionID' => $subscriptionID]);
        return $data;
    }

}