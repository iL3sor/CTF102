<?php
    session_start();
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    if(isset($_GET['page']) && $_GET['page']!=""){
        $page=$_GET['page'];
    }
    else{
        $page='home';
    }
    $whitelist= ['home','login','logout','news','edit'];
    if(in_array($page,$whitelist)){
        include($page.'.php');
    }
    else{
        include('errors.php');
    }
?>