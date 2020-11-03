<?php


namespace app\classes;


class Database
{
    public function databaseConnection()
    {
        $server = "localhost";
        $user = "root";
        $password = "";
        $db_name = "blog";
        $link = mysqli_connect($server,$user,$password,$db_name);
        return $link;
    }
}