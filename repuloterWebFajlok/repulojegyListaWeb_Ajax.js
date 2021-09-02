var szuro = document.querySelector('form');

szuro.onsubmit = function(e){  
  e.preventDefault();

  var action = szuro.getAttribute("action");

  document.getElementById('tartalom').innerHTML = '';
  

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('tartalom').innerHTML = this.responseText;
      szuro.reset();
    }
  };

  xhr.open(szuro.getAttribute("method"), action, true);
  xhr.send(new FormData(szuro));
}