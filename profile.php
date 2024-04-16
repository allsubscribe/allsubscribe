<?php
session_start();
include 'config.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information from the database
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
} else {
    // If user is not found, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>User Profile</h2>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
        </div>
        <div class="profile-links">
            <a href="view.php">View Notes</a>
            <a href="create_note.php">Create New Note</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>