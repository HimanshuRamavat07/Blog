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
    
    extract($_POST);
    // echo $id;
    // echo "hello";
    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $blog->deletePost($id);
    echo "true";
}
exit;
