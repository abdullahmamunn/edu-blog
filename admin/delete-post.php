<?php
include_once "../vendor/autoload.php";
$deletePost = new App\classes\Post();
if(isset($_GET['id']))
{   $id = $_GET['id'];
    $deletePost->deletePost($id);
}
