<?php

require_once 'class/subscriptionClass.php';
$mysubscriptions = new subscriptionClass();
$id = 2;
$mysubscriptions->load($id);
echo "<div class='suscription'>";
echo $mysubscriptions->subscriptionName;
echo "</div>";