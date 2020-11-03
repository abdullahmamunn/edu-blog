<?php
session_start();
include_once "../vendor/autoload.php";
$logout = new App\classes\AdminLogin;


$category = new App\classes\Post;
$result = $category->postCategory();

$msg = "";
if (isset($_POST['btn'])) {
   $msg = $category->createPost($_POST);
}


if ($_SESSION['id']==null OR $_SESSION['name']==null)
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
            <h1 class="mt-4">Create Post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Create Post</li>
            </ol>
            <h3 class="text-danger">
                <?php echo $msg; ?>
            </h3>
            <div class="row">
                <div class="col-xl-7 col-md-6 mr-auto" style="margin-left: 250px;">
                    <div class="card mb-4">
                        <div class="card-header">Create Post</div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Course Category</label>
                                    <div class="col-md-9">
                                        <select name="category_id" id="" class="form-control">
                                            <option value="">----Select Category----</option>
                                            <?php
                                               while ($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Video Title</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="video_title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Upload Video</label>
                                    <div class="col-md-9">
                                        <input type="file" name="file_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <input type="radio" name="status" value="1"> Published
                                        <input type="radio" name="status" value="0"> Unpublished
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3"></label>
                                    <div class="col-md-9">
                                        <input class="form-control btn btn-block btn-success" type="submit" value="Submit" name="btn">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </main>

    <?php
    include_once "../include/footer.php";
    ?>

