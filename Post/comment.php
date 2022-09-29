<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    // echo $pid;
    // echo $uid;
    // echo $content;

    include_once('../Config/connection.php');
    include_once('../App/function.php');
    
    $blog = new Blog();
    $comment= $blog->addComment($uid,$pid,$content);
    echo "true";
}
exit;


?>