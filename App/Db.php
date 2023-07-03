<?php

namespace App;

use PDO;
use PDOException;

class Db{
    private static $db;

    static function getDb(){
        if(!self::$db){
            try{
                $config = file_get_contents('../App/config.json');
                $config = json_decode($config);
                self::$db = new PDO("mysql:host=" . $config->host . ";dbname=". $config->dbname, $config->username, $config->password);
            }catch(PDOException $e){
                echo 'le fichier pose problème, erreur : '. $e->getMessage();
            }
        }
        return self::$db;
    }
}