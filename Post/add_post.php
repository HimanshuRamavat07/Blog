<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>

<?php include_once('../header.php'); ?>
<script src="../Assets/js/index.js"></script>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 my-5">
        <div class="card-header" style="border-radius:10px ;">
            <form class=" mx-5 my-5" enctype="multipart/form-data" action="javascript:void(0);" id="frmdata">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="floatingTitle" name="title" placeholder="Add title" onfocusout="validation(this.value,'title_error')">
                    <label for="floatingTitle" class="form-label">Title</label>
                    <div id="title_error" class="form-text text-danger"></div>
                </div>

                <div class="mb-3 form-floating form-control" id="editor" style="height: 400px" name="content">

                    <div id="content_error" class="form-text text-danger"></div>
                </div>
                <div class=" mb-3">
                    <label for="floatingSelect " class="form-label">Choose Blog category</label>
                    <select class="js-example-basic-multiple2 form-select" multiple="multiple" id="floatingSelect" aria-label=" label select example" name="category">
                        <?php $cat1 = new Blog();
                        $cat = $cat1->catagoryRead();
                        while ($category = $cat->fetch_array()) { ?>
                            <option value="<?php echo $category['category_id']; ?>" class="newselect"><?php echo $category['category_title']; ?></option>
                        <?php }   ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="floatingSelect2" class="form-label">Tag</label>
                    <select class="js-example-basic-multiple1 form-select" multiple="multiple" id="floatingSelect2" aria-label=" label select example" name="tag">
                        <?php $tag1 = new Blog();
                        $tag2 = $tag1->tagRead();
                        while ($tag = $tag2->fetch_array()) { ?>
                            <option value="<?php echo $tag['tag_id']; ?>"><?php echo $tag['tag_name']; ?></option>
                        <?php }   ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFileLg" class="form-label">Add feature image of blog</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="fileImage">
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
<script src="../Assets/js/add_post.js"></script>