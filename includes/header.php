<?php

/* =========================================================
   CURRENT PAGE
========================================================= */

$currentPage = basename($_SERVER['PHP_SELF']);


/* =========================================================
   CHECK IF CURRENT PAGE IS INSIDE ROI FOLDER
========================================================= */

$isInsideRoiFolder =
    basename(dirname($_SERVER['SCRIPT_FILENAME'])) === 'roi';


/* =========================================================
   BASE PATH
   Root pages     -> ""
   roi/index.php  -> "../"
========================================================= */

$basePath = $isInsideRoiFolder ? '../' : '';


/* =========================================================
   ACTIVE NAVIGATION
========================================================= */

function navClass($pageName)
{
    global $currentPage, $isInsideRoiFolder;


    /* =====================================================
       PROGRAMS SECTION
    ====================================================== */

    if ($pageName === 'programs.php') {

        $programPages = [
            'ppp.php',
            'phd_proposal.php',
            'english_courses.php'
        ];


        /* Root-level program pages */

        if (
            in_array($currentPage, $programPages, true)
        ) {
            return 'active';
        }


        /* ROI page */

        if (
            $isInsideRoiFolder &&
            $currentPage === 'index.php'
        ) {
            return 'active';
        }

    }


    /* =====================================================
       NORMAL NAVIGATION
    ====================================================== */

    return $currentPage === $pageName
        ? 'active'
        : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Khan &amp; Teams Education
    </title>


    <meta
        name="description"
        content="Khan & Teams Education - ethical, transparent and ROI-focused education guidance."
    >


    <!-- =====================================================
         GOOGLE FONTS
    ====================================================== -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- =====================================================
         FONT AWESOME
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    <!-- =====================================================
         MAIN CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= $basePath ?>css/style.css"
    >

</head>


<body>


<!-- =========================================================
     STICKY HEADER
========================================================= -->

<header
    class="site-header"
    id="siteHeader"
>

    <div class="nav-shell">


        <!-- =================================================
             BRAND / LOGO
        ================================================== -->

        <a
            href="<?= $basePath ?>index.php"
            class="brand"
        >

            <img
                src="<?= $basePath ?>assets/images/logo.png"
                alt="Khan & Teams Education"
                class="brand-logo"
            >

            <span class="brand-fallback">

                Khan &amp; Teams
                <br>
                Education

            </span>

        </a>


        <!-- =================================================
             MOBILE MENU BUTTON
        ================================================== -->

        <button
            class="menu-toggle"
            id="menuToggle"
            aria-label="Toggle navigation"
            aria-expanded="false"
            type="button"
        >

            <i class="fa-solid fa-bars"></i>

        </button>


        <!-- =================================================
             MAIN NAVIGATION
        ================================================== -->

        <nav
            class="main-nav"
            id="mainNav"
        >


            <!-- =================================================
                 HOME
            ================================================== -->

            <a
                class="<?= navClass('index.php') ?>"
                href="<?= $basePath ?>index.php"
            >
                Home
            </a>


            <!-- =================================================
                 ABOUT US
            ================================================== -->

            <a
                class="<?= navClass('about.php') ?>"
                href="<?= $basePath ?>about.php"
            >
                About Us
            </a>


            <!-- =================================================
                 SERVICES
            ================================================== -->

            <a
                class="<?= navClass('services.php') ?>"
                href="<?= $basePath ?>services.php"
            >
                Services
            </a>


            <!-- =================================================
                 PROGRAMS DROPDOWN
            ================================================== -->

            <div
                class="nav-dropdown <?= navClass('programs.php') ?>"
            >


                <!--
                    Programs is now a parent dropdown item.
                    It does not open programs.php.
                -->

                <span class="nav-dropdown-link">

                    Programs

                    <i class="fa-solid fa-chevron-down"></i>

                </span>


                <!-- =================================================
                     PROGRAM DROPDOWN MENU
                ================================================== -->

                <div class="program-dropdown-menu">


                    <!-- PPP 2025 -->

                    <a
                        href="<?= $basePath ?>ppp.php"
                    >
                        PPP 2025
                    </a>


                    <!-- PhD / MRes -->

                    <a
                        href="<?= $basePath ?>phd_proposal.php"
                    >
                        PhD/MRes Proposal
                    </a>


                    <!-- English Courses -->

                    <a
                        href="<?= $basePath ?>english_courses.php"
                    >
                        English Courses
                    </a>


                    <!-- Education ROI -->

                    <a
                        href="<?= $basePath ?>roi/"
                    >
                        Education ROI Add-ons
                    </a>

                </div>

            </div>


            <!-- =================================================
                 DESTINATIONS
            ================================================== -->

            <a
                class="<?= navClass('destinations.php') ?>"
                href="<?= $basePath ?>destinations.php"
            >
                Destinations
            </a>


            <!-- =================================================
                 BLOG
            ================================================== -->

            <a
                class="<?= navClass('blog.php') ?>"
                href="<?= $basePath ?>blog.php"
            >
                Blog
            </a>


            <!-- =================================================
                 CONTACT
            ================================================== -->

            <a
                class="<?= navClass('contact.php') ?>"
                href="<?= $basePath ?>contact.php"
            >
                Contact
            </a>

        </nav>

    </div>

</header>