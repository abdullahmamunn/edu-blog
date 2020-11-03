<?php
        session_start();
         include_once "../vendor/autoload.php";
         $logout = new App\classes\AdminLogin;
         $create_category = new App\classes\Category;
         $create_category->createCategory($_POST);

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
            <h1 class="mt-4">Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>

            <div class="row">
                <div class="col-xl-6 col-md-6 mr-auto" style="margin-left: 250px;">
                    <div class="card mb-4">
                        <div class="card-header">add category</div>
                          <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Category Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="category_name" placeholder="Category name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="description" placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3">Status </label>
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
