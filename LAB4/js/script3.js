const textContent = document.querySelector("#message");
const textDisplay = document.querySelector("#textDisplay");
const color = document.querySelector("#color");
const bold = document.querySelector("#bold");
const italic = document.querySelector("#italic");
const underline = document.querySelector("#underline");
const restore = document.querySelector("#restore");
textContent.addEventListener("change", function (e) {
  textDisplay.innerHTML = e.target.value;
});

color.addEventListener("change", function (e) {
  let opt = e.target.value;
  console.log(opt);
  switch (opt) {
    case "Black":
      textDisplay.style.color = "#120b07";
      break;
    case "Green":
      textDisplay.style.color = "#939b3b";
      break;
    case "Red":
      textDisplay.style.color = "#bb0802";
      break;
    case "Blue":
      textDisplay.style.color = "#9370ff";
      break;
    default:
      break;
  }
});

bold.addEventListener("change", function (e) {
  let check = e.target.checked;
  switch (check) {
    case true:
      textDisplay.style.fontWeight = "bold";
      break;
    case false:
      textDisplay.style.fontWeight = "normal";
      break;
  }
});

italic.addEventListener("change", function (e) {
  let check = e.target.checked;
  switch (check) {
    case true:
      textDisplay.style.fontStyle = "italic";
      break;
    case false:
      textDisplay.style.fontStyle = "normal";
      break;
  }
});

underline.addEventListener("change", function (e) {
  let check = e.target.checked;
  switch (check) {
    case true:
      textDisplay.style.textDecoration = "underline";
      break;
    case false:
      textDisplay.style.textDecoration = "none";
      break;
  }
});

restore.addEventListener("click", function () {
  textDisplay.innerHTML =
    "This text will be changed immediately when typing new text.";
  textContent.value = "";

  textDisplay.style.color = "";

  bold.checked = false;
  italic.checked = false;
  underline.checked = false;

  textDisplay.style.fontWeight = "";
  textDisplay.style.fontStyle = "";
  textDisplay.style.textDecoration = "";
});
