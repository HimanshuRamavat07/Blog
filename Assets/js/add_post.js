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

$(".js-example-basic-multiple1").select2();
$(".js-example-basic-multiple2").select2();

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
        // console.log(editor_content);

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