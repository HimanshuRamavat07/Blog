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
$a = $blog->author($aid);
$author = $a->fetch_assoc();
?>

<div class="container my-5">
<div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
    <img src="../Upload/<?php echo $result['image']; ?>" class="card-img-top" alt="..." height="536px">
    <div class="card-body">
        <h5 class="card-title fw-bold"><?php echo $result['title']; ?></h5>
        <p class="card-text"><?php echo $result['description']; ?></p>
        <p class="card-text"><small class="text-muted">By <?php echo " ".$author['author_name']." "; ?>Posted On
                        <?php echo "  ".date('F j,Y',strtotime($result['timestamp'])); ?></small></p>
    </div>
</div>
</div>

<?php include_once('../footer.php'); ;?>