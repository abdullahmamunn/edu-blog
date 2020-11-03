<?php
session_start();
include_once "../vendor/autoload.php";
$logout = new App\classes\AdminLogin;

$category = new App\classes\Post;
$result = $category->postCategory();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $single_result = $category->showSingleData($id);
    $single_row = mysqli_fetch_assoc($single_result);
}

if (isset($_POST['btn'])) {
    $category->updatePost($_POST);
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

            <div class="row">
                <div class="col-xl-10 col-md-6 mr-auto" style="margin-left: 80px;">
                    <div class="card mb-4">
                        <div class="card-header">Create Post</div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" name="eidtForm">
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Post Category</label>
                                    <div class="col-md-9">
                                        <select name="category_id" id="" class="form-control">
                                            <option value="">----Select Category----</option>
                                            <?php
                                                while ($row = mysqli_fetch_assoc($result)){
                                            ?>

                                                <option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option>

                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Title</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="post_title" value="<?php echo $single_row['post_title']; ?>">
                                        <input class="form-control" type="hidden" name="post_id" value="<?php echo $single_row['id']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Short Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="short_description" id="" cols="50" rows="3"><?php echo $single_row['short_description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="description" id="mytextarea" cols="30" rows="10" class="form-control"><?php echo $single_row['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Photos</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" accept="image/*">
                                        <img src="<?php echo $single_row['image']?>" alt="" height="100" width="100">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <input type="radio" name="status" <?php echo $single_row['status'] == 1 ? 'checked' : '';?> value="1"> Published
                                        <input type="radio" name="status" <?php echo $single_row['status'] == 0 ? 'checked' : '';?> value="0"> Unpublished
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3"></label>
                                    <div class="col-md-9">
                                        <input class="form-control btn btn-block btn-success" type="submit" value="Update Data" name="btn">
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
    <script>
        document.forms['eidtForm'].elements['category_id'].value = '<?php echo $single_row['category_id']?>';
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>

