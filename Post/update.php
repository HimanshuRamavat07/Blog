<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>

<?php include_once('../header.php'); ?>

<?php if (isset($_GET['c_uid'])) {
    $id = $_GET['c_uid']; ?>
    <?php $blog = new Blog();
    $sql = "SELECT * FROM `category` WHERE `category_id`='$id'";
    $category = $blog->conn->query($sql);
    $data = $category->fetch_assoc();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 my-5">
            <div class="card-header" style="border-radius:10px ;">
                <h2 class="text-center fw-700 my-5 p-3">Update Category</h2>
                <form class=" mx-5 my-5" action="javascript:void(0);" id="frmdata">
                    <div class="mb-3 form-floating">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" id="uid">
                        <input type="text" class="form-control" id="floatingTitle" name="title" value="<?php echo $data['category_title']; ?>">
                        <label for="floatingTitle" class="form-label"></label>
                        <div id="title_error" class="form-text text-danger"></div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-secondary" id="submit" name="submit" onclick="submitFormData()">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
<?php } ?>

<?php if (isset($_GET['t_uid'])) {
    $id = $_GET['t_uid']; ?>
    <?php $blog = new Blog();
    $sql = "SELECT * FROM `tag` WHERE `tag_id`='$id'";
    $tag = $blog->conn->query($sql);
    $data = $tag->fetch_assoc();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 my-5">
            <div class="card-header" style="border-radius:10px ;">
                <h2 class="text-center fw-700 my-5 p-3">Update Tag</h2>
                <form class=" mx-5 my-5" action="javascript:void(0);" id="frmdata1">
                    <div class="mb-3 form-floating">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" id="did">
                        <input type="text" class="form-control" id="floatingTitle" name="title" value="<?php echo $data['tag_name']; ?>">
                        <label for="floatingTitle" class="form-label">Title</label>
                        <div id="title_error" class="form-text text-danger"></div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-secondary" id="submit" name="submit" onclick="submitFormData2()">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
<?php } ?>
<script>
    document.title = "Blog-Update";
</script>
<?php include_once('../footer.php'); ?>

<script>
    let title = document.getElementById('floatingTitle');
    title.addEventListener('focusout', nameCheck);

    msg = "ww";

    function nameCheck() {
        if (title.value.length < 3) {
            document.getElementById('title_error').innerHTML = "Name must be contain 3 character";
            msg = "error";

        } else {
            document.getElementById('title_error').innerHTML = "";
            msg = "";
        }
    }

    function submitFormData() {

        if (msg == "") {

            var title2 = title.value;
            var uid = document.getElementById('uid').value;

            var data = new FormData();
            data.append('title', title2);
            data.append('id', uid);

            var http = new XMLHttpRequest();

            var url = 'update_category.php';
            http.open('POST', url, true);

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText == "true") {
                        alertify.alert('Ready to rock', 'Category is Updated.', () => {
                            (window.location.href = "../display_category_tag.php")
                        });
                        // window.location.href = './index.php';
                        console.log(http.responseText);
                    } else {
                        alertify.alert('Category is not Updated.', () => {
                            (alertify.set('notifier', 'position', 'top-right'), alertify.error('fill all details'))
                        });
                        console.log(http.responseText);
                    }
                }
            }
            http.send(data);
        } else {
            alertify.alert('Enter first data', () => {
                (alertify.set('notifier', 'position', 'top-right'), alertify.error('fill all details'))
            });
        }

    }

    function submitFormData2() {

        if (msg == "") {

            var title2 = title.value;
            var did = document.getElementById('did').value;

            var data = new FormData();
            data.append('title', title2);
            data.append('id', did);

            var http = new XMLHttpRequest();

            var url = 'update_tag.php';
            http.open('POST', url, true);

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText == "true") {
                        alertify.alert('Ready to rock', 'Tag is Updated.', () => {
                            (window.location.href = "../display_category_tag.php")
                        });
                        // window.location.href = './index.php';
                        console.log(http.responseText);
                    } else {
                        alertify.alert('Tag is not Updated.', () => {
                            (alertify.set('notifier', 'position', 'top-right'), alertify.error('fill all details'))
                        });
                        console.log(http.responseText);
                    }
                }
            }
            http.send(data);
        } else {
            alertify.alert('Enter first data', () => {
                (alertify.set('notifier', 'position', 'top-right'), alertify.error('fill all details'))
            });
        }

    }
</script>