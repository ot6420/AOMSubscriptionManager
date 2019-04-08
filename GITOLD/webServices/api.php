<?php

require_once 'http.php';
require_once 'response.php';

$controller = filter_input(INPUT_GET, "controller");
$ruta = "../class/";
/* $controller = "user";
  print_r( "../class/".$controller."Class.php"); */
$id = filter_input(INPUT_GET, "id");
$verbo = $_SERVER['REQUEST_METHOD'];
$http = new HTTP();
if (empty($controller) || !file_exists($ruta . $controller . "Class.php")) {
    $http = new HTTP();
    $http->setHttpHeaders(400, new Response("Bad request"));
    die();
}
require $ruta . $controller . "Class.php";
$c = $controller . "Class";
$objeto = new $c;
switch ($verbo) {
    case 'GET':
        if (empty($id)) {
            $datos = $objeto->getAll();
            $http->setHttpHeaders(200, new Response("Lista $controller", $datos));
        } else {
            $objeto->load($id);
            $http->setHttpHeaders(200, new Response("Lista $controller", $objeto->serialize()));
        }
        break;
    case 'POST':
//Recuperamos los datos en crudo y los decodificamos
        $datos = file_get_contents("php://input");
        $centro = json_decode($datos);
        if ($funcion == "masiva") {
            /* foreach ($centro as $nombre) {
              $_SESSION['bd'][$tabla][] = $nombre;
              } */
            for ($i = 0; $i < 20; $i++) {
                $_SESSION['bd'][$tabla][] = $tabla . " " . $i;
            }
            $message->data = $_SESSION['bd'][$tabla];
        } elseif (!empty($centro)) {
            $_SESSION['bd'][$tabla][] = $centro->nombre;
            $message->result = "Ok";
            $message->data = ['centros' => count($_SESSION['bd'][$tabla]), 'Nuevo' => $centro->nombre];
        } else {
            $message->result = "Error, falta centro";
            $message->data = $datos;
        }

        break;
    case 'PUT':

        if (empty($id)) {
            $http->setHttpHeaders(400, new Response("Bad request"));
            die();
        }
        $objeto->load($id);
        $raw = file_get_contents("php://input");
        $datos = json_decode($raw);
        foreach ($datos as $c => $v) {
            $objeto->$c = $v;
        }
        $objeto->save();

        break;
    case 'DELETE':
        if ($function == "borradoMasivo") {
            foreach ($centro as $nombre) {
                $_SESSION['bd'][$tabla][] = $nombre;
            }
            $message->data = $_SESSION['bd'][$tabla];
        } elseif (!empty($id)) {
            $message->data = ['elementos' => count($_SESSION['bd'][$tabla]) - 1, 'id' => $id, 'Nombre' => $_SESSION['bd'][$tabla][$id]];
            unset($_SESSION['bd'][$tabla][$id]);
            $message->result = "Ok";
        } else {
            $message->result = "Error, falta id";
            $message->data = null;
        }
        break;
    default:
        $message->result = "Error: Acción no reconocida";
        $message->data = null;
}