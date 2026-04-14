const signUpBtnLink = document.querySelector('.signUpBtn-link');
const signInBtnLink = document.querySelector('.signInBtn-link');
const forgotPasswordLink = document.querySelector('.forgotPassword-link');
const changePasswordLink = document.querySelector('.changePassword-link');
const wrapper = document.querySelector('.wrapper');

signUpBtnLink.addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelector('.sign-in').classList.remove('active');
    document.querySelector('.sign-up').classList.add('active');
});

signInBtnLink.addEventListener('click', (e) => {
    e.preventDefault(); 
    document.querySelector('.sign-up').classList.remove('active');
    document.querySelector('.forgot-password-form').classList.remove('active');
    document.querySelector('.change-password-form').classList.remove('active');
    document.querySelector('.sign-in').classList.add('active');
});

forgotPasswordLink.addEventListener('click', (e) => {
    e.preventDefault(); 
    document.querySelector('.sign-in').classList.remove('active');
    document.querySelector('.forgot-password-form').classList.add('active');
});

changePasswordLink.addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelector('.forgot-password-form').classList.remove('active');
    document.querySelector('.change-password-form').classList.add('active');
});

document.querySelector('.forgot-password-form .signInBtn-link').addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelector('.forgot-password-form').classList.remove('active');
    document.querySelector('.sign-in').classList.add('active');
});

document.querySelector('.change-password-form .signInBtn-link').addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelector('.change-password-form').classList.remove('active');
    document.querySelector('.sign-in').classList.add('active');
});
