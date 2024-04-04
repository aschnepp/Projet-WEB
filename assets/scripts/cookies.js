function connect(event) {
  event.preventDefault();

  var formData = new FormData(document.getElementById("myForm"));

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/controller/controllerLogin.php", true);
  xhr.send(formData);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        window.location.href = "/index.php";
      } else {
        console.log(xhr.responseText);
        alert("Connexion échouée");
      }
    }
  };
}

function disconnect(event) {
  event.preventDefault();

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/controller/controllerDisconnect.php", true);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        window.location.href = "/index.php";
      } else {
        console.log(xhr.responseText);
        alert("Déconnexion échouée");
      }
    }
  };
}
