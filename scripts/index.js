"use strict";

// Display carousel
function showSlides(n) {
    var i;
    var slideIndex = n;
    var slides = document.getElementsByClassName("carousel_slide");
    var dots = document.getElementsByClassName("dot");
    if (slideIndex > slides.length) {slideIndex = 1}
    if (slideIndex < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

// Next/previous controls
function switchSlide(n) {
    var currentSlideIndex = Array.from(document.getElementsByClassName("carousel_slide")).findIndex(slide => slide.style.display === "block");
    showSlides(currentSlideIndex + n + 1);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(n);
}

// Change image every 10 seconds
function autoSlide() {
    setInterval(function() {
        switchSlide(1);
    }, 10000);
}
function init(){
    //Carousel
    showSlides(1);

    //Automatic carousel
    autoSlide();
}

window.onload = init;
