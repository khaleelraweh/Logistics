/** ================== Start  usefull component ========================== */

function fadeOut(element) {
  var op = 1; // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
      element.style.display = "none";
    }
    element.style.opacity = op;
    element.style.filter = "alpha(opacity=" + op * 100 + ")";
    op -= op * 0.1;
    // op = op - 0.1; // يمكن عمل هذا السطر بدلا من السطرين السابقين
  }, 50);
}

function fadeIn(element) {
  var op = 0.1; // initial opacity
  element.style.display = "block";
  var timer = setInterval(function () {
    if (op >= 1) {
      clearInterval(timer);
    }
    element.style.opacity = op;
    element.style.filter = "alpha(opacity=" + op * 100 + ")";
    op += op * 0.1;
    // op = op + 0.1; // يمكن عمل هذا السطر بدل من السطرين السابقين
  }, 10);
}

/** ================== End  usefull component ============================ */

//******************** Start nav work with ************/

// -------------------- Hide and show menu --------------------
$(document).ready(function () {
  "use strict";

  // deal with even scroll
  $(window).scroll(function () {
    "use strict";

    //if scroll to is less than 80
    if ($(window).scrollTop() < 80) {
      //hide navbar by margin and opacity
      $("header").css({
        "margin-top": "-100px",
        opacity: "0",
      });

      // make the same navbar background color opacity 0
      $("header").css({
        "background-color": "rgba(59,59,59,0)",
      });
    } else {
      $("header").css({
        "margin-top": "0px",
        opacity: "1",
      });

      $("header").css({
        "background-color": "rgba(59,59,59,1)",
      });

      $("header .Logo  img").css({
        height: "35px",
        "padding-top": "0",
      });

      $("header nav ul > li > a").css({
        "padding-top": "15px",
      });
    }
  });
});

//------------------- Start active nav link --------------
// const navContainer = document.querySelector("nav ul"),
//   navLinks = navContainer.children,
//   totalNavLinks = navLinks.length;

// for (let i = 0; i < totalNavLinks; i++) {
//   navLinks[i].addEventListener("click", function () {
//     navContainer.querySelector(".active").classList.remove("active");
//     this.querySelector("a").classList.add("active");
//   });
// }

// navContainer.querySelector(".active").classList.remove("active");
// navLinks[0].querySelector("a").classList.add("active");

//using jquery
$(document).ready(function () {
  "use strict";

  $("nav ul li a").click(function () {
    "use strict";

    $("nav ul li a").removeClass("active");
    $(this).addClass("active");
  });
});

//-------------------- End active nav link ---------------------
//-------------------- Active menu link on small screen
$(document).ready(function () {
  "use strict";

  $("header nav .toogle-menu").click(function () {
    "use strict";

    $("nav ul").toggleClass("subMenu");
  });
});

$(document).ready(function () {
  "use strict";

  $("nav ul li a").click(function () {
    "use strict";

    $("nav ul").removeClass("subMenu");
  });
});

// -------------------- Add Smooth Scrolling --------------------
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

    $("body > div").each(function () {
      "use strict";

      var bb = $(this).attr("id"); //about contact download
      var hei = $(this).outerHeight();
      var grttop = $(this).offset().top - 70;

      if (
        $(window).scrollTop() > grttop &&
        $(window).scrollTop() < grttop + hei
      ) {
        $("nav ul li a[href='#" + bb + "']").addClass("active");
      } else {
        $("nav ul li a[href='#" + bb + "']").removeClass("active");
      }
    });
  });
});

//***************************  End nav work with  *************/

// ************** Start  part of up button ****************

// get Element by id
let go_up_btn = document.getElementById("up");

// test scrolling if it is more than 1000 pixel
// if more than then set element style to display block
window.onscroll = function () {
  console.log(scrollY);
  if (window.scrollY >= 1000) {
    console.log(true);
    go_up_btn.style.setProperty("display", "block");
  } else {
    go_up_btn.style.setProperty("display", "none");
  }
};

// add listener of click => if clicked to will scroll to the point pointed in the bult in  function
go_up_btn.addEventListener("click", () => {
  scrollTo(0, 0);
  navContainer.querySelector(".active").classList.remove("active");
  navLinks[0].querySelector("a").classList.add("active");
});

// ************** End  part of up button ****************

//*************** Start Portfolio Item Filter **************

const filterContainer = document.querySelector(".Portfolio-filter"),
  filterBtn = filterContainer.children,
  totalFilterBtn = filterBtn.length,
  portfolioItem = document.querySelectorAll(".Portfolio-item"),
  totalPortfolioItem = portfolioItem.length;

//console.log(totalfilter);
for (let i = 0; i < totalFilterBtn; i++) {
  filterBtn[i].addEventListener("click", function () {
    // for(let j = 0 ; j < totalFilterBtn ; j++ ){
    //     filterBtn[j].classList.remove("active");
    // }
    filterContainer.querySelector(".active").classList.remove("active");
    this.classList.add("active");
    /*
              used to show the profilio item when click on filter buttom by comparing
              data-falter in falter part with data-category in portfolio item
           */
    let filterValue = this.getAttribute("data-filter");

    for (let k = 0; k < totalPortfolioItem; k++) {
      if (filterValue === portfolioItem[k].getAttribute("data-category")) {
        portfolioItem[k].classList.remove("hide");
        portfolioItem[k].classList.add("show");
      } else {
        portfolioItem[k].classList.remove("show");
        portfolioItem[k].classList.add("hide");
      }
      if (filterValue === "all") {
        portfolioItem[k].classList.remove("hide");
        portfolioItem[k].classList.add("show");
      }
    }
  });
}

//*************** Start Portfolio Item Filter **************

// ************** start video more effect ****************
const video_more = document.getElementById("video_more"),
  video_more_info = document.querySelector(".video-more-info");

video_more.addEventListener("click", function () {
  let btnContent = this.textContent;
  if (btnContent == "see more") {
    // video_more_info.style.display = "block";
    fadeIn(video_more_info);
    this.textContent = "see less";
    clearInterval(intervalID);
  } else {
    // video_more_info.style.display = "none";
    fadeOut(video_more_info);
    this.textContent = "see more";
  }
});

// ************** End video more effect ****************

//************** Start Statistics work  ****************
//-------------- Add counter lib ---------------
$(document).ready(function () {
  "user strict";

  $(".stats .number").counterUp({
    delay: 10,
    time: 2000,
  });
});

//************** End Statistics work  ****************

//************** Start animation work for the hole page *************/

//Add animation ,initialize wow
// link of use is : https://wowjs.uk/docs.html and https://animate.style/

$(document).ready(function () {
  "use strict";
  new WOW().init();
});
//************** End animation work for the hole page *************/

//Add bx slider to screens link of use : https://bxslider.com/
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
