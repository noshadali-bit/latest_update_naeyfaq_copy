//editor.document.designMode = "On";


function transform(option, argument) {
    editor.document.execCommand(option, false, argument);
}

function myFunction() {
    var dots = document.getElementById("dots");

    var moreText = document.getElementById("more");

    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";

        btnText.innerHTML = "show";

        moreText.style.display = "none";
    } else {
        dots.style.display = "none";

        btnText.innerHTML = "less";

        moreText.style.display = "inline";
    }
}

$(".share-story-page").find(".share-story-form").hide();

// map js
$(".slick-arrow").click(function () {
    if ($(".edu").hasClass("new")) {
        $(".edu").removeClass("new");
    } else {
        $(".edu").addClass("new");
    }
});

$(document).ready(function () {
    $(".role-loc-div").hide();
    $(".street-add-div").hide();
    $("input[name$='role_location']").click(function () {
        var test = $(this).val();
        if (test == "Job is performed at a specific address") {
            $(".role-loc-div").show();
        } else {
            $(".role-loc-div").hide();
        }
    });

    $("input[name$='map_loc']").click(function () {
        var test = $(this).val();
        if (test == "Yes Include street address") {
            $(".street-add-div").show();
        } else {
            $(".street-add-div").hide();
        }
    });
});

$(".loc-radio").click(function () {
    var loc = $(this).closest(".loc-div");
    $(".loc-div").removeClass("active");
    loc.addClass("active");
});

$(".stories").slick({
    dots: false,
    infinite: true,
    speed: 300,
    arrows: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ],
});

$(".got-job").slick({
    vertical: true,
    verticalSwiping: true,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ],
});

$(".next-step-form").hide();

$(".end-page").hide();

$(".nxt-btn").click(function () {
    $(".next-step-form").show();
    $(".prev-step-form").hide();
    $(".end-page").hide();
    document.getElementById("step-p").innerHTML = "Step 2 of 2";
    document.getElementById("step-h").innerHTML = "Share your story";
});

$(".prv-btn").click(function () {
    $(".next-step-form").hide();
    $(".prev-step-form").show();
    $(".end-page").hide();
    document.getElementById("step-p").innerHTML = "Step 1 of 2";
    document.getElementById("step-h").innerHTML = "Tell us about your new job";
});

$(".nxt-btn-2").click(function () {
    $(".end-page").show();
    $(".next-step-form").hide();
    $(".prev-step-form").hide();
    $(".modal-header").addClass("no-head");
});

$(".done-btn").click(function () {
    $(".modal-header").removeClass("no-head");
});

$(".responsive").slick({
    dots: true,

    infinite: true,

    speed: 300,

    slidesToShow: 4,

    slidesToScroll: 4,

    responsive: [{
            breakpoint: 1024,

            settings: {
                slidesToShow: 3,

                slidesToScroll: 3,

                infinite: true,

                dots: true,
            },
        },

        {
            breakpoint: 600,

            settings: {
                slidesToShow: 2,

                slidesToScroll: 2,
            },
        },

        {
            breakpoint: 480,

            settings: {
                slidesToShow: 1,

                slidesToScroll: 1,
            },
        },

        // You can unslick at a given breakpoint now by adding:

        // settings: "unslick"

        // instead of a settings object
    ],
});

function openCity(evt, cityName) {
    // Declare all variables

    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them

    tabcontent = document.getElementsByClassName("tabcontent");

    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"

    tablinks = document.getElementsByClassName("tablinks");

    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab

    document.getElementById(cityName).style.display = "block";

    evt.currentTarget.className += " active";
}

var acc = document.getElementsByClassName("accordion");

var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");

        var panel = this.nextElementSibling;

        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

/* When the user clicks on the button, 

toggle between hiding and showing the dropdown content */

$(".dropbtn").click(function () {
    var drp = $(this).closest(".dropdown").find(".myDropdown");

    if (drp.css("display") == "block") {
        drp.hide();
    } else {
        drp.show();
    }
});

// Close the dropdown if the user clicks outside of it

window.onclick = function (event) {
    if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");

        var i;

        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];

            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
};

window.console = window.console || function (t) {};

if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
}

// Gallery

//

$(document).ready(function () {
    $(".filter-button").click(function () {
        var value = $(this).attr("data-filter");

        if (value == "all") {
            //$('.filter').removeClass('hidden');

            $(".filter").show("1000");
        } else {
            //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');

            //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');

            $(".filter")
                .not("." + value)
                .hide("3000");

            $(".filter")
                .filter("." + value)
                .show("3000");
        }
    });

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }

    $(this).addClass("active");
});

//COUNT WORDS IN TEXTAREA
function countChar(val) {
    var len = val.value.length;
    $("#charNum").text(len);
    //}
}

jQuery(document).ready(function ($) {
    $(".btnrating").click(function () {
        var data = $(this).data("attr");

        $(this).closest(".rating-ability-wrapper").find("input").val(data);
        $(this).closest(".rating-ability-wrapper").find(".btnrating").removeClass("btn-warning");
        $(this).addClass("btn-warning");
    });

    //PICK VALUE FOR STAR RATING
    $(".star").fontstar({}, function (value, self) {
        console.log("hello " + value);
    });

    //   $(".btnrating").on('click',(function(e) {

    //   var previous_value = $("#selected_rating").val();

    //   var selected_value = $(this).attr("data-attr");
    //   $("#selected_rating").val(selected_value);

    //   $(".selected-rating").empty();
    //   $(".selected-rating").html(selected_value);

    //   for (i = 1; i <= selected_value; ++i) {
    //   $("#rating-star-"+i).toggleClass('btn-warning');
    //   $("#rating-star-"+i).toggleClass('btn-default');
    //   }

    //   for (ix = 1; ix <= previous_value; ++ix) {
    //   $("#rating-star-"+ix).toggleClass('btn-warning');
    //   $("#rating-star-"+ix).toggleClass('btn-default');
    //   }

    //   }));

    //  $(document).ready(function(){
    //   $(".btn").click(function(){
    //     var name = $(this).attr("name");
    //     alert(name);
    //   });
    // });
});

//STICKY HEADER
$(window).scroll(function () {
    if ($(window).scrollTop() >= 10) {
        $("header").addClass("fixed-header");
        $("header div").addClass("visible-title");
    } else {
        $("header").removeClass("fixed-header");
        $("header div").removeClass("visible-title");
    }
});

//TESTI SLIDER
$(".testi-sli").slick({
    dots: true,
    infinite: true,
    speed: 300,
    autoplay: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

// COOKIES HANDLER
/* common fuctions */
function el(selector) {
    return document.querySelector(selector);
}

function els(selector) {
    return document.querySelectorAll(selector);
}

function on(selector, event, action) {
    els(selector).forEach((e) => e.addEventListener(event, action));
}

function cookie(name) {
    let c = document.cookie.split("; ").find((cookie) => cookie && cookie.startsWith(name + "="));
    return c ? c.split("=")[1] : false;
}

/* popup button hanler */
on(".cookie-popup button", "click", () => {
    el(".cookie-popup").classList.add("cookie-popup--accepted");
    document.cookie = `cookie-accepted=true`;
});

/* popup init hanler */
if (cookie("cookie-accepted") !== "true") {
    if (el(".cookie-popup")) {
        el(".cookie-popup").classList.add("cookie-popup--not-accepted");
    }
}
