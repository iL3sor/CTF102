<?php
class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          // self::$instance =  new PDO('mysql:host=127.0.0.1;dbname=ctf101', 'root', '');
          self::$instance =  new PDO('mysql:host=service-db;dbname=vcs', 'user1', 'password');
          self::$instance->exec("SET NAMES 'utf8'");
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
}