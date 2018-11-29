<?php

session_start();
require_once 'bbdd.php';


class subscription extends bbdd {

    private $subscriptionName;
    private $description;
    private $cycle;
    private $firstBill;
    private $duration;
    private $remaindMe;
    private $price;
    private $userID;

    function __construct(string $subscriptionName, string $description, int $cycle, string $firstBill, int $duration,  int $remaindMe, float $price, int $userID) {
        $this->subscriptionName = $subscriptionName;
        $this->description = $description;
        $this->cycle = $cycle;
        $this->firstBill = $firstBill;
        $this->duration = $duration;
        $this->remaindMe = $remaindMe;
        $this->price = $price;
        $this->userID = $userID;
        parent::__construct('Subscription', 'subscriptionID');
    }
    
    function insert_values() {
        $this->insert(['subscriptionName' => $this->subscriptionName, 'description' => $this->description, 'cycle' => $this->cycle, 'firstBill' => $this->firstBill, 'duration' => $this->duration, 'remainMe' => $this->remaindMe, 'price' => $this->price, 'userID' => $this->userID]);
    }
}
$u = new subscription("Netflix", "Home", 2, "2004-11-02", 15, 2, 2.4, 1);
$u->insert(['subscriptionName' => 'Netflix', 'description' => 'Home', 'cycle' => 2, 'firstBill' => '2004-11-02', 'duration' => 15, 'remainMe' => 2, 'price' => 2.4, 'userID' => 1]);