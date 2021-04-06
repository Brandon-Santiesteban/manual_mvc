<?php
class Controllers
{
    function __construct()
    {
        //Creamos una instancia de las views para 
        //acceder al metodo render
        $this->view = new Views();
        $this->loadClassModels();
    }

    private function loadClassModels()
    {
        // obtenemos el nombre de la clase controladora
        // determianndo que el modelo perteneciente a este
        // controlador siempre debera tener al final la palabra "Model"
        $model = get_class($this) . "Model";
        //creamos una cadena de texto con la ruta
        //que debe existir en la clase modelo perteneciente a dicho controlador
        $path = "Models/" . $model . ".php";
        if (file_exists($path)) { //verificamos que exista el archivo
            require $path; //para poder requerirlo
            $this->model = new $model(); //y crear una instancia de el
        }
    }
}
