$(document).ready(function () {
  $(".errorMessage").hide();

  $("form").submit(function (e) {
    e.preventDefault();

    var email = $("#email").val();
    var password = $("#pwd").val();
    var errorMessage = "";

    if (email.length === 0) {
      errorMessage = "Please enter your email.";
      $("#email").focus();
    } else if (!validateEmail(email)) {
      errorMessage = "Your email is not correct.";
      $("#email").focus();
    } else if (password.length === 0) {
      errorMessage = "Please enter your password.";
      $("#pwd").focus();
    } else if (password.length < 6) {
      errorMessage = "Your password must contain at least 6 characters.";
      $("#pwd").focus();
    }

    if (errorMessage.length > 0) {
      $(".errorMessage").text(errorMessage).show();
    } else {
      this.submit();
    }
  });
});

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}
