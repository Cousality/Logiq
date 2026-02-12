function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const toggleButton =
        passwordInput.parentElement.querySelector(".password-toggle");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.textContent = "Hide";
    } else {
        passwordInput.type = "password";
        toggleButton.textContent = "Show";
    }
}
