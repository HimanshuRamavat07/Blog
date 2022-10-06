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
    * @param array $param value of all data field
    * @param array $category value of selected category
    * @param array $tag value of selected tag
    * 
    */

    public function addPost($param, $category, $tag)
    {
        $key = implode(' , ', array_keys($param));
        $value = implode(" ', '", $param);
        $category_id = explode(',', $category);
        $tag_id = explode(',', $tag);

        $sql = "INSERT INTO `post`($key) VALUES('$value')";
        $query = $this->conn->query($sql);
        $post_id = $this->conn->insert_id;
        if ($query) {
            for ($i = 0; $i < $param['count_category']; $i++) {
                $sql2 = "INSERT INTO `post_category`(`post_id`,`category_id`) VALUES ($post_id,$category_id[$i])";
                $query2 = $this->conn->query($sql2);
            }
            for ($j = 0; $j < $param['count_tag']; $j++) {
                $sql3 = "INSERT INTO `post_tag`(`post_id`,`tag_id`) VALUES ($post_id,$tag_id[$j])";
                $query3 = $this->conn->query($sql3);
            }
            return true;
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
            $sql .= " WHERE `slug`='$id'";
        }
        $query = $this->conn->query($sql);
        return $query;
    }

    public function readPostId($id)
    {
        $sql = "SELECT * FROM (((( `post` INNER JOIN `post_category` ON post_category.post_id=post.post_id ) INNER JOIN `post_tag` ON post_tag.post_id = post.post_id ) INNER JOIN `tag` ON tag.tag_id = post_tag.tag_id )INNER JOIN `category` ON category.category_id = post_category.category_id )WHERE post.post_id='$id';";
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Updating post
    * @param array $param value of all data field
    * @param array $category value of selected category
    * @param array $tag value of selected tag
    * @param string $slug value of post url
    * @param int $pid post id
    */
    public function updatePost($param, $category, $tag, $slug, $pid)
    {
        foreach ($param as $key => $value) {
            $args[] = "$key = '$value'";
        }

        $category_id = explode(',', $category);
        $tag_id = explode(',', $tag);

        $sql = "UPDATE `post` SET " . implode(',', $args) . " WHERE `slug`='$slug'";

        $query = $this->conn->query($sql);

        if ($query) {
            $deleteCategory = "DELETE FROM `post_category` WHERE `post_id`='$pid'";
            $runCategory = $this->conn->query($deleteCategory);
            $deleteTag = "DELETE FROM `post_tag` WHERE `post_id`='$pid'";
            $runCategory = $this->conn->query($deleteTag);
            for ($i = 0; $i < $param['count_category']; $i++) {
                $sql2 = "INSERT INTO `post_category`(`post_id`,`category_id`) VALUES ($pid,$category_id[$i])";
                $query2 = $this->conn->query($sql2);
            }
            for ($j = 0; $j < $param['count_tag']; $j++) {
                $sql3 = "INSERT INTO `post_tag`(`post_id`,`tag_id`) VALUES ($pid,$tag_id[$j])";
                $query3 = $this->conn->query($sql3);
            }
            return true;
        } else {
            return false;
        }
    }

    /*  
    * For Delete post
    * @param Int $id post-id
    */
    public function deletePost($id)
    {
        $deleteCategory = "DELETE FROM `post_category` WHERE `post_id`='$id'";
        $runCategory = $this->conn->query($deleteCategory);
        $deleteTag = "DELETE FROM `post_tag` WHERE `post_id`='$id'";
        $runCategory = $this->conn->query($deleteTag);
        $deletePost = "DELETE FROM `post` WHERE `post_id`='$id'";

        $query = $this->conn->query($deletePost);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /*  
    * For Adding category
    * @param string $name title of category
    */
    public function addCategory($name)
    {
        $sql = "INSERT INTO `category` (`category_title`) VALUES ('$name')";
        $query = $this->conn->query($sql);
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
            $sql = "SELECT * FROM ((`post` INNER JOIN `post_category` ON post_category.post_id=post.post_id) INNER JOIN `category` ON category.category_id=post_category.category_id)WHERE post.post_id='$id' OR post.slug='$id'";
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
        $sql = "UPDATE `category` SET `category_title` = '$title' WHERE `category_id`='$id'";
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For Delete Category
    * @param Int $id category-id
    */
    public function deleteCategory($id)
    {
        $sql = "DELETE FROM `category` WHERE `category_id`='$id'";
        $query = $this->conn->query($sql);
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
            $sql = "SELECT * FROM ((`post` INNER JOIN `post_tag` ON post_tag.post_id=post.post_id) INNER JOIN `tag` ON tag.tag_id=post_tag.tag_id)WHERE post.post_id='$id' 
            OR post.slug='$id'";
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
        $query = $this->conn->query($sql);
        return $query;
    }

    /*  
    * For delete Comment
    * @param Int $id Comment-id
    */
    public function deleteComment($id)
    {
        $sql = "DELETE FROM `comments` WHERE `comment_id`='$id'";
        $query = $this->conn->query($sql);
        if ($query) {
            return "true";
        }
    }


    /*  For pagination:
    * @param Int $id Post-id
    */
    public function pagination($id = null)
    {

        $results_per_page = 3;

        //find the total number of results stored in the database
        $query = "SELECT * from `post` ORDER BY `post_id` DESC";

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
        echo '<div aria-label="Page navigation example" style="position:fixed;bottom:0;right:50%;">';
        echo '<ul class="pagination">';
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . (($page - 1) == 0 ? $page = 1 : ($page - 1)) . '">Previous</a></li>';

        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $page . '">' . $page . ' </a></li>';
        }
        echo '</ul">';

        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . (($new + 1) > $number_of_page ? $new = $number_of_page : ($new + 1)) . '">Next</a></li>';

        echo '</div>';
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


    /* filter blog by Category
    @param Int $id determine which category user choose
     */
    public function filterCategory($id)
    {
        $sql = " SELECT * FROM ((`post` INNER JOIN `post_category` ON post_category.post_id=post.post_id ) INNER JOIN `category` ON category.category_id=post_category.category_id )  WHERE category.category_id='$id' ORDER BY post.post_id DESC";
        $query = $this->conn->query($sql);
        return $query;
    }

    /* filter blog by Tag
    @param Int $id determine which tag user choose
     */
    public function filterTag($id)
    {
        $sql = " SELECT * FROM ((`post` INNER JOIN `post_tag` ON post_tag.post_id=post.post_id ) INNER JOIN `tag` ON tag.tag_id=post_tag.tag_id )  WHERE tag.tag_id='$id' ORDER BY post.post_id DESC";
        $query = $this->conn->query($sql);
        return $query;
    }

    /* filter blog by search value
    @param string $keyword determine which keyword user choose
     */
    public function search($keyword)
    {
        $sql = "SELECT * FROM `post` WHERE `title` LIKE '%$keyword%' OR `description` LIKE '%$keyword%' ";
        $query = $this->conn->query($sql);
        return $query;
    }

    /* filter blog by search value plus category value
    @param string $keyword determine which keyword user choose
    @param string $category determine which category user choose
     */
    public function searchKeywordCategory($keyword, $category)
    {
        $sql = "SELECT * FROM ((`post` LEFT JOIN `post_category` ON post_category.post_id=post.post_id ) LEFT JOIN `category` ON category.category_id=post_category.category_id ) WHERE ( post.title LIKE '%$keyword%' OR post.description LIKE '%$keyword%' ) AND category.category_title LIKE '%$category%'";
        $query = $this->conn->query($sql);
        return $query;
    }

    /* filter blog by search value plus category value
    @param string $keyword determine which keyword user choose
    @param string $tag determine which tag user choose
     */
    public function searchKeywordTag($keyword, $tag)
    {
        $sql = "SELECT * FROM ((`post` LEFT JOIN `post_tag` ON post_tag.post_id=post.post_id ) LEFT JOIN `tag` ON tag.tag_id=post_tag.tag_id ) WHERE ( post.title LIKE '%$keyword%' OR post.description LIKE '%$keyword%' ) AND tag.tag_name LIKE '%$tag%'";
        $query = $this->conn->query($sql);
        return $query;
    }
}
