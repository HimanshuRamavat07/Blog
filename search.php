<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  !isset($_POST['category']) && !isset($_POST['tag'])) {

    extract($_POST);
    include_once('./Config/connection.php');
    include_once('./App/function.php');

    $blog = new Blog();
    $r = $blog->readPost();
    $category = $blog->catagoryRead();
    $tag = $blog->tagRead();


    if (!isset($_POST['category'])) {
        $filter = $blog->search($keyword);
    }
    if (isset($_POST['category'])) {

        $filter = $blog->searchKeywordCategory($keyword, $category);
    }
    // echo "true";
?>
<script src="../Assets/js/index.js"></script>
    <div class="col-md-10">
        <div class="row">
            <?php while ($result = $filter->fetch_assoc()) {
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
                            <h5 class="card-title fw-bold"> <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>"> <?php echo $result['title']; ?></a>
                                <?php $category2 = $blog->tagRead($id);
                                while ($result2 = $category2->fetch_assoc()) {
                                    echo '<span class="badge bg-dark text-light new mx-1">' . $result2['tag_name'] . '</span>';
                                }  ?>
                            </h5>
                            <p class="card-text" id="text">
                                <?php echo substr($result['description'], 0, 320); ?>

                            </p>
                            <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More</a>
                            <button class="btn btn-outline-danger mx-3 p-2"><a href="./update_tag.php?did=<?php echo $result['post_id']; ?>"> Delete Post </a></button>
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

                    <?php while ($categoryRead = $category->fetch_assoc()) { ?>
                        <a class="list-group-item list-group-item-action my-1 mx-1" onclick="myFun2('<?php echo $keyword . ',' . $categoryRead['category_title']; ?>')"><?php echo $categoryRead['category_title']; ?></a>
                    <?php }   ?>

                </div>

                <h5 class="text-center fw-bold my-1">Tag</h5>
                <div class="list-group mx-3 my-2">
                    <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>

                    <?php while ($tagRead = $tag->fetch_array()) { ?>
                        <a class="list-group-item list-group-item-action my-1 mx-1"  onclick="myFun3('<?php echo $keyword . ',' . $tagRead['tag_name']; ?>')"><?php echo $tagRead['tag_name']; ?></a>
                    <?php }   ?>

                </div>

            </div>
        </div>
    </div>
<?php
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  !isset($_POST['tag']) && isset($_POST['category']) )  {

    extract($_POST);
    include_once('./Config/connection.php');
    include_once('./App/function.php');

    $blog = new Blog();
    $r = $blog->readPost();
    $category3 = $blog->catagoryRead();
    $tag = $blog->tagRead();
    $filter = $blog->searchKeywordCategory($keyword, $category);

    // echo "true";
?>
<script src="../Assets/js/index.js"></script>
    <div class="col-md-10">
        <div class="row">
            <?php while ($result = $filter->fetch_assoc()) {
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
                            <h5 class="card-title fw-bold"> <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>"> <?php echo $result['title']; ?></a>
                                <?php $category2 = $blog->tagRead($id);
                                while ($result2 = $category2->fetch_assoc()) {
                                    echo '<span class="badge bg-dark text-light new mx-1">' . $result2['tag_name'] . '</span>';
                                }  ?>
                            </h5>
                            <p class="card-text" id="text">
                                <?php echo substr($result['description'], 0, 320); ?>

                            </p>
                            <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More</a>
                            <button class="btn btn-outline-danger mx-3 p-2"><a href="./update_tag.php?did=<?php echo $result['post_id']; ?>"> Delete Post </a></button>
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

                    <?php while ($categoryRead = $category3->fetch_assoc()) { ?>
                        <a class="list-group-item list-group-item-action my-1 mx-1" onclick="myFun2('<?php echo $keyword . ','. $categoryRead['category_title']; ?>')"><?php echo $categoryRead['category_title']; ?></a>
                    <?php }   ?>

                </div>

                <h5 class="text-center fw-bold my-1">Tag</h5>
                <div class="list-group mx-3 my-2">
                    <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>

                    <?php while ($tagRead = $tag->fetch_array()) { ?>
                        <a class="list-group-item list-group-item-action my-1 mx-1" onclick="myFun2('<?php echo $keyword . ','. $tagRead['tag_name']; ?>')"><?php echo $tagRead['tag_name']; ?></a>
                    <?php }   ?>

                </div>

            </div>
        </div>
    </div>
<?php
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['category']) && isset($_POST['tag'])) {

    extract($_POST);
    include_once('./Config/connection.php');
    include_once('./App/function.php');

    $blog = new Blog();
    $r = $blog->readPost();
    $category3 = $blog->catagoryRead();
    $tag2 = $blog->tagRead();
    $filter = $blog->searchKeywordTag($keyword, $tag);

    // echo "true";
?>
<script src="../Assets/js/index.js"></script>
    <div class="col-md-10">
        <div class="row">
            <?php while ($result = $filter->fetch_assoc()) {
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
                            <h5 class="card-title fw-bold"> <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>"> <?php echo $result['title']; ?></a>
                                <?php $category2 = $blog->tagRead($id);
                                while ($result2 = $category2->fetch_assoc()) {
                                    echo '<span class="badge bg-dark text-light new mx-1">' . $result2['tag_name'] . '</span>';
                                }  ?>
                            </h5>
                            <p class="card-text" id="text">
                                <?php echo substr($result['description'], 0, 320); ?>

                            </p>
                            <a href="./Post/post.php?pid=<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More</a>
                            <button class="btn btn-outline-danger mx-3 p-2"><a href="./update_tag.php?did=<?php echo $result['post_id']; ?>"> Delete Post </a></button>
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

                    <?php while ($categoryRead = $category3->fetch_assoc()) { ?>
                        <a class="list-group-item list-group-item-action my-1 mx-1" onclick="myFun2('<?php echo $keyword . ','. $categoryRead['category_title']; ?>')"><?php echo $categoryRead['category_title']; ?></a>
                    <?php }   ?>

                </div>

                <h5 class="text-center fw-bold my-1">Tag</h5>
                <div class="list-group mx-3 my-2">
                    <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>

                    <?php while ($tagRead = $tag2->fetch_array()) { ?>
                        <a class="list-group-item list-group-item-action my-1 mx-1" onclick="myFun2('<?php echo $keyword . ','. $tagRead['tag_name']; ?>')"><?php echo $tagRead['tag_name']; ?></a>
                    <?php }   ?>

                </div>

            </div>
        </div>
    </div>
<?php
}


exit;
