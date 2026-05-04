let index = 0;
const slides = document.querySelectorAll(".carousel-item");
const inner = document.querySelector(".carousel-inner");

function showSlide(i) {
  if (i >= slides.length) index = 0;
  else if (i < 0) index = slides.length - 1;
  else index = i;

  inner.style.transform = "translateX(" + (-index * 100) + "%)";
}

document.querySelector(".carousel-control-next").onclick = () => {
  showSlide(index + 1);
};

document.querySelector(".carousel-control-prev").onclick = () => {
  showSlide(index - 1);
};

// Auto slide
setInterval(() => {
  showSlide(index + 1);
}, 100);