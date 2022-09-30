<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:./login.php');
}
?>
<?php include_once('./Config/connection.php') ?>
<?php include_once('./App/function.php') ?>
<?php include_once('./header.php'); ?>
<?php


$blog = new Blog();
$r = $blog->readPost();
$category = $blog->catagoryRead();
$tag = $blog->tagRead();

?>
<?php if($_SESSION['type']==1) { ?>
<div class="my-3  d-flex justify-content-end mx-5 ">
    <button type="submit" class="btn btn-secondary btn-floating btn-lg button" id="top">
        <i class="bi bi-plus-circle"><a href="./Post/add_post.php"> Create New Post </a></i>
    </button>
</div>
<?php } ?>
<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-10">

            <?php
            if (!isset($_GET['cat_id']) && !isset($_GET['tag_id'])) {
                $page = $blog->pagination(); ?>
                <div class="row">
                    <?php while ($result = $page->fetch_assoc()) {
                        $id = $result['post_id']; ?>
                        <div class="col-md-4 ">
                            <div class="card my-3 shadow p-3 mb-5 bg-white rounded" style="height:38rem!important ;">
                                <div class="card-header my-1">
                                    <?php $category2 = $blog->catagoryRead($id);
                                   while($result2= $category2->fetch_assoc() ){ echo '<span class="badge rounded-pill bg-danger mx-1">'.$result2['category_title'].'</span>'; }  ?> 

                                </div>
                                <img src="./Upload/<?php echo $result['feature_image']; ?>" class="card-img-top" alt="Post image" style="height: 200px;">

                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $result['title']; ?>
                                    <?php $category2 = $blog->tagRead($id);
                                   while($result2= $category2->fetch_assoc() ){ echo '<span class="badge bg-dark text-light new mx-1">'.$result2['tag_name'].'</span>'; }  ?>                    
                                    </h5>
                                    <p class="card-text" id="text" style="height: 150px; overflow:hidden;">
                                    <?php echo $result['description']; ?>
                                        <!-- <?php $pos = strpos($result['description'], ' ', 150); 
                                        echo substr($result['description'], 0, $pos) . ".....";  ?> -->
                                    </p>
                                    <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More</a>
                                </div>

                                <?php $a = $blog->postUser($id);
                                $user = $a->fetch_assoc(); ?>
                                <div class="card-footer text-muted my-1">By <a href="./Post/profile.php?aid=<?php echo $id; ?>"> <?php echo " " . $user['user_name']; ?> </a>On
                                    <?php echo "  " . date('F j , Y', strtotime($result['publish_date'])); ?>
                                </div>

                            </div>
                        </div>
                    <?php   } ?>

                </div>
            <?php } ?>

            <?php if (isset($_GET['cat_id'])) { ?>
                <div class="row">
                    <?php while ($result = $r->fetch_assoc()) {
                        $name = $_GET['cat_id'];
                        $id = $result['post_id'];
                        $data = explode(',',$result['category']);
                      
                        if(in_array($name,$data)) {
                           
                        ?>
                        <div class="col-md-4 ">
                            <div class="card my-3 shadow p-3 mb-5 bg-white rounded" style="height:38rem!important ;">
                                <div class="card-header my-1">
                                    <?php $category = explode(',',$result['category']);
                                      $length = count($category);
                                   for($i=0; $i< $length; $i++){ echo '<span class="badge rounded-pill bg-danger mx-1">'.$category[$i].'</span>'; }  ?> 

                                </div>
                                <img src="./Upload/<?php echo $result['image']; ?>" class="card-img-top" alt="Post image" style="height: 200px;">

                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $result['title']; ?>
                                    <?php $tag = explode(',',$result['tag']); $length = count($tag); 
                                    for($i=0; $i< $length; $i++){ echo '<span class="badge bg-dark text-light new mx-1">'.$tag[$i].'</span>'; }  ?>                    
                                    </h5>
                                    <p class="card-text" id="text" style="height: 150px; overflow:hidden;">
                                    <?php echo $result['description']; ?>
                                        <!-- <?php $pos = strpos($result['description'], ' ', 150);
                                        echo substr($result['description'], 0, $pos) . ".....";  ?> -->
                                    </p>
                                    <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More</a>
                                </div>

                                <?php $a = $blog->postUser($id);
                                $user = $a->fetch_assoc(); ?>
                                <div class="card-footer text-muted my-1">By <a href="./Post/profile.php?aid=<?php echo $id; ?>"> <?php echo " " . $user['user_name']; ?> </a>On
                                    <?php echo "  " . date('F j , Y', strtotime($result['timestamp'])); ?>
                                </div>

                            </div>
                        </div>
                    <?php }  } ?>
                </div>
            <?php   } ?>

            <?php if (isset($_GET['tag_id'])) { ?>
                <div class="row">
                    <?php while ($result = $r->fetch_assoc()) {
                        $name = $_GET['tag_id'];
                        $id = $result['post_id'];
                        $data = explode(',',$result['tag']);
                      
                        if(in_array($name,$data)) {
                           
                        ?>
                        <div class="col-md-4 ">
                            <div class="card my-3 shadow p-3 mb-5 bg-white rounded" style="height:38rem!important ;">
                                <div class="card-header my-1">
                                    <?php $category = explode(',',$result['category']);
                                      $length = count($category);
                                   for($i=0; $i< $length; $i++){ echo '<span class="badge rounded-pill bg-danger mx-1">'.$category[$i].'</span>'; }  ?> 

                                </div>
                                <img src="./Upload/<?php echo $result['image']; ?>" class="card-img-top" alt="Post image" style="height: 200px;">

                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $result['title']; ?>
                                    <?php $tag = explode(',',$result['tag']); $length = count($tag); 
                                    for($i=0; $i< $length; $i++){ echo '<span class="badge bg-dark text-light new mx-1">'.$tag[$i].'</span>'; }  ?>                    
                                    </h5>
                                    <p class="card-text" id="text" style="height: 150px; overflow:hidden;">
                                    <?php echo $result['description']; ?>
                                        <!-- <?php $pos = strpos($result['description'], ' ', 150);
                                        echo substr($result['description'], 0, $pos) . ".....";  ?> -->
                                    </p>
                                    <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More</a>
                                </div>

                                <?php $a = $blog->postUser($id);
                                $user = $a->fetch_assoc(); ?>
                                <div class="card-footer text-muted my-1">By <a href="./Post/profile.php?aid=<?php echo $id; ?>"> <?php echo " " . $user['user_name']; ?> </a>On
                                    <?php echo "  " . date('F j , Y', strtotime($result['timestamp'])); ?>
                                </div>

                            </div>
                        </div>
                    <?php }  } ?>
                </div>
            <?php   } ?>
        </div>
        <div class="col-md-2 my-5">
            <div class="card">
                <h3 class="text-center p-2">Filter Blog</h3>
                <div class="card-header">
                    <h5 class="text-center fw-bold">category</h5>
                    <div class="list-group mx-3 my-2">
                        <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>
                            
                        <?php while ($categoryRead = $category->fetch_array()) { ?>
                            <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php?cat_id=<?php echo $categoryRead['category_id']; ?>"><?php echo $categoryRead['category_title']; ?></a>
                        <?php }   ?>

                    </div>

                    <h5 class="text-center fw-bold my-1">Tag</h5>
                    <div class="list-group mx-3 my-2">
                        <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>
                            
                        <?php while ($tagRead = $tag->fetch_array()) { ?>
                            <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php?tag_id=<?php echo $tagRead['tag_id']; ?>"><?php echo $tagRead['tag_name']; ?></a>
                        <?php }   ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>document.title = "Blog-Home";</script>
<?php include_once('./footer.php'); ?>