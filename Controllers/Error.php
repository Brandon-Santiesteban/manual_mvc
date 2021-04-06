<?php
    class Errors extends Controllers{
        function error(){
            $this->view->render($this, "Error404");
        }
    }
    