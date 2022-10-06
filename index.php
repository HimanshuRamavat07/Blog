<?php session_start(); ?>
<?php
if (!isset($_SESSION['user'])) {
    header('location:./login.php');
}
?>
<?php include_once('./Config/connection.php') ?>
<?php include_once('./App/function.php') ?>
<?php include_once('./header.php'); ?>
<?php

$blog = new Blog();
if (isset($_SERVER['PATH_INFO'])) {
    $uid = $_SESSION['id'];
    $slug = $_SERVER['PATH_INFO'];
    $tag = $blog->tagRead($slug);
    $read = $blog->readPost($slug);
    $result = $read->fetch_assoc();
?>

    <div class="container my-5">
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">

            <div class="card-header my-1 p-2" style="display: flex; justify-content:center; ">
                <?php $category2 = $blog->catagoryRead($slug);
                while ($result2 = $category2->fetch_assoc()) {

                    echo '<span class="badge rounded-pill bg-danger mx-1 p-1">' . $result2['category_title'] . '</span>';
                }  ?>

            </div>
          
            <img src="../Upload/<?php echo $result['feature_image']; ?>" class="card-img-top" alt="..." height="536px">
            <div class="card-body">
            <input type="hidden" name="uid" id="uid" value="<?php  echo $uid; ?>">
            <input type="hidden" name="pid" id="pid" value="<?php echo $result['post_id']; ?>">
            <input type="hidden" name="slug" id="slug" value="<?php echo $result['slug']; ?>">
                <h5 class="card-title fw-bold"> <i class="bi bi-quote pe-2 mx-2"><?php echo $result['title']; ?></i></h5>

                <?php echo $result['description']; ?>

                <p class="card-text">
                    <small class="text-muted">
                        <?php while ($readTag = $tag->fetch_assoc()) {
                            echo '<span class="badge bg-dark text-light new mx-1">' . $readTag['tag_name'] . '</span>';
                        }  ?>
                        <br>
                        <small class="text-muted mx-1"> 
                            By <?php $user = $blog->postUser($result['post_id']);
                            $author = $user->fetch_assoc();
                            echo "<br> " . $author['user_name'] . " <br>"; ?>
                            Posted On
                            <?php echo "  " . date('F j,Y', strtotime($result['publish_date'])); ?>
                        </small>

                    </small>
                </p>
            </div>
            <?php if ($_SESSION['type'] == 1) { ?>
                <div class="card-footer">
                    <div class="d-flex justify-content-end p-2">
                        <button class="btn btn-secondary mx-3 p-2"><a href="update_post.php?uid=<?php echo $result['slug']; ?>"> Update Post </a></button>

                    </div>
                </div>
            <?php } ?>
        </div>
        <?php $blog = new Blog();
        $comment = $blog->readComment($result['post_id']);
        while ($data = $comment->fetch_assoc()) {
        ?>

            <div class="container card mb-4 shadow p-3 mb-5 bg-white rounded">
                <div class="card-body">
                    <div class="d-flex flex-start align-items-center ">
                        <img class="rounded-circle shadow-1-strong me-3" src="../Upload/<?php echo $data['user_img']; ?>" alt="avatar" width="60" height="60" />
                        <div>
                            <h6 class="fw-bold text-primary mb-1"><?php echo $data['user_name']; ?></h6>
                            <p class="text-muted small mb-0">
                                <?php echo "  " . date('F j,Y - g:i A', strtotime($data['time'])); ?>
                            </p>
                        </div>
                    </div>

                    <p class="mt-3 mb-4 pb-2">
                        <?php echo $data['comment']; ?>
                    </p>

                    <div class="small d-flex justify-content-start">
                        <a href="#!" class="d-flex align-items-center me-3">
                            <i class="bi bi-hand-thumbs-up-fill me-2"></i>
                            <p class="mb-0">Like</p>
                        </a>
                        <a href="#!" class="d-flex align-items-center me-3">
                            <i class="bi bi-chat-dots-fill me-2"></i>
                            <p class="mb-0">Comment</p>
                        </a>
                        <a href="#!" class="d-flex align-items-center me-3">
                            <i class="bi bi-share-fill me-2"></i>
                            <p class="mb-0">Share</p>
                        </a>
                    </div>
                    <div class="small d-flex justify-content-end">
                        <?php $var = $data['comment_id'].",".$data['slug']; $var?>
                    <a href="javascript:delete_data(<?php echo $data['comment_id']; ?>)" class="d-flex align-items-center me-3">
                            <i class="bi bi-trash-fill me-2"></i>
                            <p class="mb-0">Delete</p>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div class="card shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="card-body p-4">
                        <div class="d-flex flex-start ">
                            <img class="rounded-circle shadow-1-strong me-3" src="../Upload/images(1).png" alt="avatar" width="65" height="65" />
                            <div class="w-100">
                                <h5>Add a comment</h5>
                                <div class="form-floating ">
                                
                                    <textarea class="form-control" id="textAreaExample" rows="10" style="height: 150px;"></textarea>
                                    <label class="form-label" for="textAreaExample">What is your view?</label>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-success">Clear</button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="submitComment()">
                                        Send <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        document.title = "Blog-<?php echo  $result['title']; ?>";
    </script>
    <?php   } else {
    if ($_SESSION['type'] == 1) { ?>
        <div class="my-3  d-flex justify-content-end mx-5 mb-3">
            <button type="submit" class="btn btn-secondary btn-floating btn-lg button" id="top">
                <i class="bi bi-plus-circle"><a href="./Post/add_post.php"> Create New Post </a></i>
            </button>
        </div>
    <?php } ?>

    <div class="container-fluid my-1">
        <div class="row" id="viewData">
            <div class="col-md-10">

                <?php $page = $blog->pagination(); ?>
                <div class="row">
                    <?php while ($result = $page->fetch_assoc()) {
                        $id = $result['post_id']; ?>
                        <div class="col-md-4 ">
                            <div class="card my-3 shadow p-3 mb-5 bg-white rounded" style="height:38rem!important ;">
                                <div class="card-header my-1">
                                    <?php $category2 = $blog->catagoryRead($id);
                                    while ($result2 = $category2->fetch_assoc()) {

                                        echo '<span class="badge rounded-pill bg-danger mx-1">' . $result2['category_title'] . '</span>';
                                    }  ?>

                                </div>
                                <img src="./Upload/<?php echo $result['feature_image']; ?>" class="card-img-top" alt="Post image" style="height: 200px;">

                                <div class="card-body overflow-auto">
                                    <h5 class="card-title fw-bold"> <a href="http://localhost/Himanshu/Blog<?php echo $result['slug']; ?>"> <?php echo $result['title']; ?></a>
                                    </h5>
                                    
                                        <?php echo substr($result['description'], 0, 320); ?>

                                 
                                    <a href="http://localhost/Himanshu/Blog<?php echo $result['slug']; ?>" class="btn btn-primary me-3">Read More</a>
                                   
                                </div>

                                <?php $a = $blog->postUser($id);
                                $user = $a->fetch_assoc(); ?>
                                <div class="card-footer text-muted my-1 d-flex justify-content-between" > By -<a href="./Post/profile.php?aid=<?php echo $id; ?>"> <?php echo " " . $user['user_name']; ?> </a>On
                                    <?php echo "  " . date('F j , Y', strtotime($result['publish_date'])); ?>
                                    <?php if($_SESSION['type']==1) { ?><button class="btn btn-outline-danger mx-3 p-2 "><a href="./index.php?did=<?php echo $result['post_id']; ?>"> Delete Post </a></button> <?php } ?>
                                </div>

                            </div>
                        </div>
                    <?php   } ?>

                </div>
            </div>
            <div class="col-md-2 my-5">
                <div class="card">

                    <div class="input-group rounded m-2 p-2">
                        <input type="search" class="form-control rounded m-2 p-2" placeholder="Search Blog title here" aria-label="Search" aria-describedby="search-addon" onchange="myFun(this.value)" />
                        <span class="input-group-text border-0  rounded m-2 p-2" id="search-addon">
                            <i class="bi bi-search me-2 ms-2"></i>
                        </span>
                    </div>

                    <h3 class="text-center p-2">Filter Blog</h3>
                    <div class="card-header">
                        <h5 class="text-center fw-bold">category</h5>
                        <div class="list-group mx-3 my-2">
                            <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>

                            <?php $category = $blog->catagoryRead();
                            while ($categoryRead = $category->fetch_assoc()) { ?>
                                <a class="list-group-item list-group-item-action my-1 mx-1" href="./filterData.php?category_id=<?php echo $categoryRead['category_id']; ?>"><?php echo $categoryRead['category_title']; ?></a>
                            <?php }   ?>

                        </div>

                        <h5 class="text-center fw-bold my-1">Tag</h5>
                        <div class="list-group mx-3 my-2">
                            <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>

                            <?php $tag = $blog->tagRead();
                            while ($tagRead = $tag->fetch_array()) { ?>
                                <a class="list-group-item list-group-item-action my-1 mx-1" href="./filterTag.php?tag_id=<?php echo $tagRead['tag_id']; ?>"><?php echo $tagRead['tag_name']; ?></a>
                            <?php }   ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.title = "Blog-Home";
    </script>
    </div>
<?php  } ?>
<?php include_once('./footer.php'); ?>

<script type="text/javascript" src="./Assets/js/index.js"></script>
<script type="text/javascript" src="./Assets/js/comment.js"></script>
<?php
if (isset($_GET['did'])) {
    $id = $_GET['did'];      
 
            include_once('./Config/connection.php');
            include_once('./App/function.php');
            $blog = new Blog();

            $result = $blog -> deletePost($id);
            if ($result = true) {
               ?><script> alertify.alert('Ready to rock', 'Post is deleted.', () => {
                        (window.location.href = "./index.php")
                    });</script> <?php
            }
          

} ?>