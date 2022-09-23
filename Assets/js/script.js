function reqListener() {
  console.log(this.responseText);
}

const req = new XMLHttpRequest();
req.addEventListener('load', reqListener);
req.open('GET', 'http://bootboxjs.com/examples.html');
req.send();
