document.addEventListener("DOMContentLoaded", function() {
    const registrationForm = document.getElementById('registrationForm');
    const loginForm = document.getElementById('loginForm');

    if (registrationForm) {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const userType = document.getElementById('userType');

        function validateName() {
            const nameValue = nameInput.value.trim();
            const nameRegex = /^[a-zA-Z\s]+$/;
            if (nameValue.split(" ").length < 2 || !nameRegex.test(nameValue)) {
                document.getElementById('name-error').textContent = 'Please enter your full name.';
                return false;
            } else {
                document.getElementById('name-error').textContent = '';
                return true;
            }
        }

        function validateConfirmPassword() {
            const confirmPasswordValue = confirmPasswordInput.value.trim();
            if (confirmPasswordValue === '') {
                document.getElementById('confirm-password-error').textContent = 'Please confirm your password.';
                return false;
            } else if (confirmPasswordValue !== passwordInput.value.trim()) {
                document.getElementById('confirm-password-error').textContent = 'Passwords do not match.';
                return false;
            } else {
                document.getElementById('confirm-password-error').textContent = '';
                return true;
            }
        }

        function validateForm() {
            return validateName() && validateConfirmPassword();
        }

        registrationForm.addEventListener('submit', function(event) {
            event.preventDefault();
            if (validateForm()) {
                const formData = new FormData(registrationForm);
                formData.append('action', 'register');
                fetch('AuthunticationController.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                            showAlert(data.message, 'success');
                            if(userType === 'customer'){
                                setTimeout(() => {
                                    window.location.href = 'Authuntication.php?type=login';
                                }, 1000);
                            }
                        registrationForm.reset();
                    } else {
                        showAlert(data.message, 'danger');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred. Please try again later.', 'danger');
                });
            }
        });

        nameInput.addEventListener('blur', validateName);
        confirmPasswordInput.addEventListener('blur', validateConfirmPassword);
    }


    if (loginForm) {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        function validateEmail() {
            const emailValue = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailValue)) {
                document.getElementById('email-error').textContent = 'Please enter a valid email.';
                return false;
            } else {
                document.getElementById('email-error').textContent = '';
                return true;
            }
        }
        function validateLoginForm() {
            return validateEmail();
        }

        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            if (validateLoginForm()) {
                const formData = new FormData(loginForm);
                formData.append('action', 'login');
                fetch('AuthunticationController.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        showAlert(data.message, 'danger');
                    }
                })
                .catch(error => {
                    showAlert('An error occurred. Please try again later.', 'danger');
                });
            }
        });

        emailInput.addEventListener('blur', validateEmail);
    }
});

function showAlert(message, type) {
    const alertDiv = document.createElement("div");
    alertDiv.className = "alert alert-" + type;
    alertDiv.setAttribute("role", "alert");
    alertDiv.innerHTML = message;
    document.getElementById("alertContainer").appendChild(alertDiv);
    setTimeout(function () {
        alertDiv.remove();
    }, 5000);
}
