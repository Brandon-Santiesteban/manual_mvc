<?php
class Connection
{
    function __construct()
    {
        $this->db = new PDOManager("root", "", "db_contactos");
    }
}
