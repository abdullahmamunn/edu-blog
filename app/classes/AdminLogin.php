<?php


namespace app\classes;
use App\classes\Database;


class AdminLogin
{
    public function login($data)
    {
//        echo "<pre>";
//        print_r($data);
        $admin_email = $data['email'];
        $admin_pass = md5($data['password']);
//        echo $admin_email."<br>".$admin_pass;

        $sql = "select * from admins";
       if(mysqli_query(Database::databaseConnection(),$sql))
       {
           $admin_data = mysqli_query(Database::databaseConnection(),$sql);
           $admin = mysqli_fetch_assoc($admin_data);
           if($admin_email == $admin['email'] && $admin_pass == $admin['password'])
           {
               session_start();
               $_SESSION['id'] = $admin['id'];
               $_SESSION['name'] = $admin['name'];
               header('Location:dashboard.php');
           }
           else{
               $msg = "Please use valid email and password";
               return $msg;
           }

       }
       else{
           die("connection problem".mysqli_error(Database::databaseConnection()));
       }

     }

    public function adminLogout()
    {
        session_start();
          unset($_SESSION['id']);
          unset($_SESSION['name']);
          header('Location:./index.php');
    }

}