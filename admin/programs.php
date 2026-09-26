<?php

require_once __DIR__ . '/../config/database.php';


// =====================================================
// GET ALL PROGRAMS
// =====================================================

$stmt = $pdo->query("
    SELECT *
    FROM programs
    ORDER BY id ASC
");

$programs = $stmt->fetchAll();


// =====================================================
// DELETE MESSAGE
// =====================================================

$deleted = isset($_GET['deleted']) && $_GET['deleted'] === '1';
$added   = isset($_GET['added']) && $_GET['added'] === '1';
$updated = isset($_GET['updated']) && $_GET['updated'] === '1';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Manage Programs | Khan & Teams Education</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #263238;
        }

        .admin-container {
            max-width: 1250px;
            margin: 0 auto;
        }

        .admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 30px;
        }

        .admin-header p {
            margin: 6px 0 0;
            color: #607d8b;
        }

        .add-btn {
            display: inline-block;
            padding: 12px 20px;
            background: #4a5b68;
            color: #ffffff;
            text-decoration: none;
            border-radius: 7px;
            font-weight: 600;
        }

        .add-btn:hover {
            background: #37474f;
        }

        .message {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 7px;
            font-size: 14px;
        }

        .success {
            background: #e8f7ee;
            color: #176b3a;
            border: 1px solid #b7e4c7;
        }

        .table-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        thead {
            background: #4a5b68;
            color: #ffffff;
        }

        th,
        td {
            padding: 15px 16px;
            text-align: left;
            border-bottom: 1px solid #e8ecef;
            vertical-align: middle;
        }

        th {
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafb;
        }

        .id-column {
            width: 60px;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #e8f7ee;
            color: #176b3a;
        }

        .status-inactive {
            background: #f8d7da;
            color: #842029;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .edit-btn {
            background: #e8f0f7;
            color: #345a73;
        }

        .delete-btn {
            background: #fbe9ea;
            color: #a52834;
        }

        .edit-btn:hover {
            background: #dce8f1;
        }

        .delete-btn:hover {
            background: #f5d5d8;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #78909c;
        }

        .top-link {
            margin-top: 20px;
            display: inline-block;
            color: #4a5b68;
            text-decoration: none;
            font-weight: 600;
        }

    </style>

</head>


<body>

<div class="admin-container">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="admin-header">

        <div>

            <h1>
                Manage Programs
            </h1>

            <p>
                Add, update and delete program details.
            </p>

        </div>


        <a
            href="add-program.php"
            class="add-btn"
        >
            + Add New Program
        </a>

    </div>


    <!-- =====================================================
         SUCCESS MESSAGES
    ====================================================== -->

    <?php if ($added): ?>

        <div class="message success">
            Program added successfully.
        </div>

    <?php endif; ?>


    <?php if ($updated): ?>

        <div class="message success">
            Program updated successfully.
        </div>

    <?php endif; ?>


    <?php if ($deleted): ?>

        <div class="message success">
            Program deleted successfully.
        </div>

    <?php endif; ?>


    <!-- =====================================================
         PROGRAM TABLE
    ====================================================== -->

    <div class="table-card">

        <?php if (count($programs) > 0): ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th class="id-column">
                                ID
                            </th>

                            <th>
                                Title
                            </th>

                            <th>
                                Slug
                            </th>

                            <th>
                                Mode
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Created
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($programs as $program): ?>

                            <tr>

                                <td>
                                    <?= (int) $program['id'] ?>
                                </td>


                                <td>
                                    <strong>
                                        <?= htmlspecialchars($program['title']) ?>
                                    </strong>
                                </td>


                                <td>
                                    <?= htmlspecialchars($program['slug']) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($program['mode'] ?? '-') ?>
                                </td>


                                <td>

                                    <?php if ((int) $program['status'] === 1): ?>

                                        <span class="status status-active">
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span class="status status-inactive">
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <td>
                                    <?= htmlspecialchars($program['created_at']) ?>
                                </td>


                                <td>

                                    <div class="action-buttons">

                                        <a
                                            href="edit-program.php?id=<?= (int) $program['id'] ?>"
                                            class="btn edit-btn"
                                        >
                                            Edit
                                        </a>


                                        <a
                                            href="delete-program.php?id=<?= (int) $program['id'] ?>"
                                            class="btn delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this program?');"
                                        >
                                            Delete
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty-state">

                No programs found in the database.

            </div>

        <?php endif; ?>

    </div>


    <!-- =====================================================
         BACK TO WEBSITE
    ====================================================== -->

    <a
        href="../index.php"
        class="top-link"
    >
        ← Back to Website
    </a>


</div>

</body>

</html>