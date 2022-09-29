<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    extract($_POST);
    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $blog->addTag($title);
    echo "true";
}
exit;
