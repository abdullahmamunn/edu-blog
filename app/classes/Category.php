<?php


namespace app\classes;
use App\classes\Database;


class Category
{
    public function createCategory($data)
    {
        if(isset($_POST['btn']))
        {
            $category_name = $data['category_name'];
            $category_description = $data['description'];
            $category_status = $data['status'];
            $query = "insert into categories(category_name,description,status) 
                      values('$category_name','$category_description','$category_status')";
            if(mysqli_query(Database::databaseConnection(),$query)) {
                header('Location:manage-category.php');
            }
            else{
                die('query problem'.mysqli_error(Database::databaseConnection()));
            }


        }
    }

    public function readCategory()
    {
        $sql = "select * from categories order by id desc";
        if(mysqli_query(Database::databaseConnection(),$sql)){
            $result = mysqli_query(Database::databaseConnection(),$sql);
            return $result;
        }
        else{
            die('Connection error'.mysqli_error(Database::databaseConnection()));
        }
    }

    public function deleteCategory($id)
    {
        $sql = "delete from categories where id = '$id'";
        if(mysqli_query(Database::databaseConnection(),$sql))
        {
            $msg = "Data deleted Successfully!";
            return $msg;
        }
        else{
            die("Connection problem".mysqli_error(Database::databaseConnection()));
        }
    }

    public function readSingleData($id)
    {
        $sql = "select * from categories where id = '$id'";
        if(mysqli_query(Database::databaseConnection(),$sql))
        {
            $single_data = mysqli_query(Database::databaseConnection(),$sql);
            return $single_data;
        }
    }

    public function singleDataUpdate($data,$id)
    {

        $sql = "update categories 
        set category_name = '$data[category_name]',
        description = '$data[description]',
        status = '$data[status]'
        where id = '$id'";
        if(mysqli_query(Database::databaseConnection(),$sql))
        {
            header('Location:manage-category.php?msg=true');
        }
        else{
            die("query problem".mysqli_error(Database::databaseConnection()));
        }

    }
}