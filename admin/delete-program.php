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
// CHECK PROGRAM EXISTS
// =====================================================

$stmt = $pdo->prepare("
    SELECT id, title
    FROM programs
    WHERE id = :id
    LIMIT 1
");

$stmt->execute([
    ':id' => $id
]);

$program = $stmt->fetch();


if (!$program) {
    die('Program not found.');
}


// =====================================================
// DELETE PROGRAM
// =====================================================

try {

    $stmt = $pdo->prepare("
        DELETE FROM programs
        WHERE id = :id
    ");

    $stmt->execute([
        ':id' => $id
    ]);


    // Redirect after successful deletion

    header('Location: programs.php?deleted=1');
    exit;


} catch (PDOException $e) {

    die(
        'Unable to delete the program. '
        . 'Please make sure there are no database constraints preventing deletion.'
    );

}

?>