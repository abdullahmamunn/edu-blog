<?php
session_start();
include_once "../vendor/autoload.php";
$logout = new App\classes\AdminLogin;

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
                        <?php
                          $read_category = new App\classes\Category;
                          $result = $read_category->readCategory();
                          $show_message = '';
                          if(isset($_GET['id']))
                          {
                              $show_message = $read_category->deleteCategory($_GET['id']);
                          }
                          if(isset($_GET['msg']) && $_GET['msg'] == true)
                          {
                              echo "<h3 class='text-success'>Data updated successfully!</h3>";
                          }
                        ?>
                        <h3 class="text-danger">
                            <?php
                                echo $show_message;
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
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
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
                                            <td><?php echo $row['description']; ?></td>
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
                                            <td>
                                                <a href="Edit.php?id=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                                                <a href="?id=<?php echo $row['id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</a>
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

