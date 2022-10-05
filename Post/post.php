<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>
<?php include_once('../header.php');
?>

<?php
if (!isset($_SERVER['PATH_INFO'])) {
    $slug = $_SERVER['PATH_INFO'];
    echo $slug;


    // echo $aid;
    $blog = new Blog();
    $readPost = $blog->readPost($slug);
    $result = $readPost->fetch_assoc();
    $user = $blog->postUser($aid);
    $author = $user->fetch_assoc();
    $tag = $blog->tagRead($aid);

?>


    <div class="container my-5">
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
            <img src="../Upload/<?php echo $result['feature_image']; ?>" class="card-img-top" alt="..." height="536px">
            <div class="card-body">

                <h5 class="card-title fw-bold"> <i class="bi bi-quote pe-2 mx-2"><?php echo $result['title']; ?></i></h5>

                <?php echo $result['description']; ?>

                <p class="card-text">
                    <small class="text-muted">
                        <?php while ($readTag = $tag->fetch_assoc()) {
                            echo '<span class="badge bg-dark text-light new mx-1">' . $readTag['tag_name'] . '</span>';
                        }  ?>
                        <br>
                        <small class="text-muted mx-1"> By <?php echo "<br> " . $author['user_name'] . " <br>"; ?>
                            Posted On
                            <?php echo "  " . date('F j,Y', strtotime($result['publish_date'])); ?>
                        </small>

                    </small>
                </p>
            </div>
            <?php if ($_SESSION['type'] == 1) { ?>
                <div class="card-footer">
                    <div class="d-flex justify-content-end p-2">
                        <button class="btn btn-secondary mx-3 p-2"><a href="update_post.php?uid=<?php echo $aid; ?>"> Update Post </a></button>
                        <button class="btn btn-outline-danger mx-3 p-2"><a href="./post.php?did=<?php echo $result['slug']; ?>"> Delete Post </a></button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php $blog = new Blog();
        $comment = $blog->readComment($aid);
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
                                    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>"><input type="hidden" name="pid" id="pid" value="<?php echo $aid; ?>">
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
            <!-- <div class="col-md-2"></div> -->
        </div>

    </div>
<?php }  ?>
<script>
    document.title = "Blog-Post";
</script>
<?php include_once('../footer.php'); ?>

<script src="../Assets/js/comment.js">
</script>

