<?php session_start(); ?>
<?php include_once('../header.php'); 
// echo  $_SERVER['PHP_SELF'];
?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 my-5">
        <div class="card-header" style="border-radius:10px ;">
            <form class=" mx-5 my-5"  enctype="multipart/form-data" action="javascript:void(0);" id="frmdata" onsubmit="submitFormData(this)">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="floatingTitle" name="title" placeholder="Add title">
                    <label for="floatingTitle" class="form-label">Title</label>
                    <div id="title_error" class="form-text text-danger"></div>
                </div>
                <div class="mb-3 form-floating">
                    <textarea class="form-control" placeholder="Add blog description" id="floatingTextarea2" name="content" style="height: 400px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                    <div id="content_error" class="form-text text-danger"></div>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="category" required>
                        <option selected value="">Open this select menu</option>
                        <option value="1">Information & technology</option>
                        <option value="2">knowledge</option>
                        <option value="3">Travelling</option>
                    </select>
                    <label for="floatingSelect">Choose Blog category</label>
                    <!-- <div id="checkbox_error" class="form-text text-danger"></div> -->
                </div>
                <div class="mb-3">
                    <label for="formFileLg" class="form-label">Add feature image of blog</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="fileImage">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-secondary " name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>


<?php include_once('../footer.php'); ?>
<script>
    let title = document.getElementById('floatingTitle');
    title.addEventListener('focusout', nameCheck);
    let content = document.getElementById('floatingTextarea2');
    content.addEventListener('focusout', contentCheck);
   
    function nameCheck() {
        if (title.value.length < 3) {
            document.getElementById('title_error').innerHTML = "minimum 3 character";
            // content.style.display ="none";
        } else {
            document.getElementById('title_error').innerHTML = "";
            // content.style.display ="";
        }
    }

    function contentCheck() {
        if (content.value.length < 3) {
            document.getElementById('content_error').innerHTML = "minimum 3 character";
            // content.style.display ="none";
        } else {
            document.getElementById('content_error').innerHTML = "";
            // content.style.display ="";
        }
    }


    function submitFormData(event) {

        // form values
        var title = event.title.value;
        var content = event.content.value;
        var category = event.category.value;
        var fileImage = event.fileImage.files[0];

        var data = new FormData();
        data.append('title', title);
        data.append('content', content);
        data.append('option', category);
        data.append('fileImage', fileImage);

        var http = new XMLHttpRequest();

        var url = 'server.php';
        http.open('POST', url, true);

        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                alertify.alert('Post is created.',()=>{(window.location.href = "./index.php")});
                // window.location.href = './index.php';
                console.log(http.responseText);
            }
        }
        http.send(data);
    }
</script>
