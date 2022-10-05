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

        var url = 'server_category.php';
        http.open('POST', url, true);

        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                if (http.responseText == "true") {
                    alertify.alert('Ready to rock', 'Category is created.', () => {
                        (window.location.href = "../display_category_tag.php")
                    });
                    // window.location.href = './index.php';
                    console.log(http.responseText);
                } else {
                    alertify.alert('Category is not  created.', () => {
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