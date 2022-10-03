<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    extract($_POST);
    include_once('./Config/connection.php');
    include_once('./App/function.php');
    $blog = new Blog();

    $filter = $blog->search($keyword);
    // echo "true";
?>
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
                        <?php echo substr($result['description'],0,320); ?>
                        
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
<?php
}
exit;