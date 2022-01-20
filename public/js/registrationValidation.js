const registrationForm = document.querySelector("form");
const passwordInput = registrationForm.querySelector('input[name="password"]');
const confirmedPasswordInput = registrationForm.querySelector('input[name="confirm-password"]');
const email = registrationForm.querySelector('input[name="email"]');

function checkPasswordEquality(password, confirmedPassword) {
    return password === confirmedPassword;
}

function checkEmailFormat(email) {
    const filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return filter.test(email);
}

function markValidation(element, condition) {
    if (condition) {
        element.classList.remove('invalid-input');
        element.classList.add('valid-input');
    }
    else {
        element.classList.remove('valid-input');
        element.classList.add('invalid-input')
    }
}

function validatePassword() {
    setTimeout(function () {
            markValidation(confirmedPasswordInput, checkPasswordEquality(passwordInput.value, confirmedPasswordInput.value));
        },
        1000
    );
}

function validateEmail() {
    setTimeout(function () {
        markValidation(email, checkEmailFormat(email.value));
    });
}

email.addEventListener('keyup', validateEmail);
[passwordInput, confirmedPasswordInput].forEach(element => {
    element.addEventListener('keyup', validatePassword);
});
