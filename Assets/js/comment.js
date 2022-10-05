function submitComment() {

    var content = document.getElementById('textAreaExample').value;

    if (content.length >= 3) {

        var uid = document.getElementById('uid').value;
        var pid = document.getElementById('pid').value;
        var slug = document.getElementById('slug').value;

        console.log(uid+","+pid+","+slug)

        var data = new FormData();
        data.append('content', content);
        data.append('uid', uid);
        data.append('pid', pid);

        var http = new XMLHttpRequest();

        var url = 'comment.php';
        http.open('POST', url, true);

        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                if (http.responseText == "true") {
                    alertify.alert('Ready to rock', 'Comment is added.', () => {
                        (window.location.href = "http://localhost/Himanshu/Blog" + slug)
                    });
                    // window.location.href = './index.php';
                    console.log(http.responseText);
                } else {
                    alertify.alert('Comment is not added.', () => {
                        (alertify.set('notifier', 'position', 'top-right'), alertify.error('Try again.'))
                    });
                    console.log(http.responseText);
                }
            }
        }

        http.send(data);
    } else {

        alertify.alert('Enter minimum 3 character.', () => {
            (alertify.set('notifier', 'position', 'top-right'), alertify.error('Try again.'))
        });
    }


}