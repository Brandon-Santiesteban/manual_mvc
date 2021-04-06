<?php
class PDOManager
{
    private $pdo;
    function __construct($user, $password, $dbname)
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=' . $dbname . ';charset=utf8',
                $user,
                $password,
                [
                    PDO::ATTR_EMULATE_PREPARES => FALSE,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            print "Error!:" . $e->getMessage();
            die();
        }
    }

    function select($columns, $tables, $where, $params)
    {
        try {
            if ($where == "")
                $query = "SELECT " . $columns . "FROM " . $tables;
            else
                $query = "SELECT " . $columns . "FROM " . $tables . "WHERE" . $where;

            $sth = $this->pdo->prepare($query);

            if ($where == "")
                $sth->execute();
            else
                $sth->execute($params);

            $response = $sth->fetchAll(PDO::FETCH_ASSOC);
            return array('results' => $response);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        $pdo = null;
    }

    function insert($table, $values, $params)
    {
        try {
            $query = "INSERT INTO " . $table . $values;
            $sth = $this->pdo->prepare($query);
            $sth->execute($params);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        $pdo = null;
    }

    function update($table, $columns, $newValues, $where, $params)
    {
        try {
            $query = "UPDATE " . $table . "SET";
            for ($i = 0; $i < count($columns); $i++) {
                $query .= $columns[$i] . "='" . $newValues[$i] . "'";
                if ((count($columns) - 1) != $i) $query .= ", ";
            }
            $query .= "WHERE" . $where;
            $sth = $this->pdo->prepare($query);
            $sth->execute($params);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        $pdo = null;
    }
    
    function delete($table, $where, $params)
    {
        try {
            $query = "DELETE FROM " . $table . "WHERE" . $where;
            $sth = $this->pdo->prepare($query);
            $sth->execute($params);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        $pdo = null;
    }
}
