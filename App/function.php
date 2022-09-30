<?php
class Blog extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    /*  
    * For a login page:
    * @param string $email email as user id
    */
    public function signin($email)
    {
        $query = "SELECT * FROM `user` WHERE user_email = '$email'";
        $res = $this->conn->query($query);
        return $res;
    }

    /*  
    * For a User as a author or profile page:
    * @param Int $id user-id
    */
    public function user($id)
    {
        $sql = "SELECT * FROM `user` WHERE  `user_id`='$id'";
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For particular user for post
    * @param Int $id post-id
    */
    public function postUser($id)
    {
        $sql = "SELECT * FROM `user` INNER JOIN `post` ON post.user_id=user.user_id";
        if ($id) {
            $sql .= " WHERE `post_id`='$id'";
        }
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Adding post
    * @param Int $id email as user id
    * @param string $title title of post
    * @param string $content content of post
    * @param string $category category of post
    * @param string $tag tag of post
    *  @param string $fileName Image of post
    */
    // public function addPost($id, $title, $content, $category, $tag, $fileName)
    public function addPost($param,$category,$tag)
    {
        $key = implode(' , ',array_keys($param));
        $value = implode(" ', '",$param);
        $category_id = explode(',', $category);
        $tag_id = explode(',', $tag);

        $sql = "INSERT INTO `post`($key) VALUES('$value')";
        $query = $this->conn->query($sql);
        $post_id = $this->conn->insert_id;
        if ($query) {
            for($i=0;$i<$param['count_category'];$i++) {
                $sql2 = "INSERT INTO `post_category`(`post_id`,`category_id`) VALUES ($post_id,$category_id[$i])";
                $query2 = $this->conn->query($sql2);
            }
            for($j=0;$j<$param['count_tag'];$j++) {
                $sql3 = "INSERT INTO `post_tag`(`post_id`,`tag_id`) VALUES ($post_id,$tag_id[$j])";
                $query3 = $this->conn->query($sql3);
            }
            // print_r($sql);
            // print_r($sql2);
            // print_r($sql3);
            // return true;
        } else {
            return false;
        }

    }

    /*  
    * For Reading post
    * @param Int $id post-id
    */
    public function readPost($id = null)
    {
        $sql = "SELECT * FROM `post` ";
        if ($id) {
            $sql .= " WHERE `post_id`='$id' ORDER BY `post_id` DESC";
        }
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Updating post
    * @param Int $id email as user id
    * @param string $title title of post
    * @param string $content content of post
    * @param string $category category of post
    * @param string $tag tag of post
    *  @param string $fileName Image of post
    */
    public function updatePost($id, $title, $content, $category, $tag, $fileName)
    {
        $sql = "UPDATE `post` SET `title`='$title',`description`='$content',`category`='$category',`tag`='$tag',`image`='$fileName' WHERE `post_id`='$id'";
        // print_r($sql);
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Delete post
    * @param Int $id post-id
    */
    public function deletePost($id)
    {
        $sql = "DELETE FROM `post` WHERE `post_id`='$id'";
        // print_r($sql);
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Adding category
    * @param string $name title of category
    */
    public function addCategory($name)
    {
        $sql = "INSERT INTO `category` (`cat_title`) VALUES ('$name')";
        $query = $this->conn->query($sql);
        // print_r($sql);
        return $query;
    }

    /*  
    * For Reading Category
    * @param Int $id category-id
    */
    public function catagoryRead($id = null)
    {
        $sql = "SELECT * FROM  `category` ";
        if ($id) {
            $sql = "SELECT * FROM ((`post` INNER JOIN `post_category` ON post_category.post_id=post.post_id) INNER JOIN `category` ON category.category_id=post_category.category_id)WHERE post.post_id=$id";
        }
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Update Category
    * @param Int $id category-id
    * @param string $title title of category
    */
    public function updateCategory($id, $title)
    {
        $sql = "UPDATE `category` SET `cat_title` = '$title' WHERE `cat_id`='$id'";
        $query = $this->conn->query($sql);
        // print_r($sql);
        return $query;
    }

    /*  
    * For Delete Category
    * @param Int $id category-id
    */
    public function deleteCategory($id)
    {
        $sql = "DELETE FROM `category` WHERE `cat_id`='$id'";
        $query = $this->conn->query($sql);
        // print_r($sql);
        return $query;
    }

    /*  
    * For Adding Tag
    * @param string $name title of tag
    */
    public function addTag($name)
    {
        $sql = "INSERT INTO `tag` (`tag_name`) VALUES ('$name')";
        $query = $this->conn->query($sql);
        // print_r($sql);
        return $query;
    }

    /*  
    * For Reading Tag
    * @param Int $id Tag-id
    */
    public function tagRead($id = null)
    {
        $sql = "SELECT * FROM  `tag` ";
        if ($id) {
            $sql = "SELECT * FROM ((`post` INNER JOIN `post_tag` ON post_tag.post_id=post.post_id) INNER JOIN `tag` ON tag.tag_id=post_tag.tag_id)WHERE post.post_id=$id";
        }
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Update Category
    * @param Int $id category-id
    * @param String $title title of tag
    */
    public function updateTag($id, $title)
    {
        $sql = "UPDATE `tag` SET `tag_name` = '$title' WHERE `tag_id`='$id'";
        $query = $this->conn->query($sql);
        // print_r($sql);
        return $query;
    }

    /*  
    * For Delete Category
    * @param Int $id Tag-id
    */
    public function deleteTag($id)
    {
        $sql = "DELETE FROM `tag` WHERE `tag_id`='$id'";
        $query = $this->conn->query($sql);
        // print_r($sql);
        return $query;
    }

    /*  
    * For Add Comment
    * @param Int $uid user-id
    * @param Int $pid post-id
    * @param String $content content of comment
    */
    public function addComment($uid, $pid, $content)
    {
        $sql = "INSERT INTO `comments` (`user_id`,`post_id`,`comment`) VALUES ('$uid','$pid','$content')";
        // print_r($sql);
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Reading Comment
    * @param Int $id Comment-id
    */
    public function readComment($id)
    {
        $sql = "SELECT * FROM ((`comments` INNER JOIN `post` ON post.post_id=comments.post_id ) INNER JOIN `user` ON comments.user_id=user.user_id) WHERE comments.post_id='$id'";
        // print_r($sql);
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  For pagination:
    * @param Int $id Post-id
    */
    public function pagination($id = null)
    {

        $results_per_page = 3;

        //find the total number of results stored in the database
        $query = "SELECT * from `post` ORDER BY `post_id` DESC";
        if ($id) {
            $query .= " WHERE `cat_id`='$id' ";
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
        $new = $page;
        $page_first_result = ($page - 1) * $results_per_page;

        $query = "SELECT *FROM `post` ORDER BY `post_id` DESC LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = $this->conn->query($query);
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination">';
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . (($page - 1) == 0 ? $page = 1 : ($page - 1)) . '">Previous</a></li>';

        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $page . '">' . $page . ' </a></li>';
        }
        echo '</ul">';

        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . (($new + 1) > $number_of_page ? $new = $number_of_page : ($new + 1)) . '">Next</a></li>';

        echo '</nav>';
        return $result;
    }

    /*  For a how many blog user write
    @param Int $id user Id
     */
    public function count($id)
    {
        $sql = "SELECT * FROM  `post` WHERE `user_id` = '$id' ";
        $query = $this->conn->query($sql);
        return $query;
    }
}
