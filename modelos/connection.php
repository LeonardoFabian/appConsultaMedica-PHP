<?php

// Ramon L. Fabian
// 2019-7407

include("configuration.php");

class Conexion{

    static public function conectar(){
        $link = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

        $link -> exec("set names utf8");

        return $link;
    }
}