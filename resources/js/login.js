document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const toggleForm = document.getElementById("toggle-form");
    const formTitle = document.getElementById("form-title");

    toggleForm.addEventListener("click", function (event) {
        event.preventDefault();
        if (loginForm.classList.contains("d-none")) {
            loginForm.classList.remove("d-none");
            registerForm.classList.add("d-none");
            formTitle.textContent = "Connexion";
            toggleForm.textContent = "Créer un compte";
        } else {
            loginForm.classList.add("d-none");
            registerForm.classList.remove("d-none");
            formTitle.textContent = "Inscription";
            toggleForm.textContent = "Déjà un compte ? Se connecter";
        }
    });
});