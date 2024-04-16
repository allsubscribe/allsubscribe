<?php
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Username already exists. Please choose a different username.";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>User Registration</h2>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>