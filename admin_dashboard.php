<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Fetch all users
$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, Admin!</h1>
        <a href="logout.php">Logout</a>

        <h2>All Users</h2>
        <ul>
            <?php foreach ($users as $user): ?>
                <li>
                    <?php echo $user['username']; ?> (<?php echo $user['role']; ?>)
                    <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>