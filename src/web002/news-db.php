<?php
include('connection.php');
class newsModel
{
  public $title;
  public $author;
  public $content;
  public $date_created;

  function __construct( $title, $author,$content,$date_created)
  {
    $this->title = $title;
    $this->author = $author;
    $this->content = $content;
    $this->date_created = $date_created;
  }

  static function insert($title, $author,$content)
  {
    $db = DB::getInstance();
    if(preg_match("/union|\||concat/i" ,$title))
      die("NO HACK");
    if(preg_match("/union|\||concat/i" ,$content))
      die("NO HACK");
    $db->query("INSERT INTO news (`title`, `author`, `date_created`,`content`) VALUES ('$title','$author',SYSDATE(),'$content')");
  }
  static function get($username){
    $list = [];
    $db = DB::getInstance();
    $req = $db->prepare("SELECT * FROM news WHERE author=?");
    $req->execute([$username]);
    foreach ($req->fetchAll() as $item) {
      array_push($list,$item);
    }
    return $list;
  }
  
  static function edit($title, $author,$content){
    $db = DB::getInstance();
    $req = $db->prepare("UPDATE news SET `title`=? , `author`=?, `content`=?, `date_created`=SYSDATE() ");
    $req->execute([$title, $author,$content]);
    $check = true;
    return $check;
  }
  static function delete($id)
  {
    $db = DB::getInstance();
    $query = $db->prepare("DELETE FROM news WHERE id = ? ");
    $query->execute([$id]);
    $check = true;
    return $check;
  }
  static function update($id){
    $list = [];
    $db = DB::getInstance();
    $req = $db->prepare("SELECT * FROM news WHERE `id` = ?");
    $req->execute([$id]);
    foreach ($req->fetchAll() as $item) {
      array_push($list,$item);
    }
    return $list;
  }
}