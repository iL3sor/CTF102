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
    include($page.'.php');
?>