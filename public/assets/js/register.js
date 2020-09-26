document.addEventListener("DOMContentLoaded", () => {
 
  const $name = document.querySelector("#name");
  const $email = document.querySelector("#email");
  const $repeatEmail = document.querySelector("#repeatEmail");
  const $password = document.querySelector("#password");

  
  const $nameError = document.querySelector(".name-error");
  const $emailError = document.querySelector(".email-error");
  const $repeatEmailError = document.querySelector(".repeat-email-error");
  const $passwordError = document.querySelector(".password-error");

  const $submit = document.querySelector(".register-login-buttons");

  let nameIsValid;
  let emailIsValid;
  let repeatEmailIsValid;
  let passwordIsValid;

  const isNameValid = (name) =>{
    const hasOnlyCharacters = /^[a-zA-Z]*$/.test(name);

    if(name !== "" && hasOnlyCharacters){
      return true;
    }else {
      return false;
    }
  }

  const isEmailValid = (email) =>{
    const hasValidEmailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);

    return hasValidEmailPattern;
  }

  const checkEmailErrorMessageVisibility = () =>{
    if(emailIsValid === false && $repeatEmail.disabled) {
      $emailError.classList.remove("display-none");
      return;
    }

    if(repeatEmailIsValid === false){
      $emailError.classList.remove("display-none");
      return;
    }

    $emailError.classList.add("display-none");
  }

  const resetRepeatEmailInput = () =>{
    $repeatEmail.value = "";
    $repeatEmail.disabled = true;
    $repeatEmail.classList.remove("is-invalid");
    $repeatEmailError.classList.add("display-none");
  }

  const getPasswordValidation = (password) =>{
    if(email !== "" && password.length > 4){
      passwordIsValid = true;
    }else{
      passwordIsValid = false;
    }
  }

  const checkSigninBtn = () => {
    if(nameIsValid && emailIsValid && repeatEmailIsValid && passwordIsValid){
      $submit.disabled = false;
    }else {
      $submit.disabled = true;
    }
  }

  $name.addEventListener("input", (e) => {
    const nameValue = e.target.value;
    nameIsValid = isNameValid(nameValue);

    if(!nameIsValid){
      $name.classList.add("is-invalid");
      $nameError.classList.remove("display-none");
    }else {
      $name.classList.remove("is-invalid");
      $nameError.classList.add("display-none");
    }

    checkSigninBtn();
  })

  $email.addEventListener("input", (e) =>{
    const emailValue = e.target.value;
    emailIsValid = isEmailValid(emailValue);

    if(emailValue.length === 0){
      resetRepeatEmailInput();
    }

    if(!emailIsValid){
      $email.classList.add("is-invalid");
    }else {
      $repeatEmail.disabled = false;
      $email.classList.remove("is-invalid");
    }

    checkEmailErrorMessageVisibility();
    checkSigninBtn();
  })

  $repeatEmail.addEventListener("input", (e) =>{
    const emailValue = $email.value;
    const repeatEmailValue = e.target.value;
    const isSameMail = emailValue === repeatEmailValue;

    repeatEmailIsValid = isEmailValid(repeatEmailValue);

    if(!repeatEmailIsValid){
      $repeatEmail.classList.add("is-invalid");
      $repeatEmailError.classList.add("display-none");
      checkEmailErrorMessageVisibility();
      return;
    }

    if(!isSameMail){
      $repeatEmail.classList.add("is-invalid");
      $repeatEmailError.classList.remove("display-none");
    }else {
      $repeatEmail.classList.remove("is-invalid");
      $repeatEmailError.classList.add("display-none");
    }

    checkEmailErrorMessageVisibility();
    checkSigninBtn();
  })

  $password.addEventListener("input", (e) => {
    getPasswordValidation(e.target.value);

    if(!passwordIsValid){
      $password.classList.add("is-invalid");
      $passwordError.classList.remove("display-none");
    }else {
      $password.classList.remove("is-invalid");
      $passwordError.classList.add("display-none");
    }

    checkSigninBtn();
  })

  $nameError.classList.add("display-none");
  $emailError.classList.add("display-none");
  $repeatEmailError.classList.add("display-none");
  $passwordError.classList.add("display-none");

}) 
