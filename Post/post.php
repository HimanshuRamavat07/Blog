<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>
<?php include_once('../header.php');
?>

<?php
$aid = $_GET['aid'];
$blog = new Blog();
$r = $blog->readPost($aid);
$result = $r->fetch_assoc();
$a = $blog->postAuthor($aid);
$author = $a->fetch_assoc();

?>

<div class="container my-5">
<div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
    <img src="../Upload/<?php echo $result['image']; ?>" class="card-img-top" alt="..." height="536px">
    <div class="card-body">
        <h5 class="card-title fw-bold"> <i class="bi bi-quote pe-2 mx-2"><?php echo $result['title']; ?></i></h5>
        <p class="card-text"><?php echo $result['description']; ?></p>
        <p class="card-text"> <small class="text-muted"><?php $tag= $blog->tagName($aid); $val = $tag->fetch_assoc(); ?> <span class="badge  bg-dark text-light new"><?php echo $val['tag_name'];  ?></span><br><small class="text-muted"> By <?php echo "<br> ".$author['author_name']." <br>"; ?>Posted On
        <?php echo "  ".date('F j,Y', strtotime($result['timestamp'])); ?></small>
   
</small></p>
    </div>
</div>
</div>
<script>document.title = "Blog-Post";</script>
<?php include_once('../footer.php'); ?>