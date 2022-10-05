<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['uid'])) {


    extract($_POST);

    $slug = strtolower($title);
    $slug = str_replace(' ', '-', $slug);
    $slug =  "/Post/" . $slug;

    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $count =  "SELECT COUNT(*) AS countValue FROM `post` WHERE `slug` LIKE '$slug%'";
    $run = $blog->conn->query($count);
    $result = $run->fetch_assoc();
    $total = $result['countValue'];

    $slug = ($total > 0) ? $slug . "(" . $total . ")" : $slug;

    // echo $description;
    $id = $_SESSION['id'];
    // echo $id;
    $statusMsg = "";
    $targetDir = "../Upload/";
    $fileName = basename($_FILES["fileImage"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($_FILES["fileImage"]["name"])) {

        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {

            if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $targetFilePath)) {
                $array = ['title' => $title, 'description' => $description, 'slug' => $slug, 'count_category' => $count_category, 'count_tag' => $count_tag, 'feature_image' => $fileName, 'user_id' => $id];

                $blog->addPost($array, $category, $tag);
                echo "true";
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    echo $statusMsg;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['uid'])) {

    extract($_POST);
    $postid = $_POST['postid'];

    include_once('../Config/connection.php');
    include_once('../App/function.php');
    $blog = new Blog();

    $pid = $_GET['uid'];
    $id = $_SESSION['id'];
   
    $statusMsg = "";
    $targetDir = "../Upload/";


    // echo $title;
    // echo $content;
    if (isset($_FILES['fileImage']['name'])) {
        $fileName = basename($_FILES["fileImage"]["name"]);

        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {

            if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $targetFilePath)) {
                $array = ['title' => $title, 'description' => $description, 'count_category' => $count_category, 'count_tag' => $count_tag, 'feature_image' => $fileName, 'user_id' => $id];
                // echo "added to folder"; exit();
                $blog->updatePost($array, $category, $tag, $pid,$postid);
                echo "true";
                //$insert = mysqli_query($conn, "INSERT into image (filename) VALUES ('$fileName')");

            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
        }


        echo $statusMsg;
    } else {
        $fileImage2 = $_POST['fileImage2'];
        $array = ['title' => $title, 'description' => $description, 'count_category' => $count_category, 'count_tag' => $count_tag, 'feature_image' => $fileImage2, 'user_id' => $id];
        // echo "added to folder"; exit();
        $blog->updatePost($array, $category, $tag, $pid,$postid);
        echo "true";
    }
}
exit;
