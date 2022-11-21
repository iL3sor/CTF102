

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge CTF </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="/?page=home" style="margin-left:20px; ">
            <b style="font-size: 200%">CTF101 - Home</b>
        </a>
        <div style="margin-right: 20px ;">
            <?php
            if (@$_SESSION['user']) {
                echo '
        <button type="button" class="btn btn-outline-secondary" style="margin-right: 10px ; color:white; width: 120px;" onclick="logout()">Logout</button>';
            } else {
                echo '
        <button type="button" class="btn btn-outline-secondary" style="margin-right: 10px ; color:white; width: 120px;" onclick="signup()">Sign up</button>      
            <button type="button" class="btn btn-outline-secondary" style="margin-right: 10px ; color:white; width: 120px;" onclick="login()">Login</button>
        ';
            }
            ?>
        </div>
    </nav>
</head>

<body style="background-color:beige">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6" style="background-color: #e6c3c3; margin-top:80px; border-radius:1.5em;">
                    <?php
                    if (@$_SESSION['user']) {
                        echo ' 
                        <form action="/?page=home" method="post" enctype="multipart/form-data">
                            <label for="formFileDisabled" class="form-label">Upload File</label>
                            <input type="file" class="form-control" name="image" required />
                            <button type="submit" class="btn btn-secondary " style="margin-top:-65px; margin-left:105%">Upload</button>
                        </form>
                        ';
                    } else {
                        echo '
                        <div class="jumbotron">
                            <h1 class="display-4">Hello, hacker!</h1>
                            <p class="lead"><strong>This is a simple Website for upload your favorite file</strong>.</p>
                            <hr class="my-4">
                            <p> To use this service, you must login first</p>
                        </div>';
                    }
                    ?>
                    <strong id="noti" style="color: blue"></strong>
                </div>
            </div>
        </div>
</body>

</html>
<script>
    function login() {
        window.location = "/?page=login"
    }

    function logout() {
        window.location = "/?page=logout"
    }

    function signup() {
        window.location = "/?page=signup"
    }
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tmp = $_FILES['image']['name'];
    if(preg_match('/\.gif/', $tmp)!=1){
        print '<script>alert("Your file TYPE is not valid. Do it again");</script>';
        print '<script>window.location.assign("index.php?page=home");</script>';
    }
    $gif = imagecreatefromgif($_FILES['image']['tmp_name']);
    if (!$gif){
        print '<script>alert("Your file is NOT VALID. Do it again");</script>';
        print '<script>window.location.assign("index.php?page=home");</script>';
    }
    else{
        $filename = preg_replace("/[^A-Za-z0-9\.]/", "", $tmp);
        imagegif($gif, 'uploads/'.$filename);
        imagedestroy($gif);
        echo '<script>document.getElementById("noti").innerHTML = "Your image has been uploaded at: /uploads/'.$filename.'"</script>';
    }
}
?>