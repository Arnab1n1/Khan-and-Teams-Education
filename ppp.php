<?php

require_once __DIR__ . '/config/database.php';


// =====================================================
// GET PPP PROGRAM
// =====================================================

$stmt = $pdo->prepare("
    SELECT *
    FROM programs
    WHERE slug = :slug
      AND status = 1
    LIMIT 1
");

$stmt->execute([
    ':slug' => 'ppp-2025'
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

<main class="ppp-page">


    <!-- =========================================
         PPP HERO
    ========================================== -->

    <section
        class="ppp-banner"
        style="
            background-image:
                linear-gradient(
                    rgba(74, 91, 104, 0.58),
                    rgba(74, 91, 104, 0.58)
                ),
                url('assets/images/about-bg.jpg');
        "
    >

        <div class="ppp-banner-content reveal">

            <h1>
                <?= htmlspecialchars($program['title']) ?>
            </h1>

            <p>
                <?= htmlspecialchars($program['subtitle']) ?>
            </p>

        </div>

    </section>


    <!-- =========================================
         PPP MAIN CONTENT
    ========================================== -->

    <section class="ppp-main-section">

        <div class="ppp-container">


            <!-- =====================================
                 PAGE HEADING
            ====================================== -->

            <div class="ppp-heading reveal">

                <h2>
                    <?= htmlspecialchars($program['title']) ?>
                </h2>

                <div class="ppp-heading-line"></div>

                <p>
                    <?= htmlspecialchars($program['short_description']) ?>
                </p>

            </div>


            <!-- =====================================
                 PPP CARDS
            ====================================== -->

            <div class="ppp-grid">

                <?php foreach ($sections as $index => $section): ?>

                    <article
                        class="ppp-card <?= ($index === count($sections) - 1) ? 'ppp-ready-card' : '' ?> reveal"
                    >

                        <div class="ppp-card-icon">

                            <i class="fa-solid <?= htmlspecialchars($section['icon']) ?>"></i>

                        </div>


                        <h3>
                            <?= htmlspecialchars($section['section_title']) ?>
                        </h3>


                        <div class="ppp-content-list">

                            <?php
                            $lines = preg_split(
                                "/\r\n|\r|\n/",
                                $section['content']
                            );

                            foreach ($lines as $line):

                                $line = trim($line);

                                if ($line === '') {
                                    continue;
                                }
                            ?>

                                <p>
                                    <?= htmlspecialchars($line) ?>
                                </p>

                            <?php endforeach; ?>

                        </div>


                        <?php if ($section['section_title'] === 'Ready to Begin?'): ?>

                            <div class="ppp-card-buttons">

                                <a
                                    href="apply.now.php"
                                    class="ppp-action-btn"
                                >
                                    Apply Now – PPP 2025
                                </a>


                                <a
                                    href="apply.now.php"
                                    class="ppp-action-btn"
                                >
                                    Book Counselling (BDT 5,000)
                                </a>

                            </div>

                        <?php endif; ?>


                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

</main>


<?php

include __DIR__ . '/includes/footer.php';

?>