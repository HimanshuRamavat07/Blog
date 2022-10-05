<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    extract($_POST);
    // echo $id;
    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $blog->updateTag($id,$title);
    echo "true";
}


exit;
?>

