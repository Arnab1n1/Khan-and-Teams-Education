add-program.php<?php

require_once __DIR__ . '/../config/database.php';


// =====================================================
// FORM SUBMISSION
// =====================================================

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title            = trim($_POST['title'] ?? '');
    $slug             = trim($_POST['slug'] ?? '');
    $subtitle         = trim($_POST['subtitle'] ?? '');
    $short_description = trim($_POST['short_description'] ?? '');
    $duration         = trim($_POST['duration'] ?? '');
    $fee              = trim($_POST['fee'] ?? '');
    $mode              = trim($_POST['mode'] ?? '');
    $description       = trim($_POST['description'] ?? '');
    $image             = trim($_POST['image'] ?? '');
    $status            = isset($_POST['status']) ? (int) $_POST['status'] : 1;


    // =================================================
    // VALIDATION
    // =================================================

    if ($title === '' || $slug === '') {

        $error = 'Title and Slug are required.';

    } else {

        try {

            // =============================================
            // INSERT PROGRAM
            // =============================================

            $stmt = $pdo->prepare("
                INSERT INTO programs
                (
                    title,
                    slug,
                    subtitle,
                    short_description,
                    duration,
                    fee,
                    mode,
                    description,
                    image,
                    status
                )
                VALUES
                (
                    :title,
                    :slug,
                    :subtitle,
                    :short_description,
                    :duration,
                    :fee,
                    :mode,
                    :description,
                    :image,
                    :status
                )
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
                ':status'            => $status

            ]);


            // =============================================
            // REDIRECT
            // =============================================

            header('Location: programs.php?added=1');
            exit;


        } catch (PDOException $e) {

            // Duplicate slug

            if ($e->getCode() === '23000') {

                $error = 'This slug already exists. Please use a different slug.';

            } else {

                $error = 'Something went wrong while adding the program.';

            }

        }

    }

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

    <title>Add Program | Khan & Teams Education</title>


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
            Add New Program
        </h1>

        <p>
            Create a new program record in the database.
        </p>

    </div>


    <!-- =====================================================
         FORM CARD
    ====================================================== -->

    <div class="form-card">


        <?php if ($error !== ''): ?>

            <div class="error-message">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <form
            action=""
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
                    value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
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
                    value="<?= htmlspecialchars($_POST['slug'] ?? '') ?>"
                    placeholder="example-program"
                    required
                >

                <span class="help-text">
                    Use lowercase letters and hyphens.
                    Example: english-courses
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
                    value="<?= htmlspecialchars($_POST['subtitle'] ?? '') ?>"
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
                ><?= htmlspecialchars($_POST['short_description'] ?? '') ?></textarea>

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
                    value="<?= htmlspecialchars($_POST['duration'] ?? '') ?>"
                    placeholder="8-12 weeks"
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
                    value="<?= htmlspecialchars($_POST['fee'] ?? '') ?>"
                    placeholder="BDT 60,000"
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
                    value="<?= htmlspecialchars($_POST['mode'] ?? '') ?>"
                    placeholder="Online / In-person"
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
                ><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

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
                    value="<?= htmlspecialchars($_POST['image'] ?? '') ?>"
                    placeholder="assets/images/example.jpg"
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
                        <?= (($_POST['status'] ?? '1') === '1') ? 'selected' : '' ?>
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        <?= (($_POST['status'] ?? '') === '0') ? 'selected' : '' ?>
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
                    Save Program
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