<?php include_once('../header.php'); ?>
<?php include_once('../footer.php'); ?>
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['c_did'])) {
    
    extract($_POST);
    // echo $id;
    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $blog->deleteCategory($id);
    echo "true";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['t_did'])) {
    
    extract($_POST);
    // echo $id;
    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $blog->deleteTag($id);
    echo "true";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['did'])) {
    
    $id = $_GET['did'];
    // echo $id;
    // echo "hello";
    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $result = $blog->deletePost($id);
    if($result = true) {
        echo "hello";
    }
}
if (isset($_GET['comment'])) {
    
    $id = $_GET['comment'];
    echo $id;
    // echo "hello";
    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $result = $blog->deleteComment($id);
    if($result == "true") {
       ?> <script>alertify.alert('This page says', 'comment is deleted.', () => {
        window.location.href = "../index.php"
    });</script> <?php
    }
}
//
exit;
