<?php
class Views {
    function render($controller, $view) {
        //Obtenemos el nombre de la clase que nos llega como parametro
        $controller = get_class($controller);
        //Luego requerimos el archivo html para que la vista responda
        require  VW . $controller . "/" . $view . ".html";
    }
}