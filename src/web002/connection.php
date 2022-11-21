<?php
class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          // self::$instance =  new PDO('mysql:host=127.0.0.1;dbname=ctf102', 'root', '');
          self::$instance =  new PDO('mysql:host=service-db;dbname=vcs2', 'user2', 'password');
          self::$instance->exec("SET NAMES 'utf8'");
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
}