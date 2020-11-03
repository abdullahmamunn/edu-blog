<?php


namespace app\classes;
use App\classes\Database;
use Symfony\Component\VarDumper\Cloner\Data;


class Post
{
    public function postCategory()
    {
        $sql = "select * from categories where status = 1";
        if(mysqli_query(Database::databaseConnection(),$sql))
        {
            $result = mysqli_query(Database::databaseConnection(),$sql);
            return $result;
        }
    }

    public function createPost($data)
    {
        $file_name = $_FILES['image']['name'];
        $directory = "../assets/images/";
        $imageUrl = $directory.$file_name;
        $fileType = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_check = getimagesize($_FILES['image']['tmp_name']);
        $file_size = $_FILES['image']['size'];
        if($file_check)
        {
            if(file_exists($imageUrl))
            {
                echo "Image already exist";
            }
            else{
                if($file_size>104857600)
                {
                    echo "File size is too large! please select less than 1MB";
                }
                else{
                    if($fileType !='jpg' && $fileType !='JPG' && $fileType !='PNG' && $fileType !='png')
                    {
                        echo "Please select jpg or Png file";
                    }
                    else{
                        $sql = "INSERT INTO posts (category_id,post_title,description,short_description,image,status) 
                        VALUES ('$data[category_id]','$data[post_title]','$data[description]','$data[short_description]','$imageUrl','$data[status]')";

                        if(mysqli_query(Database::databaseConnection(),$sql)) {
                            move_uploaded_file($_FILES['image']['tmp_name'],$imageUrl);
                            header('Location:manage-post.php?msg=true');
                        }
                        else{
                            die("quesry problem".mysqli_error(Database::databaseConnection()));
                        }

                    }
                }
            }
        }
        else{
            echo "please choose a image file";
        }
    }


    public function managePost()
    {
        $sql_query = "SELECT 
                      c.category_name,
                      p.id,
                      p.category_id,
                      p.post_title,
                      p.description,
                      p.image,
                      p.status ,
                      p.created_at
                        FROM posts as p 
                        LEFT JOIN categories as c 
                        ON p.category_id = c.id 
                        ORDER BY p.created_at DESC";
                if(mysqli_query(Database::databaseConnection(),$sql_query)){
                    $data = mysqli_query(Database::databaseConnection(),$sql_query);
                    return $data;
                }
    }

    public function showSingleData($id)
    {
          $sql = "select * from posts where id = '$id'";
          if(mysqli_query(Database::databaseConnection(),$sql)){
              $result = mysqli_query(Database::databaseConnection(),$sql);
              return $result;
          }

    }

    public function updatePost($data)
    {

        $newImage = $_FILES['image']['name'];
        if($newImage)
        {
            $delete_photos = "select * from posts where id = '$data[post_id]'";
            $fetch_data = mysqli_query(Database::databaseConnection(),$delete_photos);
            $img = mysqli_fetch_assoc($fetch_data);
            unlink($img['image']);

            //$newImage = $_FILES['image']['name'];
            $directory = "../assets/images/";
            $imageUrl = $directory.$newImage;
            $fileType = pathinfo($newImage, PATHINFO_EXTENSION);
            $file_check = getimagesize($_FILES['image']['tmp_name']);
            $file_size = $_FILES['image']['size'];
            if($file_check)
            {
                if(file_exists($imageUrl))
                {
                    echo "Image already exist";
                }
                else{
                    if($file_size>104857600)
                    {
                        echo "File size is too large! please select less than 1MB";
                    }
                    else{
                        if($fileType !='jpg' && $fileType !='JPG' && $fileType !='PNG' && $fileType !='png')
                        {
                            echo "Please select jpg or Png file";
                        }
                        else{
                            move_uploaded_file($_FILES['image']['tmp_name'],$imageUrl);
                            $sql = "UPDATE posts SET
                              category_id='$data[category_id]',
                              post_title='$data[post_title]',
                              description='$data[description]',
                              short_description = '$data[short_description]',
                              image = '$imageUrl',
                              status='$data[status]'

                              WHERE id = '$data[post_id]'";

                            if(mysqli_query(Database::databaseConnection(),$sql)) {
                                header('Location:manage-post.php?msg=true');
                            }
                            else{
                                die("quesry problem".mysqli_error(Database::databaseConnection()));
                            }

                        }
                    }
                }
            }

        }
        else{
            $sql = "UPDATE posts SET
                      category_id='$data[category_id]',
                      post_title='$data[post_title]',
                      description='$data[description]',
                      short_description = '$data[short_description]',
                      status='$data[status]'

                      WHERE id = '$data[post_id]'";


            if(mysqli_query(Database::databaseConnection(),$sql)) {
                header('Location:manage-post.php?msg=true');
            }
        }
    }

    public function deletePost($id)
    {
        $delete_photos = "select * from posts where id = '$id'";
        $data = mysqli_query(Database::databaseConnection(),$delete_photos);
        $img = mysqli_fetch_assoc($data);
        unlink($img['image']);

        $sql = "DELETE FROM posts WHERE id = '$id'";
        if (mysqli_query(Database::databaseConnection(),$sql))
        {
            header('Location:manage-post.php');
        }
    }

    public function showblogPosts()
    {
        $sql = "select
        c.category_name,
        p.id,
        p.category_id,
        p.post_title,
        p.description,
        p.short_description,
        p.image,
        p.status,
        p.created_at
        from posts as p
        LEFT JOIN categories as c
        on p.category_id = c.id
        WHERE p.status = 1
        ORDER BY created_at DESC";
        if(mysqli_query(Database::databaseConnection(),$sql))
        {
            $result = mysqli_query(Database::databaseConnection(),$sql);
            return $result;
        }
    }

    public function showsingleblogPost($id)
    {
        $sql = "select
        c.category_name,
        p.id,
        p.category_id,
        p.post_title,
        p.description,
        p.short_description,
        p.image,
        p.status,
        p.created_at
        from posts as p
        LEFT JOIN categories as c
        on p.category_id = c.id
        WHERE p.id = '$id'
        ORDER BY created_at DESC";
        if(mysqli_query(Database::databaseConnection(),$sql))
        {
            $result = mysqli_query(Database::databaseConnection(),$sql);
            return $result;
        }
    }
    public function comments($id)
    {

           $post_id = $_GET['id'];
           $body = $_POST['comments'];

          $sql = "INSERT INTO comments(body,post_id) VALUES ('$body','$post_id')";
          if(mysqli_query(Database::databaseConnection(),$sql))
          {
            echo "Comments submit successfully!";
          }
    }
    public function showComments($post_id)
    {
        $sql = "SELECT c.id,c.post_id,c.body
                FROM comments as c
                LEFT JOIN posts as p
                ON c.post_id = p.id
                where c.post_id = '$post_id'
                ORDER BY c.id DESC";

       if(mysqli_query(Database::databaseConnection(),$sql)){
           $result = mysqli_query(Database::databaseConnection(),$sql);
           return $result;
       }
       else{
        die('query problem').mysqli_error(Database::databaseConnection());
       }
    }

}