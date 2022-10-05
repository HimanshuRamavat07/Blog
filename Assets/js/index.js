function myFun(e) {
    const name = e;
    data = new FormData();
    data.append('keyword', name);

    http = new XMLHttpRequest();
    url = 'search.php';

    http.open('POST', url, true);

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status ==200) {
          document. getElementById('viewData').innerHTML = http.responseText;
        }
    }
    http.send(data);
}

function myFun2(category) {
    
    val = category.split(',');
    data = new FormData();
    data.append('keyword', val[0]);
    data.append('category', val[1]);

    http = new XMLHttpRequest();
    url = 'search.php';

    http.open('POST', url, true);

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status ==200) {
          document. getElementById('viewData').innerHTML = http.responseText;
        }
    }
    http.send(data);
}

function myFun3(tag) {

    val = tag.split(',');
    data = new FormData();
    data.append('keyword', val[0]);
    data.append('tag', val[1]);

    http = new XMLHttpRequest();
    url = 'search.php';

    http.open('POST', url, true);

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status ==200) {
          document. getElementById('viewData').innerHTML = http.responseText;
        }
    }
    http.send(data);
}