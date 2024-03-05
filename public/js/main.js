$(function () {

    var owl = $("#profileVisitor,#favoriteUser,#latestUser");

    owl.owlCarousel({
        dots: false,
        navigation: true,
        navigationText: ['<span class="fa-stack"></i><i class="fa fa-chevron-circle-left fa-inverse"></i></span>', '<span class="fa-stack"></i><i class="fa fa-chevron-circle-right fa-inverse"></i></span>'],

        /*itemsCustom: [
            [0, 2],
            [450, 4],
            [600, 7],
            [700, 9],
            [1000, 10],
            [1200, 12],
            [1400, 13],
            [1600, 15]
        ],*/
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    var Accordion = function (el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        // Variables privadas
        var links = this.el.find(".vertical-menu-link");
        // Evento
        links.on(
            "click", {
                el: this.el,
                multiple: this.multiple
            },
            this.dropdown
        );
    };

    Accordion.prototype.dropdown = function (e) {
        var $el = e.data.el;
        $this = $(this);
        $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass("open");

        if (!e.data.multiple) {
            $el.find(".vertical-menu-sub")
                .not($next)
                .slideUp()
                .parent()
                .removeClass("open");
        }
    };

    var accordion = new Accordion($("#vertical-menu"), false);
});


$(".commentsubmit2").keypress(function (e) {
    if (e.which == 13 && !e.shiftKey) {
        $(this).closest("form").submit();
        e.preventDefault();
        return false;
    }
});

// Status slider
var statusSlider = new Swiper('.status-slider', {
    slidesPerView: 1,
    parallax: true,
    autoplayDisableOnInteraction: false,
    autoplay: {
        delay: 5000,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 0
        }
    }
});


// Group, blog, event Slider
var swiper = new Swiper(".peopel-slider-two", {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 0,
    pagination: {
        el: '.swiper-pagination',
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 0
        }
    }
});

$(function () {
    $(".group-popup").magnificPopup({
        type: "inline",
        preloader: false,
        focus: "#username",
        modal: true
    });
    $(document).on("click", ".popup-modal-dismiss", function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });
});

//Notification Popup
$(function () {
    $(".notify-group").magnificPopup({
        type: "inline",
        preloader: false,
        focus: "#username",
        modal: true
    });
    $(document).on("click", ".popup-modal-dismiss", function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });
});
// $("#lightgallery").lightGallery();
// $("#aniimated-thumbnials").lightGallery({
//     thumbnail: true
// });
// image gallery
// var modalVisible = false;
// var $modal = $(".modal");

// $(".gallery img").click(function (e) {
//     let loc = $(this).data("loc");
//     $modal.html("<img src=" + loc + " class='modal-img'>");
//     $modal.fadeIn(200);
//     modalVisible = true;
// });

// $(".modal").click(function (e) {
//     let $img = $(".modal-img").get(0);
//     if (e.target != $img && modalVisible) {
//         $modal.fadeOut(200);
//         modalVisible = false;
//     }
// });

// FAQ
$(function () {
    $(".bc-accordian-item a").on("mousedown", function () {
        var item = $(this);
        item.toggleClass("bc-accordian-item-link-on");
        item.next("div").toggle(240);
    });
});

// -------------------------------
// photo upload and slidesPerView
// -------------------------------
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});

//image upload
function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#galleryImagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#galleryImagePreview').hide();
            $('#galleryImagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#galleryImageUpload").change(function () {
    readURL1(this);
});


//image upload
function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#profileImagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#profileImagePreview').hide();
            $('#profileImagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#profileImageUpload").change(function () {
    readURL2(this);
});
//image upload
function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#femaleImagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#femaleImagePreview').hide();
            $('#femaleImagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#femaleImageUpload").change(function () {
    readURL3(this);
});

//   -------------------------
//   live profile details edit 
//   -------------------------
var $status = $(".form-control"),
    $commentBox = $("#commentBox"),
    timeoutId;

$commentBox.keyup(function () {
    $status.attr("class", "form-control pending");
    if (timeoutId) clearTimeout(timeoutId);
    timeoutId = setTimeout(function () {
        var details = $("textarea[name=profileDetails]").val();
        var test = "asd";
        $.ajax({
            type: "POST",
            data: {
                profileDetails: details
            },
            url: "/profileDescription",
            datatype: "JSON",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (data) {
                console.log(data);
            }
        });
        $status.attr("class", "form-control saved");
    }, 750);
});


//Responsive menu
function tamMenu() {
    var element = document.getElementById("renum-menu");
    element.classList.toggle("renum-menu-open");
}

//alert auto close
window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 4000);


// web notification
function markNotificationAsRead() {
    // if(notificationCount !=='0'){
    // }
    // $.get('/markAsRead');
}

// Notification window
function markInboxAsRead() {
    // $.get('/markAsRead');
    var element = document.getElementById("showPro");
    element.classList.toggle("show-pp");
    var element = document.getElementById("showProo");
    element.classList.remove("show-pp");
    var element = document.getElementById("showProoo");
    element.classList.remove("show-pp");
}

function showProo() {
    var element = document.getElementById("showProo");
    element.classList.toggle("show-pp");
    var element = document.getElementById("showPro");
    element.classList.remove("show-pp");
    var element = document.getElementById("showProoo");
    element.classList.remove("show-pp");
}

function othersNotif() {
    var element = document.getElementById("showProoo");
    element.classList.toggle("show-pp");
    var element = document.getElementById("showProo");
    element.classList.remove("show-pp");
    var element = document.getElementById("showPro");
    element.classList.remove("show-pp");
}

// statusSlider
var swiper = new Swiper('.swiper-container', {
    pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },

});

//  *****************
//  char responsive
//  *****************
(function ($) {
    "use strict"; // Start of use strict
    var menuBar = document.querySelector(".my-chat-button");
    var slideMnu = true;
    $(menuBar).on('click', function (event) {
        if (slideMnu) {
            document.querySelector('.responsive-caht-page').classList.add("res-menu-opn")
            slideMnu = false;
        } else {
            document.querySelector('.responsive-caht-page').classList.remove("res-menu-opn")
            slideMnu = true;
        }
    });
    $('.rom-pro-clcik').on('click', '.profile-setting-single', function () {
        slideMnu = true;
        document.querySelector('.responsive-caht-page').classList.remove("res-menu-opn");
        document.querySelector('.pro-next-list').classList.add("pro-menu-opn")
    });
    $('.icon-tse').on('click', function () {
        document.querySelector('.pro-next-list').classList.remove("pro-menu-opn")
    });



})(jQuery); // End of use strict

// profile galarry
function galleryTabSwitcher(evt, cityName) {
    var i, tabcontent, tablinkspro;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinkspro = document.getElementsByClassName("profile-setting-single");
    for (i = 0; i < tablinkspro.length; i++) {
        tablinkspro[i].className = tablinkspro[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


document.getElementById("defaultOpen").click();

function openProfileGalleryImageOthers(url) {
    document.getElementById('profile-img-others').src = url;
}
function openProfileGalleryImageMy(url) {
    document.getElementById('profile-img-my').src = url;
}
function openGalleryImage(url) {
    document.getElementById('gallery-img').src = url;

}
function openPromotionImage(url,title) {
    console.log(title);
    document.getElementById('promotion-img').src = url;
    document.getElementById('promotion-title').innerHTML = title;
}

function openGroupPostImage(url){
    document.getElementById('group-post-img').src = url;
}

function openSliderImage(url) {
    document.getElementById('profile-slider-img').src = url;
}

function signupAggrement(forms) {

    if (document.getElementById("aggrement-checkbox").checked) {
        console.log("called plans:", document.getElementById("aggrement-checkbox").checked)
        forms.submit();
    }else{
        document.getElementById("aggrement-section").style.color = "red";
    }
}





