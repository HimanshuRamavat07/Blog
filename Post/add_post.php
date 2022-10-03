<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>

<?php include_once('../header.php'); ?>
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
<script>
    var quill = new Quill('#editor', {
        modules: {
            toolbar:  [
                [{
                    header: [1, 2, true]
                }],
                ['background','bold', 'italic', 'underline'],
                ['color','font','code','link','size','strike','script'],
                [ 'code-block','blockquote','list','align','direction'],
                ['image']
            ]
        },
        placeholder: 'Compose an epic...',
        theme: 'snow'
    });
</script>
<script type="text/javascript">
    $(".js-example-basic-multiple1").select2();
    $(".js-example-basic-multiple2").select2();
</script>
<script>
    let value = "";

    function validation(e, id) {
        value = e;
        if (e == undefined || e == null || e.length < 3) {
            document.getElementById(id).innerHTML = "Name must be contain 3 character";
            msg = "error";

        } else {
            document.getElementById(id).innerHTML = "";
            msg = "";
        }
    }


    msg = "ww";


    function submitFormData() {

        if (msg == "") {

            var title2 = document.getElementById('floatingTitle').value;
            let category = $("#floatingSelect").val().toString();
            let categoryCount = $("#floatingSelect").val().length;
            let tag = $("#floatingSelect2").val().toString();
            let tagCount = $("#floatingSelect2").val().length;
            var fileImage = document.getElementById('formFileLg').files[0];
            var Image = document.getElementById('formFileLg').files[0].name;

            var editor_content = quill.root.innerHTML;
             var content = editor_content.replace(/["']/g, '');
            console.log(editor_content);

            var data = new FormData();
            data.append('title', title2);
            data.append('category', category);
            data.append('count_category', categoryCount);
            data.append('count_tag', tagCount);
            data.append('fileImage', fileImage);
            data.append('Image', Image);
            data.append('tag', tag);
            data.append('description', content);

            var http = new XMLHttpRequest();

            var url = 'server.php';
            http.open('POST', url, true);

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText == "true") {
                        alertify.alert('Ready to rock', 'Post is created.', () => {
                            (window.location.href = "../index.php")
                        });
                        // window.location.href = './index.php';
                        console.log(http.responseText);
                    } else {
                        alertify.alert('Post is not  created.', () => {
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