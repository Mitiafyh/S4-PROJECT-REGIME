document.addEventListener("DOMContentLoaded", () => {
    initPasswordToggles();

    const form = document.querySelector("#registerForm");
    const username = document.querySelector("#username");
    const email = document.querySelector("#email");
    const password = document.querySelector("#password");

    username.addEventListener("blur", () => {

        if (username.value.trim().length < 3) {
            setError(username, "usernameError", "Au moins 3 caractères.");
        }
        else {
            setSuccess(username, "usernameError");
        }

    });


    email.addEventListener("blur", () => {

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regex.test(email.value)) {
            setError(email, "emailError", "Email invalide.");
        }
        else {
            setSuccess(email, "emailError");
        }

    });



    password.addEventListener("keyup", () => {
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!regex.test(password.value)) {
            setError(password, "passwordError", "8 caractères minimum, 1 majuscule, 1 minuscule et 1 chiffre.");
        }
        else {
            setSuccess(password, "passwordError");
        }

    });



    form.addEventListener("submit", (e) => {
        let valid = true;
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (username.value.trim().length < 3) {
            setError(username, "usernameError", "Au moins 3 caractères.");
            valid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email.value)) {
            setError(email, "emailError", "Email invalide.");
            valid = false;
        }


        if (!regex.test(password.value)) {
            setError(password, "passwordError", "Mot de passe trop faible.");
            valid = false;
        }
        if (!valid) {
            e.preventDefault();
        }

    });

});

function initPasswordToggles() {
    const toggles = document.querySelectorAll("[data-password-toggle]");
    if (!toggles.length) {
        return;
    }

    toggles.forEach((toggle) => {
        const targetId = toggle.getAttribute("data-password-toggle");
        const input = targetId ? document.getElementById(targetId) : null;
        if (!input) {
            return;
        }

        const showIcon = toggle.querySelector('[data-icon="show"]');
        const hideIcon = toggle.querySelector('[data-icon="hide"]');

        const setVisible = (isVisible) => {
            input.type = isVisible ? "text" : "password";
            toggle.setAttribute("aria-pressed", isVisible ? "true" : "false");
            toggle.setAttribute(
                "aria-label",
                isVisible ? "Masquer le mot de passe" : "Afficher le mot de passe"
            );
            if (showIcon) {
                showIcon.style.display = isVisible ? "none" : "block";
            }
            if (hideIcon) {
                hideIcon.style.display = isVisible ? "block" : "none";
            }
        };

        setVisible(false);

        toggle.addEventListener("click", () => {
            const shouldShow = input.type === "password";
            setVisible(shouldShow);
            input.focus();
            input.setSelectionRange(input.value.length, input.value.length);
        });
    });
}

function setError(input, errorId, message) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    document.getElementById(errorId).innerHTML = message;
}

function setSuccess(input, errorId) {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
    document.getElementById(errorId).innerHTML = "";
}