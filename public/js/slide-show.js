let slides = document.querySelectorAll('#slides .slide');
let index = 0;
let slideInterval = setInterval(nextSlide,11000);

function nextSlide() {
    slides[index].className = slides[index].className.replace(/active/i, '');
    index = (index+1) % slides.length;
    slides[index].className = slides[index].className + ' active';
}
