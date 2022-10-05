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
$tagFilter = $blog->tagRead($id);
$tag = $blog->tagRead();
$result = $read->fetch_assoc();
$str = "";
$str2 = "";

while ($readCategory = $categoryFilter->fetch_assoc()) {
    $str .= $readCategory['category_title'] . ",";
}

while ($readTag = $tagFilter->fetch_assoc()) {
    $str2 .= $readTag['tag_name'] . ",";
}


$data = explode(',', $str);
$data2 = explode(',', $str2);


?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 my-5">
        <div class="card-header" style="border-radius:10px ;">
            <form class=" mx-5 my-5" enctype="multipart/form-data" action="javascript:void(0);" id="frmdata">
                <div class="mb-3 form-floating">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $id ?>">
                    <input type="hidden" name="postid" id="postid" value="<?php echo $result['post_id']; ?>">
                    <input type="text" class="form-control" id="floatingTitle" name="title" value="<?php echo $result['title']; ?>" onfocusout="validation(this.value,'title_error')">
                    <label for="floatingTitle" class="form-label">Title</label>
                    <div id="title_error" class="form-text text-danger"></div>
                </div>
                <div class="mb-3 form-floating form-control" id="editor" style="height: 300px" name="content">
                    <p><?php echo $result['description']; ?></p>
                </div>
                <div class=" mb-3">
                    <label for="floatingSelect " class="form-label">Choose Blog category</label>
                    <select class="js-example-basic-multiple2 form-select" multiple="multiple" id="floatingSelect" aria-label=" label select example" name="category">
                        <?php while ($category2 = $category->fetch_assoc()) {
                            if (in_array($category2['category_title'], $data)) { ?>

                                <option value="<?php echo $category2['category_id']; ?>" selected><?php echo $category2['category_title']; ?></option>

                            <?php  } else { ?> <option value="<?php echo $category2['category_id']; ?>">
                                    <?php echo $category2['category_title']; ?></option> <?php }
                                                                                    } ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="floatingSelect2" class="form-label">Tag</label>

                    <select class="js-example-basic-multiple1 form-select" multiple="multiple" id="floatingSelect2" aria-label=" label select example" name="tag">
                        <?php while ($tag2 = $tag->fetch_assoc()) {
                            if (in_array($tag2['tag_name'], $data2)) { ?>

                                <option value="<?php echo $tag2['tag_id']; ?>" selected><?php echo $tag2['tag_name']; ?></option>

                            <?php  } else { ?> <option value="<?php echo $tag2['tag_id']; ?>">
                                    <?php echo $tag2['tag_name']; ?></option> <?php }
                                                                        } ?>

                    </select>
                </div>
                <div class="row">
                    <div class="m-3 col-md-3">
                        <img src="../Upload/<?php echo $result['feature_image']; ?>" alt="" width="250px" height="150px">
                    </div>

                    <div class="mb-3 my-5 col-md-8">

                        <label for="formFileLg" class="form-label">Add feature image of blog</label>
                        <input type="hidden" name="fileImage1" id="fileImage" value="<?php echo $result['feature_image']; ?>">
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
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>
<script type="text/javascript">
    $(".js-example-basic-multiple1").select2();
    $(".js-example-basic-multiple2").select2();
</script>
<script src="../Assets/js/update_post.js"></script>