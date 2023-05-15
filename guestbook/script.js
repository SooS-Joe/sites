let password = document.querySelector("input[name='pword']")
let confirm_password = document.querySelector("input[name='cpword']");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.checkValidity();
  }
}