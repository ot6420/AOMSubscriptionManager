<?php

class bbdd {

    static $server = "localhost";
    static $user = "root";
    static $password = "";
    static $database = "AOM";
    private $table; //Nombre de la tabla
    private $idField; //Nombre del campo clave
    private $fields;  //Array con los nombres de los campos (opcional)
    private $showFields; //Array con los nombres de los campos a mostrar en determinadas consultas (opcional)
    static private $conn;

    public function __construct($table, $idField, $fields = "", $showFields = "") {
        $this->table = $table;
        $this->idField = $idField;
        $this->fields = $fields;
        $this->showFields = $showFields;
        self::conectar();
    }

    static function conectar() {
        try {
            self::$conn = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$database, self::$user, self::$password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    function __set($name, $value) {
        if (property_exists($this, $name) && !empty($value)) {
            $this->$name = $value;
        } else {
            throw new Exception("Error: datos incorrectos");
        }
    }

    function getAll($condicion = "", $completo = true) {
        $where = "";
        $campos = " * ";
        if (!empty($condicion)) {
//Aquí tendré que hacer algo!!!
            $where = " where 1=1 ";
            foreach ($condicion as $clave => $valor) {
                $where .= " and " . $clave . " = '" . $valor . "' ";
            }
        }
        if (!$completo && !empty($this->showFields)) {
            $campos = implode(",", $this->showFields);
        }
        $res = self::$conn->query("select $campos from  $this->table $where");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllPrepare($condicion = [], $completo = true) {
        $where = "";
        $campos = " * ";
        if (!empty($condicion)) {
            $where = " where " . join(" and ", array_map(function($v) {
                                return $v . "=:" . $v;
                            }, array_keys($condicion)));
        }
        if (!$completo && !empty($this->showFields)) {
            $campos = implode(",", $this->showFields);
        }
        $st = self::$conn->prepare("select $campos from " . $this->table . $where);
        $st->execute($condicion);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

//Función encargada de mostrar los datos de una ID en correcto
    function getById($id) {
        $res = self::$conn->query("select * from " . $this->table . " where "
                . $this->idField . "=" . $id);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

//Función que se encarga de añadir valores en cualquier tabla de la base de datos
    function insert($valores) {
        try {
            $campos = join(",", array_keys($valores));
            $parametros = ":" . join(",:", array_keys($valores));
            $sql = "insert into " . $this->table . "($campos) values ($parametros)";
            $st = self::$conn->prepare($sql);
            $st->execute($valores);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function update($id, $valores) {
        try {
//Creamos el cuerpo del select con la función array_map
            $campos = join(",", array_map(function($v) {
                        return $v . "=:" . $v;
                    }, array_keys($valores)));
            $sql = "update " . $this->table . " set " . $campos . " where "
                    . $this->idField . " = " . $id;
            $st = self::$conn->prepare($sql);
            $st->execute($valores);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function login($user, $pass) {

        $us = $this->getAll(['email' => $user, 'pass' => $pass]);
        return !empty($us);
    }

//Borrar un dato con un ID en concreto
    protected function deleteById($id) {
        try {
            self::$conn->exec("delete from " . $this->table . " where "
                    . $this->idField . "=" . $id);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

//Función que se encarga de insetar los datos obtenidos en una consulta a la tabla
    function toHTMLTable($tabla) {
        $res = "<table><tr>";
        foreach ($tabla[0] as $clave => $valor) {
            $res .= "<th>" . $clave . "</th>";
        }
        $res .= "</tr>";
        foreach ($tabla as $elemento) {
            $res .= "<tr>";
            foreach ($elemento as $clave => $valor) {
                $res .= "<td>" . $valor . "</td>";
            }
            $res .= "<tr>";
        }
        $res .= "</table>";
        return $res;
    }

}
