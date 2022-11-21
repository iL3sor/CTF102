<?php
    require('news-db.php');
    $title= $_POST['title'];
    $content = $_POST['content'];
    $author =$_SESSION['user'];
    newsModel::insert($title,$author,$content);
    print '<script>window.location.assign("/?page=home");</script>';
?>