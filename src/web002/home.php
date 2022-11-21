<?php
    include('news-db.php');
    if($_GET['delete']){
        $check=newsModel::delete($_GET['delete']);
        if(!$check){
            print '<script>alert("Cannot delete, try again");</script>';
        }
        print '<script>window.location.assign("index.php?page=home");</script>';
    }
    
?>
<!-- ************** HTML CODE BOUNDARY ************** -->
<!DOCTYPE html>
<html lang="en">
<script>
    function logout() {
        document.location = "/?page=logout"
    }
</script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge CTF </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
    <div class="pos-f-t">
        <nav class="navbar navbar-dark bg-dark">
            <div class="d-flex justify-content-around">
                <div style="margin-left: 30px">
                    <h1 style="color:white; "><a href="/?page=home" style="color:white;text-decoration:none">CTF102</a>&nbsp;&nbsp;&nbsp;&nbsp;</h1>
                </div>
                <?php
                    if (@$_SESSION['user']) {
                        echo "
                    <div class='p-2'><button type='button' class='btn btn-light' onclick='logout()' style='width:100px; background-color:#fc5603'>Logout</button></div>
                    ";
                    }
                    ?>
            </div>
        </nav>
        <div class="d-flex justify-content-center"></div>
    </div>
</head>
<!-- ************** HTML CODE BOUNDARY ************** -->

<body>
    <?php
    if (!$_SESSION['user']) {
        echo "<section class='h-100 gradient-form' style='background-color:#6f7082'>
        <div class='container py-5 h-100'>
            <div class='row d-flex justify-content-center align-items-center h-100'>
                <div class='col-xl-10'>
                    <div class='card rounded-3 text-black'>
                        <div class='row g-0'>
                            <div class='col-lg-6'>
                                <div class='card-body p-md-5 mx-md-4'>
    
                                    <div class='text-center'>
                                        <h4 class='mt-1 mb-5 pb-1'>Welcome to this challenge</h4>
                                    </div>
    
                                    <form action='/?page=login' method='post'>
                                        <p>Please login to your account</p>
    
                                        <div class='form-outline mb-4'>
                                            <input type='text' id='form2Example11' class='form-control' placeholder='Username here' name='username' />
                                            <label class='form-label' for='form2Example11'>Username</label>
                                        </div>
    
                                        <div class='form-outline mb-4'>
                                            <input type='password' id='form2Example22' class='form-control' name='password' />
                                            <label class='form-label' for='form2Example22'>Password</label>
                                        </div>
    
                                        <div class='text-center pt-1 mb-5 pb-1'>
                                            <button class='btn btn-primary btn-block fa-lg gradient-custom-2 mb-3' type='submit' style='width: 200px'>Log
                                                in</button>
                                        </div>
    
                                    </form>
    
                                </div>
                            </div>
                            <div class='col-lg-6 d-flex align-items-center gradient-custom-2'>
                                <div class='text-white px-3 py-4 p-md-5 mx-md-4'>
                                    <h4 class='mb-4'>We are more than just a company</h4>
                                    <p class='small mb-0'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>";
    }
    else{
        echo "
        <div class='d-flex justify-content-around' style='margin-top:70px'>
        <div class='p-2'>";
        if(@$_SESSION['user']){
            $news = newsModel::get($_SESSION['user']);
        }
        if(@$news){
            $html='';
            foreach($news as $n){
                $html.="<div class='alert alert-success' style='word-wrap: break-word; width:700px; margin-left:50px'>
                <strong>".$n[1].": </strong>"."[".$n[2]."] at ".$n[4]."<div><p>".$n[3]."</p></div>"."<span class='isadmin' id='".$n[0]."'></span></div> ";
            }
            echo $html;
        }
        else{
            echo "            
            <div class='alert alert-danger' style='width:700px; word-wrap: break-word;'>
            <strong>System:</strong> No news : )))  in your box!
            </div>";
        }
        echo "</div>
        <div></div>
        <div class='p-2' style='margin-left:100px;'>
         <form action='/?page=news' method='POST'>
         <div class='form-group'>
         <label for='exampleFormControlTextarea3'><strong style='color:red'>News Title</strong></label>
         <input class='form-control' id='exampleFormControlTextarea3' style='width:500px;' name='title'>
         <label for='exampleFormControlTextarea3'><strong style='color:red'>News Content</strong></label>
         <textarea class='form-control' id='exampleFormControlTextarea3' rows='15' style='width:500px;' name='content'></textarea>
         <div class='d-flex justify-content-between'>
         <div class='p-2'></div>
         <div class='p-2'><button type='submit' class='btn btn-secondary btn-lg' style='margin-top:15px'>Public news</button></div>
         <div class='p-2'></div>
         </div>
         </div>
         </form>
        </div>
    </div>
    ";
    }
    if(@$_SESSION['user']){
        print "<script>
        arr = document.getElementsByClassName('isadmin');
        for(var i = 0 ;i < arr.length;i++){
            idd=arr[i].id;
            arr[i].innerHTML='&nbsp;&nbsp;<button style=\"background-color:#7b68fc; border-radius:1.5em\" onclick=\"del(idd)\">Delete News</button>&nbsp;&nbsp;&nbsp;<button style=\"background-color:#11cf14; border-radius:1.5em\" onclick=\"edit(idd)\">&nbsp; Edit News &nbsp;</button>';}
        function del(data){
            document.location='/?page=home&delete='+data;
        }
        function edit(data){
            document.location='/?page=edit&news='+data;
        }
        </script>";
    }
    ?>
</body>
<!-- ************** HTML CODE BOUNDARY ************** -->

