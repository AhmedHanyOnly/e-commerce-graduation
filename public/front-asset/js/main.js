// Click tog-show
if (document.querySelector(".tog-show")) {
    let togglesShow = document.querySelectorAll(".tog-show");
    togglesShow.forEach((e) => {
        let togg = true;
        e.addEventListener("click", (evt) => {
            let listItem = document.querySelector(e.getAttribute("data-show"));
            if (togg == true) {
                listItem.style.display = "flex";
                togg = false;
            } else {
                listItem.style.display = "none";
                togg = true;
            }
        });
    });
}
if (document.querySelector(".swiper-landing")) {
    new Swiper(".swiper-landing", {
        parallax: true,
        effect: "fade",
        centeredSlides: true,
        loop: true,
        spaceBetween: 10,
        speed: 1400,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".pagination",
            clickable: true,
        },
    });
}
if (document.querySelector(".product-slider")) {
    new Swiper(".product-slider", {
        slidesPerView: 1,
        spaceBetween: 21,
        loop: false,
        speed: 1300,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            720: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}
if (document.querySelector(".productSwiper")) {
    const productSwiper = new Swiper(".productSwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });

    new Swiper(".productSwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: productSwiper,
        },
    });
}

// new Swiper(".thumb-swiper", {
//     direction: "vertical",
//     loop: false,
//     spaceBetween: 10,
//     slidesPerView: 4,
//     freeMode: true,
//     watchSlidesProgress: true,
//     mousewheel: true,
//     // on: {
//     //     resize: function () {
//     //         swiper.changeDirection(getDirection());
//     //     },
//     // },
//     breakpoints: {
//         720: {
//             slidesPerView: 3,
//             // direction: "horizontal",
//         },
//         992: {
//             slidesPerView: 4,
//         },
//     },
// });
// function getDirection() {
//     // var windowWidth = window.innerWidth;
//     var direction = window.innerWidth <= 760 ? "horizontal" : "vertical";
//     return direction;
// }

// new Swiper(".show-pr-swiper", {
//     loop: false,
//     spaceBetween: 10,
//     navigation: {
//         nextEl: ".swiper-button-next",
//         prevEl: ".swiper-button-prev",
//     },
//     thumbs: {
//         swiper: swiper,
//     },
// });

window.addEventListener("load", () => {
    setTimeout(() => {
        const loaderContainer = document.querySelector(".loader-holder");
        document.body.style.overflow = "auto";
        loaderContainer.classList.add("hidden-loader");
    }, 100);
});
// print
if (document.getElementById("prt-content")) {
    const btnPrtContent = document.getElementById("btn-prt-content");
    btnPrtContent.addEventListener("click", printDiv);

    function printDiv() {
        const prtContent = document.getElementById("prt-content");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(prtContent.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
}
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
