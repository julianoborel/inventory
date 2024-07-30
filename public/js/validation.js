document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        let isValid = true;

        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        if (name.value.trim() === '') {
            isValid = false;
            name.classList.add('is-invalid');
        } else {
            name.classList.remove('is-invalid');
        }

        if (email.value.trim() === '' || !email.value.includes('@')) {
            isValid = false;
            email.classList.add('is-invalid');
        } else {
            email.classList.remove('is-invalid');
        }

        if (password.value && password.value !== passwordConfirmation.value) {
            isValid = false;
            passwordConfirmation.classList.add('is-invalid');
        } else {
            passwordConfirmation.classList.remove('is-invalid');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
