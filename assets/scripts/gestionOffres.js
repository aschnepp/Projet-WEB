function submitForm(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById('formulaire'));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../model/GestionOffres.php", true);
    xhr.send(formData);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText) {
                    alert('Requête bien effectuée sans problèmes.');
                }
                window.location.href = "/index.php";
            } else {
                console.log(xhr.responseText)
                alert('Une ou plusieurs erreurs ont survenues, vérifier bien les champs.')
            }
        }
    };
}
