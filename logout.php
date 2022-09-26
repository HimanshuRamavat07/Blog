<?php
session_start();
session_destroy();
include 'header.php';
include 'footer.php';
?>
<script>
    alertify.alert("Thank You !!!! :","logged out", function(){ window.location.href = "./login.php"; });
   
</script>
