<?php
class Blog extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function signin($email)
    {
        $query = "SELECT * FROM `author` WHERE author_email = '$email'";
        $res = $this->conn->query($query);
        return $res;
    }

    public function readPost($id = null)
    {
        $sql = "SELECT * FROM `post`";
        if ($id) {
            $sql .= " WHERE `post_id`='$id'";
        }
        $query = $this->conn->query($sql);
        return $query;
    }

    public function filterPost($id)
    {
        $sql = "SELECT * FROM `post` INNER JOIN `category` ON category.cat_id=post.cat_id WHERE category.cat_id='$id'";

        $query = $this->conn->query($sql);
        return $query;
    }

    public function author($id)
    {
        $sql = "SELECT * FROM `author` WHERE `author_id`='$id'";
        $query = $this->conn->query($sql);
        return $query;
    }
    public function postAuthor($id)
    {
        $sql = "SELECT * FROM `author` INNER JOIN `post` ON post.author_id=author.author_id";
        if ($id) {
            $sql .= " WHERE `post_id`='$id'";
        }
        // print_r($sql); exit();
        $query = $this->conn->query($sql);
        return $query;
    }

    public function catagoryRead($id = null)
    {
        $sql = "SELECT * FROM  `category` ";
        if ($id) {
            $sql = "SELECT * FROM  `category` INNER JOIN `post` ON post.cat_id=category.cat_id WHERE `post_id`=$id";
        }
        $query = $this->conn->query($sql);
        return $query;
    }
    public function count($id)
    {
        $sql = "SELECT * FROM  `post` WHERE `author_id` = '$id' ";
        $query = $this->conn->query($sql);
        return $query;
    }

    public function addPost($id,$title, $content, $category, $fileName)
    {
        $sql = "INSERT INTO `post`(`author_id`, `title`, `description`, `image`, `cat_id`) VALUES('$id','$title','$content','$fileName','$category')";
        $query = $this->conn->query($sql);
        print_r($sql); exit();
        if ($query) {
            echo "success";
        } else {
            echo "not enterd";
        }
    }

    public function pagination($id=null)
    {

        $results_per_page = 3;

        //find the total number of results stored in the database  
        $query = "SELECT * from `post`";
        if($id) {
            $query .=" WHERE `cat_id`='$id'";
        }
        $result = $this->conn->query($query);
        $number_of_result = $result->num_rows;

        //determine the total number of pages available  
        $number_of_page = ceil($number_of_result / $results_per_page);

        //determine which page number visitor is currently on  
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page - 1) * $results_per_page;

        //retrieve the selected results from database   
        $query = "SELECT *FROM `post` LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = $this->conn->query($query);
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination">';
        echo '<li class="page-item"><a class="page-link" href="#">Previous</a></li>';
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $page . '">' . $page . ' </a></li>';
            // echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';
        }
        echo '</ul">';
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $page . '">Next</a></li>';
        echo '</nav>';
        return $result;
        //display the retrieved result on the webpage  
        // while ($row = $result->fetch_assoc()) {
        //     echo $row['post_id'] . ' ' . $row['title'] . '</br>';
        // }


        //display the link of the pages in URL  

    }
}
