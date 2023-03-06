// Récupération du formulaire et ajout d'un écouteur d'événement sur l'événement "submit"
document.getElementById("inscription-form").addEventListener("submit", function(event) {
    // Empêche le comportement par défaut du formulaire (rechargement de la page)
    event.preventDefault();

    // Création de l'objet XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Préparation de la requête POST avec les données du formulaire
    xhr.open("POST", "register.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        // Redirection vers la page de connexion une fois l'inscription réussie
        if (xhr.status === 200 && xhr.responseText === "Inscription réussie !") {
            window.location.href = "login.php";
        }
    };

    // Envoi de la requête avec les données du formulaire
    var formData = new FormData(document.getElementById("inscription-form"));
    xhr.send(formData);
});