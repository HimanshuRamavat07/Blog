<?php
session_start();

?>

<?php include './header.php'; ?>

<!-- Section: Design Block -->
<section class="text-center text-lg-start">
    <style>
        body{
            overflow: hidden;
        }
        .cascading-right {
            margin-right: -50px;
        }

        @media (max-width: 991.98px) {
            .cascading-right {
                margin-right: 0;
            }
        }
    </style>

    <!-- Jumbotron -->
    <div class="container new py-4" >
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card cascading-right shadow p-3 mb-5 bg-white rounded" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
                    <div class="card-body p-5 shadow-5 text-center">
                        <h2 class="fw-bold mb-5">Login</h2>
                        <form method="post">
                    
                            <!-- Email input -->
                            <div class="mb-3 form-floating my-4">
                                <input type="email" id="form3Example3" class="form-control" placeholder="Enter Email" name="email"/>
                                <label class="form-label" for="form3Example3">Email address</label>
                            </div>

                            <!-- Password input -->
                            <div class="mb-3 form-floating my-4">
                                <input type="password" id="form3Example4" class="form-control" placeholder="Enter Password" name="password"/>
                                <label class="form-label" for="form3Example4">Password</label>
                            </div>

                            <!-- Submit button -->
                            <input type="submit" class="btn btn-secondary btn-block mb-4" name="submit" value="Sign in">
                                
                        
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4" alt="" />
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
</div>
<script>document.title = "Blog-Login";</script>
<?php include './footer.php' ?>
<script>
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
<?php
if (isset($_POST['submit'])) {
    include_once './Config/connection.php';
    include_once('./App/function.php');

    extract($_POST);
    $blog = new Blog();
    $signin = $blog->signin($email);
    
    $row = $signin->fetch_assoc();
    if ($signin->num_rows > 0) {
        if ($password == $row['user_password']) {
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['user'] = $row['user_name'];
            $_SESSION['type'] = $row['type'];
            
?>
            <script>
                alertify.alert('Welcome  <?php echo $row['user_name']; ?> :' ,"successfully login",()=>{(window.location.href = "./index.php")});
                
            </script>
           
        <?php
        } else {
        ?>
            <script>
                 alertify.alert('This page says: ','Enter correct password!', function(){ alertify.error('try again'); });
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alertify.alert('This page says: ',"Check your Email ",function(){ alertify.error('try again'); });
        </script>
<?php
    }
}
?>