        <?php
        session_start();
        include_once "../vendor/autoload.php";
        $logout = new App\classes\AdminLogin;
       // $create_category = new App\classes\Category;
       // $create_category->createCategory($_POST);

        $showMessage = '';
        $id = $_GET['id'];
        if(isset($_GET['id']))
        {

            $read_single_data = new App\classes\Category;
            $single_data = $read_single_data->readSingleData($id);
            $row = mysqli_fetch_assoc($single_data);
            //echo $row['status'];

        }
        $single_data_update = new App\classes\Category;
        if(isset($_POST['btn'])){
//                          $id = $_GET['id'];
            $single_data_update->singleDataUpdate($_POST,$id);
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
                    <h1 class="mt-4">Update Category</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">update category</li>
                    </ol>

                    <h3 class="text-success">
                    </h3>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mr-auto" style="margin-left: 250px;">
                            <div class="card mb-4">
                                <div class="card-header">add category</div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label for="" class="col-form-label col-md-3">Category Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="category_name" value="<?php echo $row['category_name'];?>" placeholder="Category name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-form-label col-md-3">Description</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="description" value="<?php echo $row['description']?>" placeholder="Description">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-form-label col-md-3">Status </label>
                                            <div class="col-md-9">
                                                <input type="radio" name="status" <?php echo $row['status'] == 1 ? 'checked' : '';?> value="1"> Published
                                                <input type="radio" name="status" <?php echo $row['status'] == 0 ? 'checked' : '';?> value="0"> Unpublished
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
