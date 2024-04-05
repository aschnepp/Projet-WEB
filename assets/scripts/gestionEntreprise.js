function submitForm(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById("formulaire"));

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../model/GestionEntreprises.php", true);
    xhr.send(formData);
    
    console.log(formData);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
            } else {
                console.log(xhr.responseText);
                alert("Erreur");
            }
        }
    };
}
