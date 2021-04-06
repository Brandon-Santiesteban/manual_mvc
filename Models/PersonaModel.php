<?php
class PersonaModel extends Connection
{
    function insertarContacto($nombre, $fijo, $celular)
    {
        $table = "persona";
        $values = "";
        $params = array();
        if ($fijo != "" && $celular != "") {
            $values = "(pers_nombre, pers_fijo, pers_celular) VALUES (:nombre, :fijo, :celular)";
            $params = array(
                "nombre" => $nombre,
                "fijo" => $fijo,
                "celular" => $celular
            );
        } else if ($fijo != "") {
            $values = "(pers_nombre, pers_fijo) 
                        VALUES (:nombre, :fijo)";
            $params = array(
                "nombre" => $nombre,
                "fijo" => $fijo
            );
        } else {
            $values = "(pers_nombre, pers_celular) 
                        VALUES (:nombre, :celular)";
            $params = array(
                "nombre" => $nombre,
                "celular" => $celular
            );
        }
        $data = $this->db->insert($table, $values, $params);
        if ($data === true)
            return 1;
        else
            return $data;
    }
    
    function seleccionarTodosContactos()
    {
        $columns = "*";
        $tables = "persona";
        $where = "";
        $params = "";
        return $this->db->select($columns, $tables, $where, $params);
    }
}
