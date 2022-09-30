<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>

<?php include_once('../header.php'); ?>

<?php

$id = $_GET['uid'];
$blog = new Blog();
$read = $blog->readPost($id);
$categoryFilter = $blog->catagoryRead($id);
$category = $blog->catagoryRead();
$result = $read->fetch_assoc();
$str = "";

while ($readCategory = $category->fetch_assoc()) {
    $str .= $readCategory['category_title'] . ",";
}
echo $str;
$data = explode(',', $str);
echo "<br>";
print_r($data);

?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 my-5">
        <div class="card-header" style="border-radius:10px ;">
            <form class=" mx-5 my-5" enctype="multipart/form-data" action="javascript:void(0);" id="frmdata">
                <div class="mb-3 form-floating">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $id ?>">
                    <input type="text" class="form-control" id="floatingTitle" name="title" value="<?php echo $result['title']; ?>">
                    <label for="floatingTitle" class="form-label">Title</label>
                    <div id="title_error" class="form-text text-danger"></div>
                </div>
                <div class="mb-3 form-floating">
                    <textarea class="form-control" placeholder="Add blog description" id="floatingTextarea2" name="content" style="height: 400px"><?php echo $result['description']; ?></textarea>
                    <label for="floatingTextarea2">Description</label>
                    <div id="content_error" class="form-text text-danger"></div>
                </div>
                <div class=" mb-3">
                    <label for="floatingSelect " class="form-label">Choose Blog category</label>
                    <select class="js-example-basic-multiple2 form-select" multiple="multiple" id="floatingSelect" aria-label=" label select example" name="category">
                        <?php while ($category2 = $categoryFilter->fetch_assoc()) {
                            if (in_array($category2['category_title'], $data)) { ?>

                                <option value="<?php echo $category2['category_id']; ?>" selected><?php echo $category2['category_title']; ?></option>

                            <?php  } else { ?> <option value="<?php echo $category2['category_id']; ?>"><?php echo $category2['category_title']; ?></option> <?php }
                                                                                                                                                        } ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="floatingSelect2" class="form-label">Tag</label>
                    <?php $tags = explode(',', $result['tag']);   ?>
                    <select class="js-example-basic-multiple1 form-select" multiple="multiple" id="floatingSelect2" aria-label=" label select example" name="tag">

                        <?php $tag1 = new Blog();
                        $tag2 = $tag1->tagRead();
                        while ($tag = $tag2->fetch_array()) {
                            if (in_array($tag['tag_name'], $tags)) {
                        ?> <option value="<?php echo $tag['tag_name']; ?>" selected><?php echo $tag['tag_name']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $tag['tag_name']; ?>"><?php echo $tag['tag_name']; ?></option>
                        <?php }
                        }  ?>
                    </select>
                </div>
                <div class="row">
                    <div class="m-3 col-md-3">
                        <img src="../Upload/<?php echo $result['image']; ?>" alt="" width="250px" height="150px">
                    </div>

                    <div class="mb-3 my-5 col-md-8">

                        <label for="formFileLg" class="form-label">Add feature image of blog</label>
                        <input type="hidden" name="fileImage" value="<?php echo $result['feature_image']; ?>">
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="fileImage">
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-secondary" id="submit" name="submit" onclick="submitFormData()">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<script>
    document.title = "Blog-Post";
</script>
<?php include_once('../footer.php'); ?>
<script type="text/javascript">
    $(".js-example-basic-multiple1").select2();
    $(".js-example-basic-multiple2").select2();
</script>
<script>
    let title = document.getElementById('floatingTitle');
    title.addEventListener('focusout', nameCheck);
    let content = document.getElementById('floatingTextarea2');
    content.addEventListener('focusout', contentCheck);

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

    function contentCheck() {
        if (content.value.length < 3) {
            document.getElementById('content_error').innerHTML = "Description must be contain  3 character";
            msg = "error";
        } else {
            document.getElementById('content_error').innerHTML = "";
            msg = "";
        }
    }


    function submitFormData() {

        if (msg == "") {

            var uid = document.getElementById('uid').value;
            var title2 = title.value;
            var content2 = content.value;
            let category = $("#floatingSelect").val().toString();
            let tag = $("#floatingSelect2").val().toString();
            var fileImage = document.getElementById('formFileLg').files[0];

            var data = new FormData();
            data.append('title', title2);
            data.append('content', content2);
            data.append('category', category);
            data.append('fileImage', fileImage);
            data.append('tag', tag);

            var http = new XMLHttpRequest();

            var url = 'server.php?uid=' + uid;
            http.open('POST', url, true);

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText == "true") {
                        alertify.alert('Ready to rock', 'Post is Updated.', () => {
                            (window.location.href = "../index.php")
                        });
                        // window.location.href = './index.php';
                        console.log(http.responseText);
                    } else {
                        alertify.alert('Post is not Updated.', () => {
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