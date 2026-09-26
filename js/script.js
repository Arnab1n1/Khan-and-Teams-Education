document.addEventListener("DOMContentLoaded", () => {

    const header = document.getElementById("siteHeader");
    const menuToggle = document.getElementById("menuToggle");
    const mainNav = document.getElementById("mainNav");
    const backToTop = document.getElementById("backToTop");


    /* =========================
       STICKY HEADER
    ========================= */

    window.addEventListener("scroll", () => {

        if (window.scrollY > 30) {
            header?.classList.add("scrolled");
        } else {
            header?.classList.remove("scrolled");
        }


        /* Back to top */

        if (window.scrollY > 500) {
            backToTop?.classList.add("show");
        } else {
            backToTop?.classList.remove("show");
        }

    });


    /* =========================
       MOBILE MENU
    ========================= */

    menuToggle?.addEventListener("click", () => {

        const isOpen =
            mainNav?.classList.toggle("open");

        menuToggle.setAttribute(
            "aria-expanded",
            String(isOpen)
        );


        const icon =
            menuToggle.querySelector("i");

        if (icon) {

            icon.className =
                isOpen
                    ? "fa-solid fa-xmark"
                    : "fa-solid fa-bars";

        }

    });


    /* Close menu after click */

    mainNav?.querySelectorAll("a").forEach(link => {

        link.addEventListener("click", () => {

            mainNav.classList.remove("open");

            menuToggle?.setAttribute(
                "aria-expanded",
                "false"
            );

            const icon =
                menuToggle?.querySelector("i");

            if (icon) {
                icon.className =
                    "fa-solid fa-bars";
            }

        });

    });


    /* =========================
       BACK TO TOP
    ========================= */

    backToTop?.addEventListener("click", () => {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });


    /* =========================
       REVEAL ANIMATION
    ========================= */

    const revealElements =
        document.querySelectorAll(".reveal");


    const observer =
        new IntersectionObserver(
            entries => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            "visible"
                        );

                        observer.unobserve(
                            entry.target
                        );

                    }

                });

            },
            {
                threshold: 0.12
            }
        );


    revealElements.forEach(element => {
        observer.observe(element);
    });


    /* =========================
       CAROUSEL
    ========================= */

    document
        .querySelectorAll(".horizontal-carousel")
        .forEach(carousel => {

            const track =
                carousel.querySelector(".carousel-track");

            const prev =
                carousel.querySelector(".carousel-prev");

            const next =
                carousel.querySelector(".carousel-next");


            if (!track) {
                return;
            }


            const getScrollAmount = () => {

                const firstCard =
                    track.firstElementChild;

                if (!firstCard) {
                    return 350;
                }

                const gap =
                    parseFloat(
                        getComputedStyle(track).gap || "20"
                    );

                return (
                    firstCard.getBoundingClientRect().width
                    + gap
                );

            };


            prev?.addEventListener("click", () => {

                track.scrollBy({
                    left: -getScrollAmount(),
                    behavior: "smooth"
                });

            });


            next?.addEventListener("click", () => {

                track.scrollBy({
                    left: getScrollAmount(),
                    behavior: "smooth"
                });

            });

        });

});