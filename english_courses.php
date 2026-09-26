<?php

require_once __DIR__ . '/config/database.php';


// =====================================================
// GET ENGLISH COURSES PROGRAM
// =====================================================

$stmt = $pdo->prepare("
    SELECT *
    FROM programs
    WHERE slug = :slug
      AND status = 1
    LIMIT 1
");

$stmt->execute([
    ':slug' => 'english-courses'
]);

$program = $stmt->fetch();


// =====================================================
// IF PROGRAM NOT FOUND
// =====================================================

if (!$program) {
    die('Program not found.');
}


// =====================================================
// GET PROGRAM SECTIONS
// =====================================================

$sectionStmt = $pdo->prepare("
    SELECT *
    FROM program_sections
    WHERE program_id = :program_id
      AND status = 1
    ORDER BY sort_order ASC
");

$sectionStmt->execute([
    ':program_id' => $program['id']
]);

$sections = $sectionStmt->fetchAll();


include __DIR__ . '/includes/header.php';

?>

<main class="english-page">


    <!-- =====================================================
         HERO BANNER
    ====================================================== -->

    <section
        class="english-banner"
        style="
            background-image:
                linear-gradient(
                    rgba(74, 91, 104, 0.58),
                    rgba(74, 91, 104, 0.58)
                ),
                url('assets/images/about-bg.jpg');
        "
    >

        <div class="english-banner-content reveal">

            <h1>
                <?= htmlspecialchars($program['title']) ?>
            </h1>

            <p>
                <?= htmlspecialchars($program['subtitle']) ?>
            </p>

        </div>

    </section>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    <section class="english-main-section">

        <div class="english-container">


            <!-- =================================================
                 PAGE HEADING
            ================================================== -->

            <div class="english-heading reveal">

                <h2>
                    <?= htmlspecialchars($program['title']) ?>
                </h2>

                <div class="english-heading-line"></div>

                <p>
                    <?= htmlspecialchars($program['short_description']) ?>
                </p>

            </div>


            <!-- =================================================
                 COURSE GRID
            ================================================== -->

            <div class="english-grid">

                <?php foreach ($sections as $section): ?>

                    <?php

                    if ($section['section_title'] === 'Get Started Today') {
                        continue;
                    }

                    $lines = preg_split(
                        "/\r\n|\r|\n/",
                        $section['content']
                    );

                    $description = trim($lines[0]);

                    ?>


                    <article class="english-card reveal">


                        <!-- Icon -->

                        <div class="english-card-icon">

                            <i class="fa-solid <?= htmlspecialchars($section['icon']) ?>"></i>

                        </div>


                        <!-- Title -->

                        <h3>
                            <?= htmlspecialchars($section['section_title']) ?>
                        </h3>


                        <!-- Description -->

                        <p>
                            <?= htmlspecialchars($description) ?>
                        </p>


                        <!-- Course Details -->

                        <div class="english-course-details">

                            <?php foreach (array_slice($lines, 1) as $detail): ?>

                                <?php

                                $detail = trim($detail);

                                if ($detail === '') {
                                    continue;
                                }

                                $parts = explode(':', $detail, 2);

                                ?>


                                <p>

                                    <?php if (count($parts) === 2): ?>

                                        <strong>
                                            <?= htmlspecialchars(trim($parts[0])) ?>:
                                        </strong>

                                        <?= htmlspecialchars(trim($parts[1])) ?>

                                    <?php else: ?>

                                        <?= htmlspecialchars($detail) ?>

                                    <?php endif; ?>

                                </p>


                            <?php endforeach; ?>

                        </div>


                    </article>

                <?php endforeach; ?>

            </div>


            <!-- =================================================
                 GET STARTED CARD
            ================================================== -->

            <?php foreach ($sections as $section): ?>

                <?php if ($section['section_title'] === 'Get Started Today'): ?>

                    <article class="english-ready-card reveal">


                        <div class="english-card-icon">

                            <i class="fa-solid <?= htmlspecialchars($section['icon']) ?>"></i>

                        </div>


                        <h3>
                            <?= htmlspecialchars($section['section_title']) ?>
                        </h3>


                        <p>
                            <?= htmlspecialchars($section['content']) ?>
                        </p>


                        <div class="english-ready-buttons">


                            <!-- Apply Now -->

                            <a
                                href="apply.now.php"
                                class="english-action-btn"
                            >
                                Apply Now
                            </a>


                            <!-- Get Started -->

                            <a
                                href="apply.now.php"
                                class="english-action-btn"
                            >
                                Get Started
                            </a>


                        </div>


                    </article>

                <?php endif; ?>

            <?php endforeach; ?>


        </div>

    </section>

</main>


<?php

include __DIR__ . '/includes/footer.php';

?>