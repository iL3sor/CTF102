<?php
require('news-db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['user'];
    $check = newsModel::edit($title, $author ,$content);
    if(!$check){
        print '<script>alert("Cannot update, try again");</script>';
    }
    print '<script>window.location.assign("index.php?page=home");</script>';
}
?>
<!-- ************** HTML CODE BOUNDARY ************** -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge CTF </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer>
    </script>
    <div class="pos-f-t">
        <nav class="navbar navbar-dark bg-dark">
            <div style="margin-left: 30px">
                <h1 style="color:white; "><a href="/?page=home" style="color:white;text-decoration:none">CTF102</a>&nbsp;&nbsp;&nbsp;&nbsp;</h1>
            </div>

        </nav>
        <div class="d-flex justify-content-center"></div>
    </div>
</head>
<!-- ************** HTML CODE BOUNDARY ************** -->

<body style="background-color:#ffffff">
    <?php
    $id = $_GET['news'];
    $res = newsModel::update($id);
    $res = $res[0];
    echo "
    <div class='d-flex justify-content-between'>
    <div class='p-2' > </div>
    <div class='p-2' style='margin-left:100px;'>
        <form action='/?page=edit' method='POST'>
        <div class='form-group'>
        <label for='exampleFormControlTextarea3'><strong style='color:red'>News Title</strong></label>
        <input class='form-control' id='exampleFormControlTextarea3' style='width:500px;' name='title' value='$res[1]' >
        <label for='exampleFormControlTextarea3'><strong style='color:red'>News Content</strong></label>
        <textarea class='form-control' id='exampleFormControlTextarea3' rows='10' style='width:500px;' name='content'>$res[3]</textarea>
        <div class='p-2'><button type='submit' class='btn btn-secondary btn-lg' style='margin-top:15px'>Update news</button></div>
        </div>
        </form>
    </div>
    <div class='p-2' > </div>
    </div>";
    ?>
</body>
