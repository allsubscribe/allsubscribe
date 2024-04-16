<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User logged in successfully
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: view.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px); /* Adjust the value based on your header height */
        }

        .form-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="form-container">
            <h2>User Login</h2>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <input type="submit" value="Login">
            </form>
            <div class="register-link">
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>
</body>
</html>