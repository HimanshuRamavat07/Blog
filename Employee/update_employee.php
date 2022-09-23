<?php
session_start();
include '../Config/connection.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}
$id = $_REQUEST['uid'];

$q = "SELECT * FROM `tbl_employee` WHERE emp_id= '$id'";
$run = mysqli_query($conn, $q);
$fetch = mysqli_fetch_assoc($run);

$hobby = explode(",", $fetch['emp_hobby']);
$date = date('Y-m-d');
?>

<?php include '../header.php'; ?>
<div class="container my-3">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h3 class="text-center text-capitalize">Update Profile</h3>
        <input type="hidden" name="eid" value="<?php echo $fetch['emp_id'];  ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">First name</label>
            <input type="text" name="fname" value="<?php echo $fetch['emp_fname'];  ?>" class="form-control">
            <div id="ferror" class="form-text text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" name="lname" value="<?php echo $fetch['emp_lname'];  ?>" class="form-control">
            <div id="lerror" class="form-text text-danger"></div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                <textarea name="address" class="form-control" style="height: 100px">
                    <?php echo $fetch['emp_add'];  ?>
                </textarea>
                <div id="add_error" class="form-text text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" <?php if ($fetch['emp_gen'] == "M") {
                                                                                                            echo "checked";
                                                                                                        } ?> Value="M">
                    <label class="form-check-label" for="flexRadioDefault1">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" <?php if ($fetch['emp_gen'] == "F") {
                                                                                                            echo "checked";
                                                                                                        } ?> value="F">
                    <label class="form-check-label" for="flexRadioDefault2">Female</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo $fetch['emp_email'];  ?>" class="form-control">
                <div id="email_error" class="form-text text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input type="password" name="pwd" value="<?php echo $fetch['emp_password'];  ?>" class="form-control">
                <div id="email_error" class="form-text text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Date Of Birth</label>
                <input type="date" name="dob" max="<?php echo $date; ?>" value="<?php echo $fetch['emp_dob'];  ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Hobby</label>
                <div class="form-check">
                    <input class="form-check-input" name="hobby[]" type="checkbox" value="reading" id="flexCheckDefault" <?php if (in_array("reading", $hobby)) {
                                                                                                                                echo 'checked="checked"';
                                                                                                                            } ?>>
                    <label class="form-check-label" for="flexCheckDefault">Reading</label>
                </div>
                <input class="form-check-input" name="hobby[]" type="checkbox" value="writing" id="flexCheckChecked" <?php if (in_array("writing", $hobby)) {
                                                                                                                            echo 'checked="checked"';
                                                                                                                        } ?>>
                <label class="form-check-label" for="flexCheckChecked">Writing</label>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">HSC %</label>
                <input type="number" name="mark" class="form-control" id="exampleInputPassword1" value="<?php echo $fetch['emp_hsc'];  ?>">
                <div id="mark_error" class="form-text text-danger"></div>
                <div class="d-flex justify-content-between my-4 ">
                    <button type="submit" name="update_emp" class="btn btn-success">Update</button>
                    <button class="btn btn-lg btn-info" type="button">
                        <a href="../index.php" style="text-decoration: none; color:black"> Go to Home Page</a>
                    </button>
                </div>
            </div>
    </form>
</div>

</div>
<?php include '../footer.php' ?>

<?php
if (isset($_POST['update_emp'])) {

    extract($_POST);
    $msg = "";
    $name = "";
    if (is_array($hobby) || is_object($hobby)) {
        foreach ($hobby as $name1) {
            $name .= $name1 . ",";
        }
    }
    if (empty($fname)) {
?>
        <script>
            $er = document.getElementById('ferror').innerText = "Please Enter First Name";
        </script>
    <?php
        $msg = "error";
    } else {
        $fname = $fname;
    }

    if (empty($lname)) {
    ?>
        <script>
            $er = document.getElementById('lerror').innerText = "Please Enter Last Name";
        </script>

    <?php
        $msg = "error";
    } else {
        $lname = $lname;
    }

    if (empty($address)) {
    ?>
        <script>
            $er = document.getElementById('add_error').innerText = "Please Enter address";
        </script>
    <?php
        $msg = "error";
    } else {
        $address = $address;
    }

    if (empty($email)) {
    ?>
        <script>
            $er = document.getElementById('email_error').innerText = "Please Enter Email";
        </script>
    <?php
        $msg = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ?>
        <script>
            $er = document.getElementById('email_error').innerText = "Invalid Email";
        </script>
    <?php
        $msg = "error";
    } else {
        $email = $email;
    }

    if (empty($mark)) {
    ?>
        <script>
            $er = document.getElementById('mark_error').innerText = "Please Enter Mark";
        </script>
    <?php
        $msg = "error";
    } elseif ($mark < 35 || $mark > 100) {
    ?>
        <script>
            document.getElementById('mark_error').innerText = "Enter Mark should be more than 35 and not more than 100";
        </script>
<?php
        $msg = "error";
    } else {
        $mark = $mark;
    }

    if (empty($msg)) {
        include '.function.php';
        updatedata($fname, $lname, $address, $gender, $email, $pwd, $dob, $name, $mark, $eid);
    }
}

?>