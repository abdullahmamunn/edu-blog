<?php
require_once "../vendor/autoload.php";
session_start();
if(isset($_SESSION['name']) && isset($_SESSION['id']))
{
    header('Location:dashboard.php');
}
$login = new App\classes\AdminLogin;
$msg = "";
if(isset($_POST['btn']))
{
   $msg = $login->login($_POST);

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin area</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/heroic-features.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top: 120px;margin-left: 250px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i><h2 style="text-align: center;">Admin login</h2></i>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" name="btn" class="btn btn-primary btn-block">Sign in</button>
                                <br>
                                <h5 class="text-danger">
                                    <?php
                                         echo $msg;
                                    ?>
                                </h5>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/jquery/jquery.js"></script>
<script src="../assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>
