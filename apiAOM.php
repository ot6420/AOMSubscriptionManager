<?php

header("Content-type:application/json");
//Incluímos la clase http para devolver el http del tipo de respuesta
//NOs servirá para poder devolver valores tipo 'Bad request'
require_once 'http.php';
//Recuperamos el verbo de la petición
$verbo = $_SERVER['REQUEST_METHOD'];
//Es posible que nos manden un id (lo usamos en GET, PUT y DELETE
$id = filter_input(INPUT_GET, 'id');
//$u = filter_input(INPUT_POST, 'email');
//$p = filter_input(INPUT_POST, 'pass');
$data = file_get_contents("php://input");
$raw = json_decode($data);

//var_dump($raw);

//LLamamos controlador a la tabla a la que vamos a acceder
$controller = filter_input(INPUT_GET, 'controller');
//Incluímos la posibilidad de mandar una acción distinta al CRUD
$accion = filter_input(INPUT_GET, 'accion');

//Recuperamos los datos del raw
$raw = file_get_contents("php://input");
//Los decodificamos de json a array de php
$datos = json_decode($raw);
//Creamos un objeto de la clase HTTP para devolver la respuesta
$http = new HTTP();

//El controlador nos indica la tabla a la que queremos acceder (p.ej. alumnos, centro...)
//EL CRUD va a funcionar para todas las tablas, así que vamos a cargar dinámicamente la clase que toque
//Y vamos a crear u na instancia de ese objeto. Como todas las clases comparten los mismos métodos
//Para cargar y guardar el CRUD será el mismo para todas
//Si no existe la tabla que nos piden devolvemos un error:
if (empty($controller) || !file_exists($controller . ".php")) {
    $http->setHttpHeaders(400, new Response("Bad request: Controlador no existe"));
    die();
}

//Si existe la tabla creamos un objeto
require $controller . ".php";
$objeto = new $controller;

//Miramos qué verbo nos han enviado para actuar en 
switch ($verbo) {
    case 'GET':
        //Si nos mandan la acción buscar realizamos la búsqueda
        //Si nos hacen una petición GET podemos tener dos casos, que nos pidan un id concreto o no
        //En el primer caso buscamos ese registro concreto, en el segundo caso devolvemos todo
        if ($accion == "usersubscriptions") {
            $datos = $objeto->loadUserSubscriptions($id);
            $http->setHttpHeaders(200, new Response("Lista $controller", $datos));
            break;
        }   
        if($accion == "checkToken") {
            $headers = apache_request_headers();
            if(isset($headers["authorization"]) && $headers["authorization"] !=""){
                $token_recibido=$headers["authorization"];    
                $datos = $objeto->getDataToken($token_recibido);
                $http->setHttpHeaders(200, new Response("$token_recibido", $datos));
            } else {
                $http->setHttpHeaders(400, new Response("No hay token"));
            }
        }
        elseif (empty($id)) {
            //Necesitamos crear la función loadAll en la clase o bien usar el getALL
            $datos = $objeto->loadAll();
            $http->setHttpHeaders(200, new Response("Lista $controller", $datos));
        } else {
            //Cargamos ese registro en concreto
            $objeto->load($id);
            //Necesitamos crear una función serialize en la tabla que nos devuelva un array con los datos
            $http->setHttpHeaders(200, new Response("Lista $controller", $objeto->serialize()));
        }
        break;
    case 'POST':
        if ($accion == "login") {
            $datos = file_get_contents("php://input");
                $raw = json_decode($datos);
                $datos = $objeto->login($raw->email, $raw->pass);
            if ($datos[0]["userType"] == 0 || $datos[0]["userType"] == 1) {
                if (!empty($datos)) {
                    $objeto = new $controller;
                    if($datos[0]["userType"] == 0) {
                        $objeto->load($datos[0]["userID"]);
                    } elseif ($datos[0]["userType"] == 1) {
                        $objeto->load($datos[0]["userID"]);
                    }
                    $objeto->setToken(bin2hex(random_bytes(100)));
                    $objeto->save();
                    $http->setHttpHeaders(200, new Response("Login correcto", $objeto->serialize()));
                } else {
                    $http->setHttpHeaders(400, new Response("Datos vacíos $controller", $datos));
                }
            } else {
                $http->setHttpHeaders(400, new Response("El controlador no contiene la función login", $controller));
            }
        } else {
        //Ponemos los valores en cada campo del objeto
        foreach ($datos as $c => $v) {
            $objeto->$c = $v;
        }
        //Y lo guardamos
        $objeto->save();
    }
        //echo '{"status":"ok"}';

        break;
    case 'PUT':
        //El put es igual que el POST, pero primero comprobamos que exista el id y cargamos el objeto
        if (empty($id)) {
            $http->setHttpHeaders(400, new Response("Bad request"));
            die();
        }
        //Cargar el objeto
        $objeto->load($id);
        //Lo mismo que POST

        foreach ($datos as $c => $v) {
            $objeto->$c = $v;
        }
        $objeto->save();


        break;
    case 'DELETE':
        //COmprobamos que exista el id
        if (empty($id)) {
            $http->setHttpHeaders(400, new Response("Bad request"));
            die();
        }
        //Cargamos y borramos
        $objeto->load($id);
        $objeto->delete();
        break;
    default:
        $http->setHttpHeaders(400, new Response("Bad request: Verbo incorrecto"));
}