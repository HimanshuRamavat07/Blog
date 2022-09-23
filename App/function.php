<?php
class Blog extends Database {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function signin($email) {
        $query = "SELECT * FROM `author` WHERE author_email = '$email'";
        $res = $this->conn->query($query);
        return $res;
    }

    public function readPost($id=null) {
        $sql = "SELECT * FROM `post`";
        if($id) {
            $sql .=" WHERE `post_id`='$id'"; 
        }
        $query = $this->conn->query($sql);
        return $query;
    }

    public function filterPost($id) {
        $sql = "SELECT * FROM `post` INNER JOIN `category` ON category.cat_id=post.cat_id WHERE category.cat_id='$id'"; 
        
        $query = $this->conn->query($sql);
        return $query;
    }

    public function author($id) {
        $sql = "SELECT * FROM `author` INNER JOIN `post` ON post.author_id=author.author_id";
        if($id) {
            $sql .=" WHERE `post_id`='$id'";
        }
        // print_r($sql); exit();
        $query = $this->conn->query($sql);
        return $query;
    }

    public function catRead($id=null) {
        $sql = "SELECT * FROM  `category` ";
        if($id) {
            $sql = "SELECT * FROM  `category` INNER JOIN `post` ON post.cat_id=category.cat_id WHERE `post_id`=$id";
        }
        $query = $this->conn->query($sql);
        return $query;
    }
    public function count($id) {
        $sql = "SELECT * FROM  `post` WHERE `author_id` = '$id' ";
        $query = $this->conn->query($sql);
        return $query;
    }

    public function addPost($title,$content,$category,$fileName) {
        $sql = "INSERT INTO `post`(`author_id`, `title`, `description`, `image`, `cat_id`) VALUES('3','$title','$content','$fileName','$category')";
        $query = $this->conn->query($sql);
        // print_r($sql); exit();
        if($query) {
            echo "<script>alert('Post is created.');</script>";
            echo "<script>window.location.href = './index.php';</script>";
        }
        else {
            echo "not enterd";
        }
    }
}
?>