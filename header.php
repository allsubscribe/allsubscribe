<?php
// Get the current page URL
$currentPage = basename($_SERVER['PHP_SELF']);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Note Taking App</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <div class="header-content">
            <nav>
                <div class="logo">
                    <!-- Add your logo or app name here -->
                    <a href="index.php" style="color: white;">Note Taking App</a>
                </div>
                <ul>
                    <?php if (!$isLoggedIn) { ?>
                    <li<?php if ($currentPage === 'login.php') echo ' class="active"'; ?>>
                        <a href="login.php">Login</a>
                    </li>
                    <li<?php if ($currentPage === 'register.php') echo ' class="active"'; ?>>
                        <a href="register.php">Register</a>
                    </li>
                    <?php } else { ?>
                    <li<?php if ($currentPage === 'profile.php' || $currentPage === 'register.php') echo ' class="active"'; ?>>
                        <a href="profile.php">Profile</a>
                    </li>
                    <li<?php if ($currentPage === 'view.php') echo ' class="active"'; ?>>
                        <a href="view.php">View Notes</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </header>