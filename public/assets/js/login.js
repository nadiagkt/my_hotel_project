document.addEventListener("DOMContentLoaded", () => {
    
    const $email = document.querySelector("#email");
    const $password = document.querySelector("#password");
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('error');
    console.log(myParam);
  
    
    const $emailError = document.querySelector(".email-error");
    const $passwordError = document.querySelector(".password-error");
    const $loginError = document.querySelector(".login-error");
  
    const $submit = document.querySelector(".register-login-buttons");
  
    let emailIsValid;
    let passwordIsValid;
  
    const isEmailValid = (email) =>{
      const hasValidEmailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);

      return hasValidEmailPattern;
    }
  
    const checkEmailErrorMessageVisibility = () =>{
      if(emailIsValid === false) {
        $emailError.classList.remove("display-none");
        return;
      }
      $emailError.classList.add("display-none");
    }
  
    const getPasswordValidation = (password) =>{
      if (email !== "" && password.length > 4){
        passwordIsValid = true;
      }else{
        passwordIsValid = false;
      }
    }
  
    const checkSigninBtn = () =>{
      if (emailIsValid && passwordIsValid){
        $submit.disabled = false;
      }else {
        $submit.disabled = true;
      }
    }
  
    $email.addEventListener("input", (e) =>{
      const emailValue = e.target.value;
      emailIsValid = isEmailValid(emailValue);
  
      if(!emailIsValid){
        $email.classList.add("is-invalid");
      }else{
        $email.classList.remove("is-invalid");
      }
  
      checkEmailErrorMessageVisibility();
      checkSigninBtn();
    })
  
    $password.addEventListener("input", (e) =>{
      getPasswordValidation(e.target.value);
  
      if(!passwordIsValid){
        $password.classList.add("is-invalid");
        $passwordError.classList.remove("display-none");
      }else{
        $password.classList.remove("is-invalid");
        $passwordError.classList.add("display-none");
      }
  
      checkSigninBtn();
    })

    if(myParam == "Unable to verify user"){
      $loginError.classList.remove("display-none");
    }else{
      $loginError.classList.add("display-none");
    }
  
    $emailError.classList.add("display-none");
    $passwordError.classList.add("display-none");
    

    checkSigninBtn();

  })
  