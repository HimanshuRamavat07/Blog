let value = "";
function validation(e,id) {
    value = e;
    if ( e  == undefined || e == null || e.length < 3 ) {
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

        var title2 =document.getElementById('floatingTitle').value;
        let category = $("#floatingSelect").val().toString();
        let categoryCount = $("#floatingSelect").val().length;
        let tag = $("#floatingSelect2").val().toString();
        let tagCount = $("#floatingSelect2").val().length;

        var fileImage2 = document.getElementById('fileImage').value;
        var uid = document.getElementById('uid').value;
        var postid = document.getElementById('postid').value;
   

        var editor_content = quill.root.innerHTML;
        var content = editor_content.replace(/["']/g, '');
        // console.log(str);

        var data = new FormData();
        data.append('uid', uid);
        data.append('postid', postid);
        data.append('title', title2);
        data.append('category', category);
        data.append('count_category', categoryCount);
        data.append('count_tag', tagCount);

        data.append('tag', tag);
        var Image = document.getElementById('formFileLg');
        data.append('description', content);

        if (Image.files[0] == undefined) {
            var fileImage2 = document.getElementById('fileImage').value;
            data.append('fileImage2', fileImage2);
        } else {
            var Image = document.getElementById('formFileLg').files[0].name;
            var fileImage = document.getElementById('formFileLg').files[0];
            data.append('fileImage', fileImage);

            data.append('Image', Image);
        }
       
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