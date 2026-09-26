<?php

require_once __DIR__ . '/../config/database.php';


// =====================================================
// GET EDUCATION ROI PROGRAM
// =====================================================

$stmt = $pdo->prepare("
    SELECT *
    FROM programs
    WHERE slug = :slug
      AND status = 1
    LIMIT 1
");

$stmt->execute([
    ':slug' => 'education-roi'
]);

$program = $stmt->fetch();


// =====================================================
// IF PROGRAM NOT FOUND
// =====================================================

if (!$program) {
    die('Program not found.');
}


// =====================================================
// GET ROI SUCCESS STORIES
// =====================================================

$storyStmt = $pdo->prepare("
    SELECT *
    FROM roi_stories
    WHERE program_id = :program_id
      AND status = 1
    ORDER BY sort_order ASC
");

$storyStmt->execute([
    ':program_id' => $program['id']
]);

$roiStories = $storyStmt->fetchAll();


include __DIR__ . '/../includes/header.php';

?>

<main class="roi-page">


    <!-- =====================================================
         HERO BANNER
    ====================================================== -->

    <section
        class="roi-banner"
        style="
            background-image:
                linear-gradient(
                    rgba(74, 91, 104, 0.58),
                    rgba(74, 91, 104, 0.58)
                ),
                url('../assets/images/about-bg.jpg');
        "
    >

        <div class="roi-banner-content reveal">

            <h1>
                ROI IN REAL LIFE
            </h1>

            <p>
                KHAN &amp; TEAMS EDUCATION – REAL OUTCOMES THROUGH
                EDUCATION THAT BRINGS RETURN ON INVESTMENT
            </p>

        </div>

    </section>


    <!-- =====================================================
         SUCCESS STORIES
    ====================================================== -->

    <section class="roi-main-section">

        <div class="roi-container">


            <!-- Page heading -->

            <div class="roi-heading reveal">

                <h2>
                    Success Stories
                </h2>

                <div class="roi-heading-line"></div>

                <p>
                    Real examples of how strategic education choices
                    have led to career success and ROI
                </p>

            </div>


            <!-- =================================================
                 ROI CARDS
            ================================================== -->

            <div class="roi-grid">

                <?php foreach ($roiStories as $story): ?>

                    <article class="roi-card reveal">


                        <!-- Card top -->

                        <div class="roi-card-top">

                            <div class="roi-story-icon">

                                <i
                                    class="<?= htmlspecialchars($story['icon']) ?>"
                                ></i>

                            </div>

                            <span class="roi-country">

                                <?= htmlspecialchars($story['country']) ?>

                            </span>

                        </div>


                        <!-- Title -->

                        <h3>

                            <?= htmlspecialchars($story['title']) ?>

                        </h3>


                        <!-- Description -->

                        <p class="roi-description">

                            <?= htmlspecialchars($story['description']) ?>

                        </p>


                        <!-- Journey -->

                        <div class="roi-journey">

                            <span>
                                <?= htmlspecialchars($story['from_label']) ?>
                            </span>

                            <i class="fa-solid fa-arrow-right"></i>

                            <span>
                                <?= htmlspecialchars($story['to_label']) ?>
                            </span>

                        </div>


                        <!-- Details -->

                        <div class="roi-details">


                            <div class="roi-detail-row">

                                <span>
                                    <?= htmlspecialchars($story['degree_label']) ?>
                                </span>

                                <strong>
                                    <?= htmlspecialchars($story['degree']) ?>
                                </strong>

                            </div>


                            <div class="roi-detail-row">

                                <span>
                                    <?= htmlspecialchars($story['investment_label']) ?>
                                </span>

                                <strong>
                                    <?= htmlspecialchars($story['investment']) ?>
                                </strong>

                            </div>


                            <div class="roi-detail-row">

                                <span>
                                    <?= htmlspecialchars($story['salary_label']) ?>
                                </span>

                                <strong>
                                    <?= htmlspecialchars($story['salary']) ?>
                                </strong>

                            </div>


                            <div class="roi-detail-row">

                                <span>
                                    <?= htmlspecialchars($story['timeline_label']) ?>
                                </span>

                                <strong>
                                    <?= htmlspecialchars($story['timeline']) ?>
                                </strong>

                            </div>


                        </div>


                    </article>

                <?php endforeach; ?>

            </div>


            <!-- =================================================
                 IMPORTANT DISCLAIMER
            ================================================== -->

            <div class="roi-disclaimer reveal">

                <div class="roi-disclaimer-icon">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>


                <div>

                    <h3>
                        Important Disclaimer
                    </h3>

                    <p>
                        We prepare students through education only — no guarantee
                        of job, PR, or skill visa. These success stories represent
                        individual outcomes that may not be typical. Success depends
                        on individual effort, market conditions, applicable policies,
                        and numerous other factors beyond our control. We provide
                        guidance based on current regulations and job market trends,
                        but we cannot guarantee specific outcomes.
                    </p>

                </div>

            </div>


        </div>

    </section>

</main>


<?php

include __DIR__ . '/../includes/footer.php';

?>