<?php
session_start();

?>

<?php include '../header.php'; ?>
<div id="intro-example" class="p-5 text-center bg-image mb-5">
    <div class="mask">
        <div class="d-flex justify-content-center align-items-center h-100 mb-5" style="padding: 100px;">
            <div class="text-white">
                <h1 class="mb-3 my-5">Register</h1>
                <form method="post">
                    <h3 class="text-center text-capitalize my-5"> </h3>
                    <div class="mb-3 my-3">
                        <input type="text" name="user" id="user" placeholder="Enter Name" class="form-control">
                    </div>
                    <div class="mb-3 my-3">
                        <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control">
                    </div>
                    <div class="mb-3 my-3">
                        <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
                    </div>
                    <select class="form-select" aria-label="Default select example" name="role">
                        <option selected>Choose your role</option>
                        <option value="1">Admin</option>
                        <option value="2">Project Leader</option>
                        <option value="3">Group Leader</option>
                        <option value="4">Group Member</option>
                    </select>
                    <input type="submit" class="btn btn-outline-light btn-lg m-2 my-3 mb-5" value="Sign-up" name="signup">
                    <h5 class="text-center ">Already have an account ? <a href="../login.php">Click here</a></h5>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include '../footer.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
</body>

</html>

<?php
if (isset($_POST['signup'])) {
    include './Config/connection.php';

    extract($_POST);

    if (!empty($user) || !empty($password) || !empty($email)) {


        $pass = md5($password);
        $query = "INSERT INTO `tbl_employee` (`emp_fname`, `emp_email`, `emp_password`,`type`) VALUES ('$user','$email','$pass','$role')";
        $run = mysqli_query($conn, $query);

        if ($run) {

?>
            <script>
                alert("successfully Register");
                window.location.href = "../login.php";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("error in registration ");
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("Enter all details ");
        </script>
<?php
    }
}
?>