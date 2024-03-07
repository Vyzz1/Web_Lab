const form = document.querySelector("form");
const errorMessage = document.querySelector(".errorMessage");
const emailHTML = document.querySelector("#email");
const pwdHTML = document.querySelector("#pwd");
console.log(form);
form.addEventListener("submit", (e) => {
  e.preventDefault();
  let email = e.target.email.value;
  let pwd = e.target.password.value;
  if (email === "") {
    errorMessage.innerHTML = "Please enter your email";
    emailHTML.focus();
  } else if (!email.includes("@") || !email.includes(".")) {
    errorMessage.innerHTML = "Your email is not correct";
  } else if (pwd === "") {
    errorMessage.innerHTML = "Please enter your password";
    pwdHTML.focus();
  } else if (pwd.length < 6) {
    errorMessage.innerHTML =
      "Your password must contain at least 6 characters ";
    pwdHTML.focus();
  } else {
    errorMessage.innerHTML = "";
  }
});
