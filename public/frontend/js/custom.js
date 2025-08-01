//******************** header and Landing Section  ************/

// Hide and show menu
$(document).ready(function () {
  "use strict";

  // deal with even scroll
  $(window).scroll(function () {
    "use strict";

    //if scroll to is less than 80
    if ($(window).scrollTop() < 80) {
      //hide navbar by margin and opacity
      $(".header").css({
        "margin-top": "-100px",
        "background-color": "rgba(59,59,59,0)",
      });
    } else {
      $(".header").css({
        "margin-top": "0px",
        "background-color": "rgba(59,59,59,1)",
      });
    }
  });
});

//Active Submenu on small screen
$(document).ready(function () {
  "use strict";

  $(".header nav .toogle-menu").click(function () {
    "use strict";

    $(".header nav ul").toggleClass("subMenu");
  });
});

//active nav link on click
$(document).ready(function () {
  "use strict";

  $("nav ul li a").click(function () {
    "use strict";

    $("nav ul li a").removeClass("active");
    $(this).addClass("active");

    // hide subMenu if we click on any on its links
    $("nav ul").removeClass("subMenu");
  });
});

// Add Smooth Scrolling -> code from the internet
// Add only elements that you worn to scroll smoothly split them by comma
$(document).ready(function () {
  $("nav ul li a, up ").click(function () {
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        $("html,body").animate(
          {
            scrollTop: target.offset().top,
          },
          1000
        );
        return false;
      }
    }
  });
});

// highlight menu item on scroll
$(document).ready(function () {
  "use strict";

  $(window).scroll(function () {
    "use strict";

    //direct div which are the main sections
    $("body > div").each(function () {
      "use strict";

      var sectionId = $(this).attr("id"); //about contact download
      var sectionHeight = $(this).outerHeight();
      var greatTopOfThisScreen = $(this).offset().top - 70;

      if (
        $(window).scrollTop() > greatTopOfThisScreen &&
        $(window).scrollTop() < greatTopOfThisScreen + sectionHeight
      ) {
        $("nav ul li a[href='#" + sectionId + "']").addClass("active");
      } else {
        $("nav ul li a[href='#" + sectionId + "']").removeClass("active");
      }

      //show and hide up button
      if ($(window).scrollTop() > 500) {
        $("#up").css("display", "block");
      } else {
        $("#up").css("display", "none");
      }
    });
  });
});

//Add bx slider to screens landing  link of use : https://bxslider.com/
$(document).ready(function () {
  $(function () {
    $(".bxslider").bxSlider({
      mode: "fade",
      captions: true,
      slideWidth: 600,
      auto: true,
      slideMargin: 50,
      prevText: "<",
      nextText: ">",
    });
  });
});

//***************************  End work with header and Landing Section  *************/

//*************** Start Portfolio Item Filter **************
$(document).ready(function () {
  "use strict";

  $(".Portfolio-filter li").click(function () {
    "use strict";

    //active only clicked shuffle btn
    $(".Portfolio-filter li").removeClass("active");

    //this here mean this actual .Portfolio-filter li which clicked now
    $(this).addClass("active");

    // get attribue of this li data-filter
    let filterValue = $(this).attr("data-filter");

    // show only product related to shuffle btn name
    $(".Portfolio-item").each(function () {
      if (filterValue === $(this).attr("data-category")) {
        //this related to this Portfolio-item which the 'each' loop reached
        $(this).removeClass("hide");
        $(this).addClass("show");
      } else {
        $(this).removeClass("show");
        $(this).addClass("hide");
      }
      if (filterValue === "all") {
        $(this).removeClass("hide");
        $(this).addClass("show");
      }
    });
  });
});

//*************** Start Portfolio Item Filter **************

// ************** start video more effect ****************
$(document).ready(function () {
  "use strict";
  $("#video_more").click(function () {
    $(".video-more-info").fadeToggle(500);
    if ($(this).text() == "see more") {
      $(this).text("see Less");
    } else {
      $(this).text("see more");
    }
  });
});
// ************** End video more effect ****************

//************** Start Statistics work  ****************
// Add counter lib : https://github.com/bfintal/Counter-Up jquery.counterup.js file
$(document).ready(function () {
  "user strict";
  $(".stats .number").counterUp({
    delay: 10, // time pefore start effect
    time: 2000, // time spend in effect
  });
});
//************** End Statistics work  ****************

//************** Start animation work for the hole page *************/
//Add animation ,initialize wow link of use is : https://wowjs.uk/docs.html and https://animate.style/
$(document).ready(function () {
  "use strict";
  new WOW().init();
});

//************** End animation work for the hole page *************/

//************** Start Our Skill work  ***************************/
$(document).ready(function () {
  "use strict";
  $(".popular").bxSlider({
    mode: "vertical",
    auto: true,
    autoControls: true,
    speed: 500,
    slideSelector: "div.bx-content",
    minSlides: 1,
    maxSlides: 1,
    moveSlides: 1,
  });
});

//************** End Our Skill work    ***************************/


//************** Start Language theme switcher work    ***************************/
// Check saved theme on load
window.onload = () => {
    const dark_theme_icon = document.getElementById('dark_theme_icon');
    const light_theme_icon = document.getElementById('light_theme_icon');


    const theme = sessionStorage.getItem("theme");
    if (theme === 'dark') {
        document.body.classList.add('dark-theme');


        dark_theme_icon.classList.add('hide_item');
        dark_theme_icon.classList.remove('show_item');

        light_theme_icon.classList.add('show_item');
        light_theme_icon.classList.remove('hide_item');
    }
};

// Toggle function  between dark and light  mode
function toggleTheme() {
    const isDark = document.body.classList.toggle('dark-theme');

    if(isDark){
        dark_theme_icon.classList.add('hide_item');
        dark_theme_icon.classList.remove('show_item');

        light_theme_icon.classList.add('show_item');
        light_theme_icon.classList.remove('hide_item');
    }else{
        dark_theme_icon.classList.add('show_item');
        dark_theme_icon.classList.remove('hide_item');

        light_theme_icon.classList.add('hide_item');
        light_theme_icon.classList.remove('show_item');
    }

    sessionStorage.setItem("theme", isDark ? "dark" : "light")
}

//************** End Language theme switcher work    ***************************/
