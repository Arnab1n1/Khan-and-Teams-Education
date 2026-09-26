<?php

require_once __DIR__ . '/../config/database.php';


// =====================================================
// GET PROGRAM ID
// =====================================================

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    die('Invalid program ID.');
}


// =====================================================
// GET PROGRAM
// =====================================================

$stmt = $pdo->prepare("
    SELECT *
    FROM programs
    WHERE id = :id
    LIMIT 1
");

$stmt->execute([
    ':id' => $id
]);

$program = $stmt->fetch();


// =====================================================
// PROGRAM NOT FOUND
// =====================================================

if (!$program) {
    die('Program not found.');
}


// =====================================================
// FORM SUBMISSION
// =====================================================

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title             = trim($_POST['title'] ?? '');
    $slug              = trim($_POST['slug'] ?? '');
    $subtitle          = trim($_POST['subtitle'] ?? '');
    $short_description = trim($_POST['short_description'] ?? '');
    $duration          = trim($_POST['duration'] ?? '');
    $fee               = trim($_POST['fee'] ?? '');
    $mode              = trim($_POST['mode'] ?? '');
    $description       = trim($_POST['description'] ?? '');
    $image             = trim($_POST['image'] ?? '');
    $status             = isset($_POST['status'])
        ? (int) $_POST['status']
        : 1;


    // =================================================
    // VALIDATION
    // =================================================

    if ($title === '' || $slug === '') {

        $error = 'Title and Slug are required.';

    } else {

        try {

            // =============================================
            // UPDATE PROGRAM
            // =============================================

            $stmt = $pdo->prepare("
                UPDATE programs
                SET
                    title = :title,
                    slug = :slug,
                    subtitle = :subtitle,
                    short_description = :short_description,
                    duration = :duration,
                    fee = :fee,
                    mode = :mode,
                    description = :description,
                    image = :image,
                    status = :status
                WHERE id = :id
            ");


            $stmt->execute([

                ':title'             => $title,
                ':slug'              => $slug,
                ':subtitle'          => $subtitle,
                ':short_description' => $short_description,
                ':duration'          => $duration,
                ':fee'               => $fee,
                ':mode'              => $mode,
                ':description'       => $description,
                ':image'             => $image,
                ':status'            => $status,
                ':id'                => $id

            ]);


            // =============================================
            // REDIRECT
            // =============================================

            header('Location: programs.php?updated=1');
            exit;


        } catch (PDOException $e) {

            // Duplicate slug

            if ($e->getCode() === '23000') {

                $error =
                    'This slug already exists. Please use a different slug.';

            } else {

                $error =
                    'Something went wrong while updating the program.';

            }

        }

    }


    // Keep entered values if there is an error

    $program['title']             = $title;
    $program['slug']              = $slug;
    $program['subtitle']          = $subtitle;
    $program['short_description'] = $short_description;
    $program['duration']          = $duration;
    $program['fee']               = $fee;
    $program['mode']              = $mode;
    $program['description']       = $description;
    $program['image']             = $image;
    $program['status']            = $status;

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
        Edit Program | Khan &amp; Teams Education
    </title>


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

        .admin-container {
            max-width: 950px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 7px;
            font-size: 30px;
        }

        .page-header p {
            margin: 0;
            color: #607d8b;
        }

        .form-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #4a5b68;
        }

        .help-text {
            display: block;
            margin-top: 6px;
            color: #78909c;
            font-size: 12px;
        }

        .error-message {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 7px;
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f1aeb5;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 11px 20px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .save-btn {
            background: #4a5b68;
            color: #ffffff;
        }

        .save-btn:hover {
            background: #37474f;
        }

        .cancel-btn {
            background: #eceff1;
            color: #37474f;
        }

        .cancel-btn:hover {
            background: #dde3e6;
        }

    </style>

</head>


<body>

<div class="admin-container">


    <!-- =====================================================
         PAGE HEADER
    ====================================================== -->

    <div class="page-header">

        <h1>
            Edit Program
        </h1>

        <p>
            Update the selected program information.
        </p>

    </div>


    <!-- =====================================================
         FORM
    ====================================================== -->

    <div class="form-card">


        <?php if ($error !== ''): ?>

            <div class="error-message">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <form
            action="edit-program.php?id=<?= (int) $program['id'] ?>"
            method="post"
        >


            <!-- Title -->

            <div class="form-group">

                <label for="title">
                    Program Title *
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="<?= htmlspecialchars($program['title']) ?>"
                    required
                >

            </div>


            <!-- Slug -->

            <div class="form-group">

                <label for="slug">
                    Slug *
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="<?= htmlspecialchars($program['slug']) ?>"
                    required
                >

                <span class="help-text">
                    Use lowercase letters and hyphens.
                </span>

            </div>


            <!-- Subtitle -->

            <div class="form-group">

                <label for="subtitle">
                    Subtitle
                </label>

                <input
                    type="text"
                    id="subtitle"
                    name="subtitle"
                    value="<?= htmlspecialchars($program['subtitle'] ?? '') ?>"
                >

            </div>


            <!-- Short Description -->

            <div class="form-group">

                <label for="short_description">
                    Short Description
                </label>

                <textarea
                    id="short_description"
                    name="short_description"
                ><?= htmlspecialchars($program['short_description'] ?? '') ?></textarea>

            </div>


            <!-- Duration -->

            <div class="form-group">

                <label for="duration">
                    Duration
                </label>

                <input
                    type="text"
                    id="duration"
                    name="duration"
                    value="<?= htmlspecialchars($program['duration'] ?? '') ?>"
                >

            </div>


            <!-- Fee -->

            <div class="form-group">

                <label for="fee">
                    Fee
                </label>

                <input
                    type="text"
                    id="fee"
                    name="fee"
                    value="<?= htmlspecialchars($program['fee'] ?? '') ?>"
                >

            </div>


            <!-- Mode -->

            <div class="form-group">

                <label for="mode">
                    Mode
                </label>

                <input
                    type="text"
                    id="mode"
                    name="mode"
                    value="<?= htmlspecialchars($program['mode'] ?? '') ?>"
                >

            </div>


            <!-- Description -->

            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                ><?= htmlspecialchars($program['description'] ?? '') ?></textarea>

            </div>


            <!-- Image -->

            <div class="form-group">

                <label for="image">
                    Image Path
                </label>

                <input
                    type="text"
                    id="image"
                    name="image"
                    value="<?= htmlspecialchars($program['image'] ?? '') ?>"
                >

            </div>


            <!-- Status -->

            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                >

                    <option
                        value="1"
                        <?= (int) $program['status'] === 1 ? 'selected' : '' ?>
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        <?= (int) $program['status'] === 0 ? 'selected' : '' ?>
                    >
                        Inactive
                    </option>

                </select>

            </div>


            <!-- Buttons -->

            <div class="form-actions">

                <button
                    type="submit"
                    class="btn save-btn"
                >
                    Update Program
                </button>


                <a
                    href="programs.php"
                    class="btn cancel-btn"
                >
                    Cancel
                </a>

            </div>


        </form>

    </div>


</div>

</body>

</html>