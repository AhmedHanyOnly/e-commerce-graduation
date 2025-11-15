// Click tog-show
if (document.querySelector(".tog-active")) {
    let togglesShow = document.querySelectorAll(".tog-active");
    togglesShow.forEach((e) => {
        e.addEventListener("click", (evt) => {
            let divActive = document.querySelector(
                e.getAttribute("data-active")
            );
            divActive.classList.toggle("active");
        });
    });
}

// Wave Chart
if (document.getElementById("waveChart")) {
    const ctx = document.getElementById("waveChart");

    new Chart(ctx, {
        type: "line",
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [
                {
                    label: "",
                    data: [120, 190, 30, 50, 20, 30],
                    borderWidth: 1,
                    borderColor: "#8D1EE5",
                    backgroundColor: "#8D1EE5",
                },
                {
                    label: "",
                    data: [12, 40, 100, 20, 40, 10],
                    borderWidth: 1,
                    borderColor: "#0FC859",
                    backgroundColor: "#0FC859",
                },
            ],
        },
        options: {
            responsive: true,
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                },
                y: {
                    display: true,
                    suggestedMin: 0,
                    suggestedMax: 200,
                },
            },
        },
    });
}
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
if (document.querySelector(".swiper-banner")) {
    new Swiper(".swiper-banner", {
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

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
