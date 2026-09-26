<?php

require_once __DIR__ . '/config/database.php';

$stmt = $pdo->prepare("
    SELECT *
    FROM programs
    WHERE slug = :slug
      AND status = 1
    LIMIT 1
");

$stmt->execute([
    ':slug' => 'phd-mres-proposal'
]);

$program = $stmt->fetch();

if (!$program) {
    die('Program not found.');
}

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

<main class="phd-page">

    <section
        class="phd-banner"
        style="
            background-image:
                linear-gradient(
                    rgba(74, 91, 104, 0.58),
                    rgba(74, 91, 104, 0.58)
                ),
                url('assets/images/about-bg.jpg');
        "
    >

        <div class="phd-banner-content reveal">

            <h1>
                <?= htmlspecialchars($program['title']) ?>
            </h1>

            <p>
                <?= htmlspecialchars($program['subtitle']) ?>
            </p>

        </div>

    </section>

    <section class="phd-main-section">

        <div class="phd-container">

            <div class="phd-heading reveal">

                <h2>
                    <?= htmlspecialchars($program['title']) ?>
                </h2>

                <div class="phd-heading-line"></div>

                <p>
                    <?= htmlspecialchars($program['short_description']) ?>
                </p>

            </div>

            <div class="phd-grid">

                <?php foreach ($sections as $section): ?>

                    <?php if ($section['section_title'] !== 'Ready to Begin?'): ?>

                        <article class="phd-card reveal">

                            <div class="phd-card-icon">
                                <i class="fa-solid <?= htmlspecialchars($section['icon']) ?>"></i>
                            </div>

                            <h3>
                                <?= htmlspecialchars($section['section_title']) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars($section['content']) ?>
                            </p>

                        </article>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>

            <?php foreach ($sections as $section): ?>

                <?php if ($section['section_title'] === 'Ready to Begin?'): ?>

                    <article class="phd-ready-card reveal">

                        <div class="phd-card-icon">
                            <i class="fa-solid <?= htmlspecialchars($section['icon']) ?>"></i>
                        </div>

                        <h3>
                            <?= htmlspecialchars($section['section_title']) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($section['content']) ?>
                        </p>

                        <div class="phd-ready-buttons">

                            <a
                                href="apply.now.php"
                                class="phd-action-btn"
                            >
                                Apply Now
                            </a>

                            <a
                                href="apply.now.php"
                                class="phd-action-btn"
                            >
                                Book Counselling (BDT 5,000)
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