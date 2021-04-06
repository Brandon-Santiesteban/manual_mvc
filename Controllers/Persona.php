<?php   
    class Persona extends Controllers{
        function registrar(){
            $nombre = $_POST["pers_nombre"];
            $fijo = $_POST["tele_fijo"];
            $celular = $_POST["tele_celular"];
            $res = $this->model->insertarContacto($nombre,$fijo,$celular);
            echo $res;
        }

        function obtenerTodo(){
            $res = $this->model->seleccionarTodosContactos();
            if(is_array($res))
                echo json_encode($res);
            else
                echo $res;
        }
    }

