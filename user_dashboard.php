<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Fetch friends
$stmt = $conn->prepare("SELECT * FROM friends WHERE user_id = :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="add_friend.php">Add Friend</a>
        <a href="logout.php">Logout</a>

        <h2>Your Friends</h2>
        <ul>
            <?php foreach ($friends as $friend): ?>
                <li><?php echo $friend['name']; ?> - <?php echo $friend['birthday']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>