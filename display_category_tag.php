<?php session_start(); ?>
<?php
if (!isset($_SESSION['user'])) {
    header('location:./login.php');
}
?>
<?php include_once('./Config/connection.php') ?>
<?php include_once('./App/function.php') ?>

<?php include_once('./header.php'); ?>
<div class="row">
    <div class="d-flex justify-content-center mx-5">

        <h2 class="text-center fw-700 p- "><span class="card-title"> Display Category & Tag </span> </h2>
        <div class="btn-group mx-5">
            <button class="btn btn-outline-secondary  btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="dropdown" data-placement="right">
                Add Category & Tag
            </button>
            <ul class="dropdown-menu my-1 text-center p-1  " style="width: 240px; ">
                <li><a class="dropdown-item d-flex justify-content-center" href="./Post/add_category.php">Add Category</a></li>
                <li><a class="dropdown-item d-flex justify-content-center" href="./Post/add_tag.php">Add Tag</a></li>
            </ul>
        </div>

    </div>
    <div class="col-md-6 my-5">
        <div class="card-header" style="border-radius:10px ;">
            <h2 class="text-center fw-700 my-5 p-3">Category</h2>
            <form class=" mx-5 my-5" method="post" id="frmdata1">
                <table class="table table-hover text-center">
                    <tr>
                        <th>Sr.</th>
                        <th>Category Name</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php $category1 = new Blog();
                    $category2 = $category1->catagoryRead();
                    $count = 0;
                    while ($category = $category2->fetch_array()) {
                        $count++; ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $category['category_title']; ?></td>
                            <td><a href="./Post/update.php?c_uid=<?php echo $category['category_id']; ?>"><i class="bi bi-pencil-square mx-3"></i></a> ||
                                <a href="./display_category_tag.php?c_did=<?php echo $category['category_id']; ?>"><i class="bi bi-trash mx-3"></i></a>
                            </td>

                        </tr>
                    <?php   }   ?>

                </table>

            </form>
        </div>
    </div>

    <div class="col-md-6 my-5">
        <div class="card-header" style="border-radius:10px ;">
            <h2 class="text-center fw-700 my-5 p-3">Tag</h2>
            <form class=" mx-5 my-5" method="post" id="frmdata">
                <table class="table table-hover text-center">
                    <tr>
                        <th>Sr.</th>
                        <th>Tag Name</th>
                        <th colspan="2">Action</th>

                    </tr>
                    <?php $tag1 = new Blog();
                    $tag2 = $tag1->tagRead();
                    $count = 0;
                    while ($tag = $tag2->fetch_array()) {
                        $count++; ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $tag['tag_name']; ?></td>
                            <td><a href="./Post/update.php?t_uid=<?php echo $tag['tag_id']; ?>"><i class="bi bi-pencil-square mx-3"></i></a> ||
                                <a href="./display_category_tag.php?t_did=<?php echo $tag['tag_id']; ?>"><i class="bi bi-trash mx-3"></i></a>
                            </td>

                        </tr>
                    <?php   }   ?>
                </table>
            </form>
        </div>
    </div>

</div>

<script>
    document.title = "Blog-Display";
</script>
<?php include_once('./footer.php'); ?>


<?php if (isset($_GET['c_did'])) {
    $id = $_GET['c_did']; ?>
    <script>
        alertify.confirm('Confirm Title', 'Are you sure !!', function() {

            var data = new FormData();
            data.append('id', <?php echo $id; ?>);

            var http = new XMLHttpRequest();

            var url = './Post/delete.php?c_did=<?php echo $id; ?>';
            http.open('POST', url, true);

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText == "true") {
                        alertify.alert('Ready to rock', 'category is deleted.', () => {
                            (window.location.href = "./display_category_tag.php")
                        });
                        // window.location.href = './index.php';
                        console.log(http.responseText);
                    } else {
                        alertify.alert('category is not deleted.', () => {
                            (alertify.set('notifier', 'position', 'top-right'), alertify.error('Try again.'))
                        });
                        console.log(http.responseText);
                    }
                }
            }
            http.send(data);

        }, function() {
            window.location.href = "./display_category_tag.php";

        });
    </script>

<?php } ?>
<?php if (isset($_GET['t_did'])) {
    $id = $_GET['t_did']; ?>
    <script>
        alertify.confirm('Confirm Title', 'Are you sure !!', function() {

            var data = new FormData();
            data.append('id', <?php echo $id; ?>);

            var http = new XMLHttpRequest();

            var url = './Post/delete.php?t_did=<?php echo $id; ?>';
            http.open('POST', url, true);

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText == "true") {
                        alertify.alert('Ready to rock', 'tag is deleted.', () => {
                            (window.location.href = "./display_category_tag.php")
                        });
                        // window.location.href = './index.php';
                        console.log(http.responseText);
                    } else {
                        alertify.alert('tag is not deleted.', () => {
                            (alertify.set('notifier', 'position', 'top-right'), alertify.error('Try again.'))
                        });
                        console.log(http.responseText);
                    }
                }
            }
            http.send(data);

        }, function() {
            window.location.href = "./display_category_tag.php";

        });
    </script>

<?php } ?>

<!-- 

Good afternoon, Respected sir/ma'am.

I want to tell you that the Gujarat government is hosting the Azadi Ka Amrit Mahotsav Hackathon in 2022. Since I am participating in this event and the Team Regional Round will be placed in GEC Bhavnagar, I will need to take one day's leave on October 7, 2022.

Reason: Attending the 7-10-2022 Azadi Ka Amrit Mahotsav Hackathon.  -->