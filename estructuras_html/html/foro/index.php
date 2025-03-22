<?php
$pdo = include_once 'db/conexion.php';
$query = "SELECT * FROM hilos ORDER BY created_at DESC";
$stmt = $pdo->query($query);
$threads = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="forum">
        <?php foreach ($threads as $thread) { ?>
            <div class="forum__thread">
                <h2><?php echo htmlspecialchars($thread['title']); ?></h2>
            </div>
        <?php } ?>
    </div>
</body>
</html>
