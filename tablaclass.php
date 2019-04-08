<?php

/**
 * Description of tablaclass
 *
 * @author dam
 */
abstract class Tabla {

    static $server = "localhost";
    static $user = "root";
    static $password = "";
    static $database = "AOM";
    protected $table; //Nombre de la tabla
    protected $idField; //Nombre del campo clave
    protected $fields;  //Array con los nombres de los campos (opcional)
    protected $showFields; //Array con los nombres de los campos a mostrar en determinadas consultas (opcional)
    static protected $conn;

    /**
     * El constructor necesita el nombre de la tabla y el nombre del campo clave
     * Opcionalmente podemos indicar los campos que tiene la tabla y aquellos que queremos mostrar
     * Cuando se haga una selección
     * @param type $table
     * @param type $idField
     * @param type $fields
     * @param type $showFields
     */
    public function __construct($table, $idField, $fields = "", $showFields = "") {
        $this->table = $table;
        $this->idField = $idField;
        $this->fields = $fields;
        $this->showFields = $showFields;
        self::conectar();
    }

    /**
     * Función de conexión
     */
    static function conectar() {
        try {
            self::$conn = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$database, self::$user, self::$password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Getter de las propiedades
     * @param type $name
     * @return type
     */
    function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    /**
     * Setter de las propiedades
     * @param type $name
     * @param type $value
     * @throws Exception
     */
    function __set($name, $value) {
        if (property_exists($this, $name) && !empty($value)) {
            $this->$name = $value;
        } else {
            throw new Exception("Error: datos incorrectos");
        }
    }

    /**
     * Lo mismo que la anterior pero usando prepare
     * @param type $condicion
     * @param type $completo
     * @return type
     */
    function getAll($condicion = [], $completo = true) {
       // echo "getAll;";
       // var_dump ($condicion);
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

    /**
     * Esta función nos devuelve el elemento de la tabla que tenga este id
     * @param int $id El id de la fila
     */
    protected function getById($id) {
        $res = self::$conn->query("select * from " . $this->table . " where "
                . $this->idField . "=" . $id);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Elimina el registro que tenga el id que le pasamos
     * @param int $id
     */
    protected function deleteById($id) {
        try {
            self::$conn->exec("delete from " . $this->table . " where "
                    . $this->idField . "=" . $id);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Esta función toma como parámetro un array asociativo y nos inserta en la tabla
     * un registro donde la clave del array hace referencia al campo de la tabla y
     * el valor del array al valor de la tabla.
     * ejemplo para la tabla actor: insert(['first_name'=>'Ana','last_name'=>'Pi'])
     * @param type $valores
     */
    protected function insert($valores) {
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

    /**
     * Modifica el elemento de la base de datos con el id que pasamos
     * Con los valores del array asociativo
     * @param int $id Id del elemento a modificar
     * @param array $valores Array asociativo con los valores a modificar
     */
    protected function update($id, $valores) {
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

    abstract function load($id);

    abstract function save();

    abstract function delete();

    /*     * ************************************************************************** */

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

    function login($user, $pass) {
        $u = $this->getAll(['email' => $user, 'pass' => $pass]);
        return !empty($u);
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

    function serialize() {
        return $this->valores();
    }

}