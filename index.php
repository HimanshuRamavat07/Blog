<?php session_start(); 
if(!isset($_SESSION['user'])) {
    header('location:./login.php');
}
?>
<?php include_once('./Config/connection.php') ?>
<?php include_once('./App/function.php') ?>
<?php include_once('./header.php'); ?>
<?php
$blog = new Blog();
$r = $blog->readPost();
$cat= $blog->catRead();
if(isset($_GET['cat_id'])) {
    $r = $blog->filterPost($_GET['cat_id']);
}
?>


    <div class="my-3  d-flex justify-content-end mx-5">
        <button type="submit" class="btn btn-secondary btn-floating btn-lg button" id="top">
            <i class="bi bi-plus-circle"><a href="./add_post.php"> Create New Post </a></i>
        </button>
    </div>
    <div class="container-fluid my-1">
        <div class="row">
            <div class="col-md-10">

                <div class="row">
                    <?php while ($result = $r->fetch_assoc()) {  $id = $result['post_id']; ?>
                        <div class="col-md-4 ">
                            <div class="card my-3 shadow p-3 mb-5 bg-white rounded" style="height:38rem!important ;">
                                <div class="card-header my-1">
                                    <span class="badge rounded-pill bg-danger "><?php $c = $blog->catRead($id); $category = $c->fetch_assoc(); echo $category['cat_title']; ?> </span>

                                </div>
                                <img src="./Upload/<?php echo $result['image']; ?>" class="card-img-top" alt="..." style="height: 200px;"> 
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $result['title']; ?></h5>
                                    <p class="card-text" id="text">
                                        <?php $pos = strpos($result['description'], ' ', 300);
                                        echo substr($result['description'], 0, $pos) . ".....";  ?>
                                    </p>
                                    <a href="./post.php?aid=<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More</a>
                                </div>
                                <?php $a = $blog->author($id); $author = $a->fetch_assoc(); ?>
                                <div class="card-footer text-muted my-1">By <a href="./profile.php?aid=<?php echo $id; ?>"> <?php echo " " . $author['author_name']; ?> </a>On
                                    <?php echo "  " .date('F j , Y',strtotime($result['timestamp'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php   } ?>

                </div>

            </div>
            <div class="col-md-2 my-5">
                <div class="card" >
                    <div class="card-header" style="height: 100vh;">
                        <h5 class="text-center fw-bold">category</h5>
                        <div class="list-group mx-3 my-2">
                            <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php">All</a>
                        <?php while ($category = $cat->fetch_array()) { ?>
                            <a class="list-group-item list-group-item-action my-1 mx-1" href="./index.php?cat_id=<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></a>
                         <?php }   ?>
                         
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php include_once('./footer.php'); ?>



