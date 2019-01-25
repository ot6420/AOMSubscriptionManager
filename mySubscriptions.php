<?php

require_once 'class/subscriptionClass.php';
$mysubscriptions = new subscriptionClass();
$id = 2;
$mysubscriptions->load($id);
var_dump($mysubscriptions);

foreach ($mysubscriptions as $key=>$subscription) {
    var_dump($subscription);
}
//var_dump($mysuscriptions);


