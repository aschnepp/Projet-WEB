function submitForm(event) {


    event.preventDefault();

    var formData = new FormData(document.getElementById("formulaire"));

    for (const value of formData.values()) {
        console.log(value);
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../model/GestionEntreprises.php", true);
    xhr.send(formData);

    console.log(formData);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText) {
                    alert('Requête bien effectuée sans problèmes.');
                }
            } else {
                console.log(xhr.responseText);
                alert("Erreur");
            }
        }
    };
}
