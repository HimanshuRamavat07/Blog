<?php session_start(); ?>
<?php include_once('./header.php'); ?>
<div class="row" >
    <div class="col-md-2"></div>
    <div class="col-md-8 my-5">
        <div class="card-header" style="border-radius:10px ;">
            <form class=" mx-5 my-5" method="post" enctype="multipart/form-data">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="floatingTitle" name="title" placeholder="Add title" >
                    <label for="floatingTitle" class="form-label">Title</label>
                    <div id="title_error" class="form-text text-danger"></div>
                </div>
                <div class="mb-3 form-floating">
                    <textarea class="form-control" placeholder="Add blog description" id="floatingTextarea2" name="content" style="height: 400px" ></textarea>
                    <label for="floatingTextarea2">Description</label>
                    <div id="content_error" class="form-text text-danger"></div>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="category">
                        <option selected>Open this select menu</option>
                        <option value="1">Information & technology</option>
                        <option value="2">knowledge</option>
                        <option value="3">Travelling</option>
                    </select>
                    <label for="floatingSelect">Choose Blog category</label>
                </div>
                <div class="mb-3">
                    <label for="formFileLg" class="form-label">Add feature image of blog</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="fileImage">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-secondary " name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>


<?php include_once('./footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    include_once('./Config/connection.php');
    include_once('./App/function.php');
    $blog = new Blog();
    $statusMsg = '';
    extract($_POST);
    // File upload path
    if(empty($title)) {
        ?> <script>document.getElementById('title_error').innerHTML = "Please Enter Title";</script> <?php
    }
    if(empty($content)) {
        ?> <script>document.getElementById('content_error').innerHTML = "Please Enter Description";</script> <?php
    }
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
                $blog->addPost($title, $content,$category, $fileName);
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
?>