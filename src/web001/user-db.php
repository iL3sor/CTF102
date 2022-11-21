<?php
include('connection.php');
class UserModel
{
  public $username;
  public $password;
  function __construct( $username, $password)
  {
    $this->username = $username;
    $this->password = $password;
  }

  static function check($username)
  {
    $list = array();
    $db = DB::getInstance();
    $req = $db->prepare('SELECT `username` FROM users WHERE username = ?');
    $req->execute([$username]);
    foreach ($req->fetchAll() as $item) {
      array_push($list,$item);
    }
    return $list;
  }
  static function login($user, $password)
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->prepare("SELECT * FROM users WHERE username= ? AND password = ? ");
    $req->execute([$user, $password]);
    foreach ($req->fetchAll() as $item) {
      $list[] = new UserModel($item[0] ,$item[1]);
    }
    return $list;
  }
  static function signup($username, $password)
  {
    $db = DB::getInstance();
    $query = $db->prepare("INSERT INTO users (`username`, `password`) VALUES (?,?)");
    $query->execute([$username,$password]);
  }
}