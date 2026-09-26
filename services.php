<?php

include __DIR__ . '/includes/header.php';


/* =========================================
   SERVICES DATA
========================================= */

$services = [

    [
        'icon' => 'fa-solid fa-user-check',
        'title' => 'Free Profile Evaluation',
        'description' => 'Gather your goals, academics, English level, and budget to recommend the best-fit programmes and destinations.',
        'result' => '1,200+ profiles evaluated'
    ],

    [
        'icon' => 'fa-solid fa-globe',
        'title' => 'Course & Country Match',
        'description' => 'Personalised programme matching using ROI-based research. Covers undergraduate, postgraduate, and PhD/MRes pathways across multiple destinations.',
        'result' => '95% student satisfaction rate'
    ],

    [
        'icon' => 'fa-solid fa-flask',
        'title' => 'PhD/MRes Proposal & Supervisor Support',
        'description' => 'Assistance with writing research proposals, identifying universities, connecting with supervisors, and preparing for research interviews.',
        'result' => '50+ research proposals approved'
    ],

    [
        'icon' => 'fa-solid fa-folder-open',
        'title' => 'Admission & Application Support',
        'description' => 'Guidance on document preparation (SOP, CV, LOR), application strategy, and university deadlines — ensuring quality submissions.',
        'result' => '300+ successful admissions'
    ],

    [
        'icon' => 'fa-solid fa-hand-holding-dollar',
        'title' => 'Scholarships & Funding Advice',
        'description' => 'Curated support for Chevening, Commonwealth, GREAT, Australia Awards, and Canada/NZ scholarships. Paid sessions: BDT 5,000/hour.',
        'result' => '40+ scholarship winners'
    ],

    [
        'icon' => 'fa-solid fa-file-shield',
        'title' => 'Compliance & Document Review',
        'description' => 'Ensure all applications meet UKVI, IRCC, MARA, and British Council standards. Authenticity and accuracy verified before submission.',
        'result' => '100% compliance record'
    ],

    [
        'icon' => 'fa-solid fa-passport',
        'title' => 'Visa Guidance & Interview Preparation',
        'description' => 'Step-by-step visa guidance and mock interviews conducted ethically — no fake documents, no job/PR guarantees.',
        'result' => '98% visa success under supervised guidance'
    ],

    [
        'icon' => 'fa-solid fa-plane-departure',
        'title' => 'Pre-Departure & Orientation',
        'description' => 'Training on banking, housing, health insurance, cultural adaptation, and part-time work readiness.',
        'result' => ''
    ],

    [
        'icon' => 'fa-solid fa-briefcase',
        'title' => 'Post-Arrival & Career Support',
        'description' => 'Connect with alumni networks, professional bodies, and ROI planning sessions. Explore internships, research, and global career mobility.',
        'result' => '200+ alumni connected'
    ],

    [
        'icon' => 'fa-solid fa-language',
        'title' => 'Language & Communication Training',
        'description' => 'Kids English, Travellers\' English, Professional English, and communication workshops by verified partners.',
        'result' => ''
    ]

];

?>

<main class="services-page">


    <!-- =========================================
         SERVICES HERO
    ========================================== -->

    <section
        class="services-banner"
        style="
            background-image:
                linear-gradient(
                    rgba(74, 91, 104, 0.58),
                    rgba(74, 91, 104, 0.58)
                ),
                url('assets/images/about-bg.jpg');
        "
    >

        <div class="services-banner-content reveal">

            <h1>
                OUR SERVICES
            </h1>

            <p>
                KHAN &amp; TEAMS EDUCATION – ETHICAL,
                RESEARCH-DRIVEN, ROI-FOCUSED STUDENT GUIDANCE
            </p>

        </div>

    </section>


    <!-- =========================================
         SERVICES CATALOGUE
    ========================================== -->

    <section class="services-catalogue">

        <div class="services-container">


            <!-- Section Heading -->

            <div class="services-heading reveal">

                <h2>
                    Our Comprehensive Service Catalogue
                </h2>

                <div class="services-heading-line"></div>

                <p>
                    From profile evaluation to post-arrival support —
                    we guide every step of your global education journey
                    with ethics and ROI in mind.
                </p>

            </div>


            <!-- Service Cards -->

            <div class="services-grid">

                <?php foreach ($services as $service): ?>

                    <article class="service-card reveal">


                        <!-- Icon -->

                        <div class="service-card-icon">

                            <i
                                class="<?= htmlspecialchars($service['icon']) ?>"
                            ></i>

                        </div>


                        <!-- Title -->

                        <h3>
                            <?= htmlspecialchars($service['title']) ?>
                        </h3>


                        <!-- Description -->

                        <p class="service-description">
                            <?= htmlspecialchars($service['description']) ?>
                        </p>


                        <!-- Result -->

                        <?php if (!empty($service['result'])): ?>

                            <p class="service-result">

                                <i class="fa-solid fa-check"></i>

                                <?= htmlspecialchars($service['result']) ?>

                            </p>

                        <?php endif; ?>


                        <!-- Button -->

                        <a
                            href="contact.php"
                            class="service-btn"
                        >
                            Get Started
                        </a>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


</main>


<?php

include __DIR__ . '/includes/footer.php';

?>