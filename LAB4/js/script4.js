const back = document.querySelector("#back");
const next = document.querySelector("#next");
const start = document.querySelector("#start");
const imageList = document.querySelector("#imageList").options;
const img = document.querySelector("img");
const p = document.querySelector("p");
const length = imageList.length;

let initinalValue = 0;
let slideshowInterval = null;

const updateImage = () => {
  let src = imageList[initinalValue].value;
  img.src = `images/${src}`;
  p.innerText = `${src} (${initinalValue + 1}/${length})`;
};

const nextImg = () => {
  if (initinalValue === length - 1) {
    initinalValue = -1;
  }
  initinalValue++;
  updateImage();
};

const backImg = () => {
  if (initinalValue === 0) {
    initinalValue = length;
  }
  initinalValue--;
  updateImage();
};

next.addEventListener("click", nextImg);
back.addEventListener("click", backImg);

start.addEventListener("click", () => {
  if (start.innerText === "Start slideshow") {
    slideshowInterval = setInterval(nextImg, 1000);
    start.innerText = "Stop slideshow";
    next.disabled = true;
    back.disabled = true;
  } else {
    clearInterval(slideshowInterval);
    start.innerText = "Start slideshow";
    next.disabled = false;
    back.disabled = false;
  }
});

updateImage();
