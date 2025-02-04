<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header('Location: index.php');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];

    $stmt = $conn->prepare("INSERT INTO friends (user_id, name, birthday) VALUES (:user_id, :name, :birthday)");
    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
        'name' => $name,
        'birthday' => $birthday
    ]);

    header('Location: user_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Friend</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Friend</h1>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required>
            <button type="submit">Add Friend</button>
        </form>
        <a href="user_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>