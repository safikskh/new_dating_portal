var slideIndex1 = 0;
var milliseconds = 7000; // Change image every 7 seconds
showSlides1();

function showSlides1() {
    var i;
    var slides1 = document.getElementsByClassName("mySlides1");
    var dots1 = document.getElementsByClassName("dot1");
    for (i = 0; i < slides1.length; i++) {
        slides1[i].style.display = "none";
    }
    slideIndex1++;
    if (slideIndex1 > slides1.length) {
        slideIndex1 = 1
    }
    for (i = 0; i < dots1.length; i++) {
        dots1[i].className = dots1[i].className.replace(" active", "");
    }
    slides1[slideIndex1 - 1].style.display = "block";
    dots1[slideIndex1 - 1].className += " active";
    setTimeout(showSlides1, milliseconds); // Change image every n seconds
}
var slideIndex2 = 0;
showSlides2();

function showSlides2() {
    var i;
    var slides2 = document.getElementsByClassName("mySlides2");
    var dots2 = document.getElementsByClassName("dot2");
    for (i = 0; i < slides2.length; i++) {
        slides2[i].style.display = "none";
    }
    slideIndex2++;
    if (slideIndex2 > slides2.length) {
        slideIndex2 = 1
    }
    for (i = 0; i < dots2.length; i++) {
        dots2[i].className = dots2[i].className.replace(" active", "");
    }
    slides2[slideIndex2 - 1].style.display = "block";
    dots2[slideIndex2 - 1].className += " active";
    setTimeout(showSlides2, milliseconds); // Change image every n seconds
}

var slideIndex3 = 0;
showSlides3();

function showSlides3() {
    var i;
    var slides3 = document.getElementsByClassName("mySlides3");
    var dots3 = document.getElementsByClassName("dot3");
    for (i = 0; i < slides3.length; i++) {
        slides3[i].style.display = "none";
    }
    slideIndex3++;
    if (slideIndex3 > slides3.length) {
        slideIndex3 = 1
    }
    for (i = 0; i < dots3.length; i++) {
        dots3[i].className = dots3[i].className.replace(" active", "");
    }
    slides3[slideIndex3 - 1].style.display = "block";
    dots3[slideIndex3 - 1].className += " active";
    setTimeout(showSlides3, milliseconds); // Change image every n seconds
}

var slideIndex4 = 0;
showSlides4();

function showSlides4() {
    var i;
    var slides4 = document.getElementsByClassName("mySlides4");
    var dots4 = document.getElementsByClassName("dot4");
    for (i = 0; i < slides4.length; i++) {
        slides4[i].style.display = "none";
    }
    slideIndex4++;
    if (slideIndex4 > slides4.length) {
        slideIndex4 = 1
    }
    for (i = 0; i < dots4.length; i++) {
        dots4[i].className = dots4[i].className.replace(" active", "");
    }
    slides4[slideIndex4 - 1].style.display = "block";
    dots4[slideIndex4 - 1].className += " active";
    setTimeout(showSlides4, milliseconds); // Change image every n seconds
}