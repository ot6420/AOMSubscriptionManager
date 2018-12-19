<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function addFeedBack($idUser) {
    require_once 'bbdd.php';
    bbddConnection();

    $idUserFeedBack = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $vote = filter_input(INPUT_GET, 'vote', FILTER_SANITIZE_NUMBER_INT);
    $description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);
    if ($idUser != $idUserFeedBack) {
        if (!empty($vote)) {
            //Segunda regla: Utilizar sentencias preparadas SIEMPRE (o casi siempre)
            $sql = "insert into vote(vote, description) values (:vote, :description)";
            $st = $conn->prepare($sql);
            $st->execute(['nombre' => $nombre]);
            echo "Voto registrado " . $conn->lastInsertID();
        }
    } else {
        echo "Ya has votado";
    }
}
