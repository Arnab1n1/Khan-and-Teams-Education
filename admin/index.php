<?php

require_once __DIR__ . '/../config/database.php';


// =====================================================
// GET COUNTS
// =====================================================

$programCount = $pdo->query("
    SELECT COUNT(*)
    FROM programs
")->fetchColumn();


$applicationCount = $pdo->query("
    SELECT COUNT(*)
    FROM applications
")->fetchColumn();


$contactCount = $pdo->query("
    SELECT COUNT(*)
    FROM contact_messages
")->fetchColumn();


$partnerCount = $pdo->query("
    SELECT COUNT(*)
    FROM partner_applications
")->fetchColumn();


$leadCount = $pdo->query("
    SELECT COUNT(*)
    FROM leads
")->fetchColumn();


$blogCount = $pdo->query("
    SELECT COUNT(*)
    FROM blogs
")->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Dashboard | Khan & Teams Education</title>


    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f4f6f8;
            color: #263238;
            font-family: Arial, sans-serif;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
        }

        .header p {
            margin-top: 8px;
            color: #607d8b;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: #ffffff;
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #607d8b;
        }

        .count {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #4a5b68;
        }

        .card-link {
            display: inline-block;
            margin-top: 18px;
            padding: 9px 14px;
            background: #4a5b68;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .card-link:hover {
            background: #37474f;
        }

        .website-link {
            display: inline-block;
            margin-top: 30px;
            color: #4a5b68;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 900px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            body {
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>

<div class="dashboard">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="header">

        <h1>
            Admin Dashboard
        </h1>

        <p>
            Khan &amp; Teams Education
        </p>

    </div>


    <!-- =====================================================
         DASHBOARD CARDS
    ====================================================== -->

    <div class="cards">


        <!-- Programs -->

        <div class="card">

            <h3>
                Programs
            </h3>

            <p class="count">
                <?= (int) $programCount ?>
            </p>

            <a
                href="programs.php"
                class="card-link"
            >
                Manage Programs
            </a>

        </div>


        <!-- Applications -->

        <div class="card">

            <h3>
                Applications
            </h3>

            <p class="count">
                <?= (int) $applicationCount ?>
            </p>

            <a
                href="applications.php"
                class="card-link"
            >
                View Applications
            </a>

        </div>


        <!-- Contact Messages -->

        <div class="card">

            <h3>
                Contact Messages
            </h3>

            <p class="count">
                <?= (int) $contactCount ?>
            </p>

            <a
                href="messages.php"
                class="card-link"
            >
                View Messages
            </a>

        </div>


        <!-- Partner Applications -->

        <div class="card">

            <h3>
                Partner Applications
            </h3>

            <p class="count">
                <?= (int) $partnerCount ?>
            </p>

            <a
                href="partners.php"
                class="card-link"
            >
                View Partners
            </a>

        </div>


        <!-- Leads -->

        <div class="card">

            <h3>
                Leads
            </h3>

            <p class="count">
                <?= (int) $leadCount ?>
            </p>

            <a
                href="leads.php"
                class="card-link"
            >
                View Leads
            </a>

        </div>


        <!-- Blogs -->

        <div class="card">

            <h3>
                Blogs
            </h3>

            <p class="count">
                <?= (int) $blogCount ?>
            </p>

            <a
                href="#"
                class="card-link"
            >
                Blog Management
            </a>

        </div>


    </div>


    <!-- =====================================================
         BACK TO WEBSITE
    ====================================================== -->

    <a
        href="../index.php"
        class="website-link"
    >
        ← Back to Website
    </a>


</div>

</body>

</html>