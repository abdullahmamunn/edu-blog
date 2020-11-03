<?php
   session_start();
   include_once "../vendor/autoload.php";
   $logout = new App\classes\AdminLogin();
   $postView = new App\classes\Post();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $result = $postView->viewPost($id);

    }
   if($_SESSION['name'] == null)
   {
     header('Location:index.php');
   }
    if(isset($_GET['logout']))
    {
      $logout->adminLogout();
    }
?>
<?php

  include_once "../include/header.php";
?>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
       <h1 class="mt-4">View Post</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <?php

        ?>
        <div class="card mt-4">
            <div class="card-header">
                <h2><?php echo $result['video_title'];?></h2>
            </div>
            <div class="card-body">
                <h3>Description</h3>
                <p><?php echo $result['description'];?></p>
                <img src="<?php echo $result['file_name'];?>" alt="" height="250" width="250">
            </div>
        </div>
    </div>
</main>
<?php
  include_once "../include/footer.php";
?>
