<?php
class App{

    static $db = null;

    static function getDatabase(){
        if(!self::$db){
            self::$db = new Database('root', 'root', 'tuto');
        }
        return self::$db;
    }

    static function getAuth(){
        return new Auth(Session::getInstance(), ['restriction_msg' => 'Lol tu es bloqué !']);
    }

    static function redirect($page){
        header("Location: $page");
        exit();
    }

}