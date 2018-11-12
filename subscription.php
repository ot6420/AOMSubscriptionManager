<?php

class subscription {

    private $subscriptionName;
    private $description;
    private $cycle;
    private $firstBill;
    private $remaindMe;
    private $price;

}

function __construct(string $subscriptionName, string $description, string $cycle, date $firstBill, boolean $remaindMe, double $price) {
    $this->subscriptionName = $subscriptionName;
    $this->description = $description;
    $this->cycle = $cycle;
    $this->firstBill = $firstBill;
    $this->remaindMe = $remaindMe;
    $this->price = $price;
}
