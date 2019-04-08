<?php
require_once 'tablaClass.php';

class languageClass extends Tabla {

    private $languageID;
    private $languageName;
    private $num_fields = 2;

    function __construct() {
        $show = ["languageName"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("Languages", "languageID", $fields, $show);
    }

    function getLanguageID() {
        return $this->languageID;
    }

    function getLanguageName() {
        return $this->languageName;
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
        $language = $this->getById($id);
        if (!empty($language)) {
            $this->languageID = $id;
            $this->languageName = $language['languageName'];
        } else {
            throw new Exception("No existe ese idioma");
        }
    }

    function delete() {
        if (!empty($this->languageID)) {
            $this->deleteById($this->languageID);
            $this->languageID = null;
            $this->languageName = null;
        } else {
            throw new Exception("No hay ningún idioma para borrar");
        }
    }

    private function valores() {
        $valores = array_map(function($v) {
            return $this->$v;
        }, $this->fields);
        return array_combine($this->fields, $valores);
    }

    function save() {
        $languages = $this->valores();
        unset($languages['languageID']);
        if (empty($this->languageID)) {
            $this->insert($languages);
            $this->languageID = self::$conn->lastInsertId();
        } else {
            $this->update($this->languageID, $languages);
        }
    }

    function loadAll() {
        return $this->getAll();
    }

    function serialize() {
        return $this->valores();
    }

}
