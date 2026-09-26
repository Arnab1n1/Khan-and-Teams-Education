<?php

require_once __DIR__ . '/../config/database.php';


// =====================================================
// UPDATE MESSAGE STATUS
// =====================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $message_id = (int) ($_POST['message_id'] ?? 0);
    $status = $_POST['status'] ?? '';

    $allowed_statuses = [
        'new',
        'read',
        'replied',
        'closed'
    ];

    if (
        $message_id > 0 &&
        in_array($status, $allowed_statuses, true)
    ) {

        $stmt = $pdo->prepare("
            UPDATE contact_messages
            SET status = :status
            WHERE id = :id
        ");

        $stmt->execute([
            ':status' => $status,
            ':id' => $message_id
        ]);

        header('Location: messages.php?updated=1');
        exit;
    }
}


// =====================================================
// GET CONTACT MESSAGES
// =====================================================

$stmt = $pdo->query("
    SELECT *
    FROM contact_messages
    ORDER BY id DESC
");

$messages = $stmt->fetchAll();

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
        Contact Messages | Khan &amp; Teams Education
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

        .message-text {
            max-width: 320px;
            line-height: 1.5;
            white-space: normal;
        }

        .destination {
            color: #546e7a;
        }

        .ppp-yes {
            color: #2e7d32;
            font-weight: 600;
        }

        .ppp-no {
            color: #78909c;
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

    </style>

</head>


<body>

<div class="admin-container">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="page-header">

        <div>

            <h1>
                Contact Messages
            </h1>

            <p>
                View and manage messages submitted from the website.
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

            Message status updated successfully.

        </div>

    <?php endif; ?>


    <!-- =====================================================
         MESSAGE TABLE
    ====================================================== -->

    <div class="table-card">

        <?php if (count($messages) > 0): ?>

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
                                Destination
                            </th>

                            <th>
                                Message
                            </th>

                            <th>
                                PPP Interest
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

                        <?php foreach ($messages as $message): ?>

                            <tr>


                                <!-- ID -->

                                <td>
                                    <?= (int) $message['id'] ?>
                                </td>


                                <!-- Name -->

                                <td class="name">

                                    <?= htmlspecialchars(
                                        $message['full_name']
                                    ) ?>

                                </td>


                                <!-- Email -->

                                <td class="email">

                                    <?= htmlspecialchars(
                                        $message['email']
                                    ) ?>

                                </td>


                                <!-- Phone -->

                                <td>

                                    <?= htmlspecialchars(
                                        $message['phone']
                                    ) ?>

                                </td>


                                <!-- Destination -->

                                <td class="destination">

                                    <?= htmlspecialchars(
                                        $message['destination'] ?: '-'
                                    ) ?>

                                </td>


                                <!-- Message -->

                                <td class="message-text">

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $message['message'] ?: '-'
                                        )
                                    ) ?>

                                </td>


                                <!-- PPP Interest -->

                                <td>

                                    <?php if ((int) $message['ppp_interest'] === 1): ?>

                                        <span class="ppp-yes">
                                            Yes
                                        </span>

                                    <?php else: ?>

                                        <span class="ppp-no">
                                            No
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- Status -->

                                <td>

                                    <form
                                        action="messages.php"
                                        method="post"
                                        class="status-form"
                                    >

                                        <input
                                            type="hidden"
                                            name="message_id"
                                            value="<?= (int) $message['id'] ?>"
                                        >


                                        <select
                                            name="status"
                                        >

                                            <option
                                                value="new"
                                                <?= $message['status'] === 'new' ? 'selected' : '' ?>
                                            >
                                                New
                                            </option>

                                            <option
                                                value="read"
                                                <?= $message['status'] === 'read' ? 'selected' : '' ?>
                                            >
                                                Read
                                            </option>

                                            <option
                                                value="replied"
                                                <?= $message['status'] === 'replied' ? 'selected' : '' ?>
                                            >
                                                Replied
                                            </option>

                                            <option
                                                value="closed"
                                                <?= $message['status'] === 'closed' ? 'selected' : '' ?>
                                            >
                                                Closed
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
                                        $message['created_at']
                                    ) ?>

                                </td>


                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty-state">

                No contact messages have been submitted yet.

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