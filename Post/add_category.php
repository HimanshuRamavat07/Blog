<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>

<?php include_once('../header.php'); ?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 my-5">
        <div class="card-header" style="border-radius:10px ;">
        <h2 class="text-center fw-700 my-5 p-3">Add Category</h2>
            <form class=" mx-5 my-5" enctype="multipart/form-data" action="javascript:void(0);" id="frmdata">
            <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="floatingTitle" name="title" placeholder="Add title">
                    <label for="floatingTitle" class="form-label">Title</label>
                    <div id="title_error" class="form-text text-danger"></div>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-secondary" id="submit" name="submit" onclick="submitFormData()">Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<script>
    document.title = "Blog-Category";
</script>
<?php include_once('../footer.php'); ?>

<script src="../Assets/js/add_category.js"></script>