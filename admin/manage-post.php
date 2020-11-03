<?php
session_start();
include_once "../vendor/autoload.php";
$logout = new App\classes\AdminLogin;
$managePost = new App\classes\Post;
$result = $managePost->managePost();

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
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="text-success">
                        <?php
                        if(isset($_GET['msg']) && $_GET['msg']==true)
                        {
                            echo "Data Save successfully";
                        }

                        ?>
                    </h3>
                    <h3 class="text-danger">
                        <?php
                        if(isset($_GET['with_msg']) && $_GET['with_msg']==true)
                            echo "Data deleted successfully!";
                        ?>
                    </h3>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Post Title</th>
                                <th>Status</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Post Title</th>
                                <th>Status</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            $i=1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?php echo $row['post_title']; ?></td>
                                    <td><?php
                                        if($row['status']==1)
                                        {
                                            echo "published";
                                        }
                                        else{
                                            echo "Not published";
                                        }
                                        ?>

                                    </td>
                                    <td><?php echo $row['created_at'];?></td>
                                    <td>
                                        <a href="post-view.php?id=<?php echo $row['id'];?>" class="btn btn-info">View</a>
                                        <a href="edit-post.php?id=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                                        <a href="delete-post.php?id=<?php echo $row['id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once "../include/footer.php";
    ?>

