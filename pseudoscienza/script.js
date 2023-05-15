let navButtons = document.querySelectorAll("nav.sections>ul>li")
let sections = document.querySelectorAll("section");
let slides = document.querySelectorAll("section#pseudoscienze>div.slide");
let fsButton = document.querySelector("ul>li>i.fa-solid fa-expand");

let sectionNames = ['pseudoscienze', 'frenologia', 'storia', 'affaire', 'confutazione'];
let sectionColors = ['#DC4B6D', '#f5be28', '#8AC926', '#1982C4', '#6919C4'];


let currentSection = 0;
let currentSlide = 0;
let maxSlide = slides.length - 1;

function setSection(currSlide) {
  navButtons.forEach(nb => {
    nb.style.color = sectionColors[currentSection];
  });
  for (let index = 0; index < sections.length; index++) {
    if (index != currSlide)
      sections[index].style.display = 'none';
    else {
      sections[index].style.display = 'block';
      slides = document.querySelectorAll('section#' + sectionNames[index] + '>div.slide');
      currentSlide = 0;
      maxSlide = slides.length - 1;
    }
  }
}

function goBack() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
  currentSlide = 0;
}

function prevSlide() {
  slides[(currentSlide == 0 ? 0 : currentSlide -= 1)].scrollIntoView({ behavior: "smooth" });
}

function nextSlide() {
  slides[(currentSlide == maxSlide ? maxSlide : currentSlide += 1)].scrollIntoView({ behavior: "smooth" });
}

function prevSection() {
  setSection(currentSection == 0 ? currentSection : currentSection -= 1);
  goBack();
}

function nextSection() {
  setSection(currentSection == sections.length - 1 ? currentSection : currentSection += 1);
  goBack();
}

function fullScreen() {
  if (document.fullscreenElement !== null) {
    closeFullscreen();
    fsButton.classList.toggle("fa-solid fa-expand");
    fsButton.classList.toggle("fa-solid fa-compress");
  } else {
    openFullscreen();
    fsButton.classList.toggle("fa-solid fa-compress");
    fsButton.classList.toggle("fa-solid fa-expand");
  }
}

var elem = document.documentElement;

/* Function to open fullscreen mode */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem = window.top.document.body; //To break out of frame in IE
    elem.msRequestFullscreen();
  }
}

/* Function to close fullscreen mode */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    window.top.document.msExitFullscreen();
  }
}
function fullScreenChange(event) {
  if (document.fullscreenElement) {
    fsButton.className = "fa-solid fa-expand";
  } else {
    fsButton.className = "fa-solid fa-compress";
  }
}

// prevButton.onclick = prevSlide; 

// nextButton.onclick = nextSlide;
setSection(currentSection);

for (let index = 0; index < navButtons.length; index++) {
  navButtons[index].addEventListener('click', function () {
    currentSection = index;
    setSection(currentSection);
  });
}

document.addEventListener('keydown', (event) => {
  event.preventDefault();
  if (event.code === 'ArrowUp')
    prevSlide();
  if (event.code === 'ArrowDown')
    nextSlide();
  if (event.key === 'ArrowRight')
    nextSection();
  if (event.key === 'ArrowLeft')
    prevSection();
})

document.addEventListener("fullscreenchange", fullScreenChange);