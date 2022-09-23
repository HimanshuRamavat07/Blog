<?php
session_start();
include "../Config/connection.php";
$date = date('Y-m-d');

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}
?>

<?php include '../header.php';
$msg = ""; ?>

<div class="container my-1">
    <form method="post">

        <h3 class="text-center text-capitalize">first register your self</h3>

        <div class="form-row">
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">First name</label>
            <input type="text" name="fname" id="fname" placeholder="First name" class="form-control">
            <div id="ferror" class="form-text text-danger">
                <p></p><?php echo $msg ?>
            </div>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" name="lname" id="lname" placeholder="Last name" class="form-control">
            <div id="lerror" class="form-text text-danger">
                <p></p><?php echo $msg ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-3">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Address</label>
            <textarea id="address" name="address" class="form-control" style="height: 100px" placeholder="Address"></textarea>
            <div id="add_error" class="form-text text-danger">
                <p></p><?php echo $msg ?>
            </div>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="gender" id="flexRadioDefault1" Value="M">
                <label class="form-check-label" for="flexRadioDefault1">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="gender" id="flexRadioDefault2" value="F">
                <label class="form-check-label" for="flexRadioDefault2">Female</label>
            </div>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control">
            <div id="email_error" class="form-text text-danger">
                <p></p><?php echo $msg ?>
            </div>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Date Of Birth</label>
            <input type="date" id="dob" name="dob" min="2014-05-11" max="<?php echo $date; ?>" class="form-control">
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Hobby</label>
            <div class="form-check">
                <input class="form-check-input" name="hobby[]" id="hobby[]" type="checkbox" value="reading" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Reading</label>
            </div>
            <input class="form-check-input" name="hobby[]" id="hobby[]" type="checkbox" value="writing" id="flexCheckChecked">
            <label class="form-check-label" for="flexCheckChecked">Writing</label>
            
        </div>

        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">HSC %</label>
            <input type="number" name="mark" id="mark" class="form-control" id="exampleInputPassword1">
            <div id="mark_error" class="form-text text-danger">
                <p></p><?php echo $msg ?>
            </div>
        </div>
        
        <div class="d-flex justify-content-between mb-3">
            <input type="submit" id="submit" name="add_emp" class="btn btn-lg btn-outline-success" value="Submit details"></input>
            
            <button class="btn btn-lg btn-info" type="button">
                <a href="../index.php" style="text-decoration: none; color:black"> Go to Home Page</a>
            </button>
            
        </div>
        </div>
    </form>
</div>
<?php include '../footer.php' ?>

<?php
if (isset($_POST['add_emp'])) {
    extract($_POST);
    $msg = "";

    $name = "";
    if (is_array($hobby) || is_object($hobby)) {
        foreach ($hobby as $name1) {
            $name .= $name1 . ",";
        }
    }
    // echo $name;


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
        include './App/function.php';
        insertdata($fname, $lname, $address, $gender, $email, $dob, $name, $mark);
    }
}
?>