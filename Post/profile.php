<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>
<?php include_once('../header.php'); ?>
<?php


if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $blog = new Blog();
    $author = $blog->user($pid);

    $authorData = $author->fetch_assoc();
    $id = $authorData['user_id'];
    $n = $blog->count($id);
    $num = $n->num_rows;
?>
    <div class="container my-5">
        <div class="card p-5 shadow-lg p-3 mb-5 bg-white rounded">
            <h3 class="text-center mb-3 fw-bold">Your Profile</h3>

            <div class="card-header p-5">
                <div class="row text-center d-flex justify-content-center">
                    <div class="col-md-4 mb-5 mb-md-0">
                        <div class="card testimonial-card">
                            <div class="card-up" style="background-color: #7a81a8;"></div>
                            <div class="avatar mx-auto bg-white">
                                <img src="../Upload/<?php echo $authorData['user_img']; ?>" class="rounded-circle img-fluid" />
                            </div>
                            <div class="card-body">
                                <h4 class="mb-4"><?php echo $authorData['user_name']; ?></h4>
                                <hr />
                                <div class="d-flex justify-content-around rounded-3 p-2 mb-2" style="background-color: #efefef;">
                                    <div>
                                        <p class="small text-muted mb-1">
                                            Blog
                                        </p>
                                        <p class="mb-0"><?php echo $num ?></p>
                                    </div>
                                    <div class="px-3">
                                        <p class="small text-muted mb-1">
                                            Comment
                                        </p>
                                        <p class="mb-0">-</p>
                                    </div>
                                    <div>
                                        <p class="small text-muted mb-1">
                                            Rating
                                        </p>
                                        <p class="mb-0">⭐</p>
                                    </div>
                                </div>
                                <p class="dark-grey-text mt-4">
                                    <i class="bi bi-quote pe-2"><?php echo $authorData['about']; ?></i>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php }

if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];
    $blog = new Blog();
    $a = $blog->postUser($aid);
    $data = $a->fetch_assoc();
    $id = $data['user_id'];
    $n = $blog->count($id);
    $num = $n->num_rows;
    ?>
        <div class="container my-5">
            <div class="card p-5 shadow-lg p-3 mb-5 bg-white rounded">
                <h3 class="text-center mb-3 fw-bold">User Profile</h3>

                <div class="card-header p-5">
                    <div class="row text-center d-flex justify-content-center">
                        <div class="col-md-4 mb-5 mb-md-0">
                            <div class="card testimonial-card">
                                <div class="card-up" style="background-color: #7a81a8;"></div>
                                <div class="avatar mx-auto bg-white">
                                    <img src="../Upload/<?php echo $data['user_img']; ?>" class="rounded-circle img-fluid" />
                                </div>
                                <div class="card-body">
                                    <h4 class="mb-4"><?php echo $data['user_name']; ?></h4>
                                    <hr />
                                    <div class="d-flex justify-content-around rounded-3 p-2 mb-2" style="background-color: #efefef;">
                                        <div>
                                            <p class="small text-muted mb-1">
                                                Blog
                                            </p>
                                            <p class="mb-0"><?php echo $num ?></p>
                                        </div>
                                        <div class="px-3">
                                            <p class="small text-muted mb-1">
                                                Comment
                                            </p>
                                            <p class="mb-0">-</p>
                                        </div>
                                        <div>
                                            <p class="small text-muted mb-1">
                                                Rating
                                            </p>
                                            <p class="mb-0">⭐</p>
                                        </div>
                                    </div>
                                    <p class="dark-grey-text mt-4">
                                        <i class="bi bi-quote pe-2"><?php echo $data['about']; ?></i>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        <?php }
        ?>
        <script>document.title = "Blog-Profile";</script>
        <?php include_once('../footer.php'); ?>