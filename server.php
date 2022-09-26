<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    extract($_POST);
    include_once('./Config/connection.php');
    include_once('./App/function.php');
    $blog = new Blog();
    $id = $_SESSION['id'];
        $statusMsg = "";
        $targetDir = "./Upload/";
        $fileName = basename($_FILES["fileImage"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (!empty($_FILES["fileImage"]["name"])) {
            // Allow certain file formats
            // echo $title;
            // echo $content;
            $allowTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $targetFilePath)) {
                    // Insert image file name into database
                    // echo "added to folder"; exit();
                    $blog->addPost($id,$title, $content, $option, $fileName);
                    echo "succesfully inserted ";
                    //$insert = mysqli_query($conn, "INSERT into image (filename) VALUES ('$fileName')");

                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

        // Display status message
        echo $statusMsg;
    }
exit;
