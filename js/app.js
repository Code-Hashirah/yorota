document.addEventListener("DOMContentLoaded", function() {
    // Toggle Sidebar
    const menuToggle = document.getElementById("menu-toggle");
    const wrapper = document.getElementById("wrapper");

    menuToggle.addEventListener("click", function() {
        wrapper.classList.toggle("toggled");
    });

    // Handle Registration Form
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function(event) {
            event.preventDefault();
            alert("Registration form submitted!");
        });
    }

    // Handle Login Form
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();
            alert("Login form submitted!");
        });
    }
});
