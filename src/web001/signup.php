<?php
include('user-db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = '6LfJtB8jAAAAAOt2n0-w1fQa_2D0orVuYrpNgttK';
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
          . $secret_key . '&response=' . $recaptcha;
    $response = file_get_contents($url);
    $response = json_decode($response);
    if ($response->success == false) {
        echo '<script>alert("Error in Google reCAPTACHA")</script>';
    }
    else if (UserModel::check($username)) {
        print '<script>alert("Duplicate username, try again");</script>';
        print '<script>window.location.assign("index.php?page=signup");</script>';
    } else {
        UserModel::signup($username, $password);
        print '<script>alert("Succesfully register");</script>';
        print '<script>window.location.assign("index.php?page=login");</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="/?page=home" style="margin-left:20px; ">
            <b style="font-size: 200%">CTF101 - Signup</b>
        </a>
    </nav>
    <script src=
        "https://www.google.com/recaptcha/api.js" async defer>
    </script>
</head>

<body style="background-color:beige">
</body>
<section class="vh-100 gradient-custom" style="margin-top: -40px;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form action="/?page=signup" method="POST">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                                <br>
                                <div class="form-outline form-white mb-4">
                                    <input type="" id="typeEmailX" class="form-control form-control-lg" name="username" />
                                    <label class="form-label">Username</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6LfJtB8jAAAAAKR9CRoG6_Pas4Pq7_Fz2vX61nPz">
                                </div>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>
                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</html>