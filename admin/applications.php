<?php

require_once __DIR__ . '/../config/database.php';


// =====================================================
// UPDATE APPLICATION STATUS
// =====================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $application_id = (int) ($_POST['application_id'] ?? 0);
    $status = $_POST['status'] ?? '';

    $allowed_statuses = [
        'new',
        'reviewed',
        'contacted',
        'completed',
        'cancelled'
    ];

    if (
        $application_id > 0 &&
        in_array($status, $allowed_statuses, true)
    ) {

        $stmt = $pdo->prepare("
            UPDATE applications
            SET status = :status
            WHERE id = :id
        ");

        $stmt->execute([
            ':status' => $status,
            ':id' => $application_id
        ]);

        header('Location: applications.php?updated=1');
        exit;
    }
}


// =====================================================
// GET APPLICATIONS
// =====================================================

$stmt = $pdo->query("
    SELECT
        a.*,
        p.title AS program_title
    FROM applications a
    LEFT JOIN programs p
        ON a.program_id = p.id
    ORDER BY a.id DESC
");

$applications = $stmt->fetchAll();


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

    <title>
        Applications | Khan &amp; Teams Education
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .page-header h1 {
            margin: 0 0 7px;
            font-size: 30px;
        }

        .page-header p {
            margin: 0;
            color: #607d8b;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 16px;
            background: #eceff1;
            color: #37474f;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        .back-btn:hover {
            background: #dde3e6;
        }

        .message {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 7px;
            background: #e8f7ee;
            color: #176b3a;
            border: 1px solid #b7e4c7;
        }

        .table-card {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1200px;
            border-collapse: collapse;
        }

        thead {
            background: #4a5b68;
            color: #ffffff;
        }

        th,
        td {
            padding: 14px 15px;
            text-align: left;
            border-bottom: 1px solid #e8ecef;
            vertical-align: top;
            font-size: 14px;
        }

        th {
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8fafb;
        }

        .name {
            font-weight: 600;
        }

        .email {
            color: #455a64;
        }

        .address {
            max-width: 220px;
            white-space: normal;
            line-height: 1.5;
        }

        .program {
            color: #546e7a;
        }

        .status-form {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .status-form select {
            padding: 8px 9px;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            font-size: 13px;
            background: #ffffff;
        }

        .update-btn {
            border: none;
            padding: 8px 11px;
            border-radius: 6px;
            background: #4a5b68;
            color: #ffffff;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }

        .update-btn:hover {
            background: #37474f;
        }

        .status-new {
            color: #1565c0;
        }

        .status-reviewed {
            color: #6a1b9a;
        }

        .status-contacted {
            color: #ef6c00;
        }

        .status-completed {
            color: #2e7d32;
        }

        .status-cancelled {
            color: #c62828;
        }

        .empty-state {
            padding: 50px;
            text-align: center;
            color: #78909c;
        }

        .bottom-link {
            display: inline-block;
            margin-top: 20px;
            color: #4a5b68;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 700px) {

            body {
                padding: 20px;
            }

            .page-header h1 {
                font-size: 25px;
            }

        }

    </style>

</head>


<body>

<div class="admin-container">


    <!-- =====================================================
         PAGE HEADER
    ====================================================== -->

    <div class="page-header">

        <div>

            <h1>
                Applications
            </h1>

            <p>
                View and manage submitted applications.
            </p>

        </div>


        <a
            href="index.php"
            class="back-btn"
        >
            ← Dashboard
        </a>

    </div>


    <!-- =====================================================
         SUCCESS MESSAGE
    ====================================================== -->

    <?php if ($updated): ?>

        <div class="message">
            Application status updated successfully.
        </div>

    <?php endif; ?>


    <!-- =====================================================
         APPLICATION TABLE
    ====================================================== -->

    <div class="table-card">

        <?php if (count($applications) > 0): ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Address
                            </th>

                            <th>
                                Program
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Submitted
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($applications as $application): ?>

                            <tr>


                                <!-- ID -->

                                <td>
                                    <?= (int) $application['id'] ?>
                                </td>


                                <!-- Name -->

                                <td class="name">

                                    <?= htmlspecialchars(
                                        $application['full_name']
                                    ) ?>

                                </td>


                                <!-- Email -->

                                <td class="email">

                                    <?= htmlspecialchars(
                                        $application['email']
                                    ) ?>

                                </td>


                                <!-- Phone -->

                                <td>

                                    <?= htmlspecialchars(
                                        $application['phone']
                                    ) ?>

                                </td>


                                <!-- Address -->

                                <td class="address">

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $application['address']
                                        )
                                    ) ?>

                                </td>


                                <!-- Program -->

                                <td class="program">

                                    <?= htmlspecialchars(
                                        $application['program_title'] ?? 'General Application'
                                    ) ?>

                                </td>


                                <!-- Status -->

                                <td>

                                    <form
                                        action="applications.php"
                                        method="post"
                                        class="status-form"
                                    >

                                        <input
                                            type="hidden"
                                            name="application_id"
                                            value="<?= (int) $application['id'] ?>"
                                        >


                                        <select
                                            name="status"
                                        >

                                            <option
                                                value="new"
                                                <?= $application['status'] === 'new' ? 'selected' : '' ?>
                                            >
                                                New
                                            </option>

                                            <option
                                                value="reviewed"
                                                <?= $application['status'] === 'reviewed' ? 'selected' : '' ?>
                                            >
                                                Reviewed
                                            </option>

                                            <option
                                                value="contacted"
                                                <?= $application['status'] === 'contacted' ? 'selected' : '' ?>
                                            >
                                                Contacted
                                            </option>

                                            <option
                                                value="completed"
                                                <?= $application['status'] === 'completed' ? 'selected' : '' ?>
                                            >
                                                Completed
                                            </option>

                                            <option
                                                value="cancelled"
                                                <?= $application['status'] === 'cancelled' ? 'selected' : '' ?>
                                            >
                                                Cancelled
                                            </option>

                                        </select>


                                        <button
                                            type="submit"
                                            class="update-btn"
                                        >
                                            Update
                                        </button>

                                    </form>

                                </td>


                                <!-- Date -->

                                <td>

                                    <?= htmlspecialchars(
                                        $application['created_at']
                                    ) ?>

                                </td>


                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty-state">

                No applications have been submitted yet.

            </div>

        <?php endif; ?>

    </div>


    <a
        href="../index.php"
        class="bottom-link"
    >
        ← Back to Website
    </a>


</div>

</body>

</html>