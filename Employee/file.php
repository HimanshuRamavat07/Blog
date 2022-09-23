<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="justify-content-center">
                <form method="post" enctype="multipart/form-data">
                    <label for=""> <h3>Select Image File to Upload:</h3></label>
                    <input type="file" name="file" class="form-control my-3">
                    <input type="submit" name="submit" value="Upload" class="btn btn-success my-2">
                </form>
            </div>
        </div>
    </div>
<!-- Modal gallery -->
<section class="container container-fluid">
    <!-- Section: Images -->
    <section class="">
        <h3 class="text-center">Gallery</h3>
        <div class="row">
            <?php 
            include "../Config/connection.php";
            $q = "SELECT * FROM `image`";
            $run = mysqli_query($conn,$q);
            while($data = mysqli_fetch_assoc($run)){
                ?>
    <div class="container col-lg-4 col-md-12 mb-4 mb-lg-0 mb-3 my-3">
                <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
                    <img src="../Upload/<?php echo $data['filename'] ?>" width="50%" height="200px"/>
                    <a href="#!" data-mdb-toggle="modal" data-mdb-target="#exampleModal1">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                    </a>
                </div>
            </div>

<?php
            }

            ?>
         

        </div>
    </section>
    <!-- Section: Images -->

    <!-- Section: Modals -->
    
    <!-- Section: Modals -->
</section>
<!-- Modal gallery -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>

<?php
// Include the database configuration file
if (isset($_POST['submit'])) {


    include '../Config/connection.php';
    $statusMsg = '';

    // File upload path
    $targetDir = "../Upload/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $insert = mysqli_query($conn, "INSERT into image (filename) VALUES ('$fileName')");
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    echo $statusMsg;
}
?>

