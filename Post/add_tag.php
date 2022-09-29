<?php session_start(); ?>
<?php include_once('../Config/connection.php') ?>
<?php include_once('../App/function.php') ?>

<?php include_once('../header.php'); ?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 my-5">
        <div class="card-header" style="border-radius:10px ;">
        <h2 class="text-center fw-700 my-5 p-3">Add Tag</h2>
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
    document.title = "Blog-Tag";
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
        
            var data = new FormData();
            data.append('title', title2);
          
            var http = new XMLHttpRequest();

            var url = 'server_tag.php';
            http.open('POST', url, true);

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText == "true") {
                        alertify.alert('Ready to rock', 'Tag is added.', () => {
                            (window.location.href = "../display_category_tag.php")
                        });
                        // window.location.href = './index.php';
                        console.log(http.responseText);
                    } else {
                        alertify.alert('tag is not added.', () => {
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