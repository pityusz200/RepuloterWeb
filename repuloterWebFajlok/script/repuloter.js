var button = document.getElementById("Szuro");

button.onclick = function() {
          var x = document.getElementById("Szurok");

          if (x.style.display === "block") {
            x.style.display = "none";
          } else {
            x.style.display = "block";
          }       
        }