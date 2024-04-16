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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Insert note into the database
    $sql = "INSERT INTO notes (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user_id, $title, $content);

    if ($stmt->execute()) {
        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}

// Fetch notes for the logged-in user from the database
$sql = "SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Note</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .form-container, .notes-container {
            width: 500px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .notes-container {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create Note</h2>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="title">Title:</label>
                <input type="text" name="title" required>
                <label for="content">Content:</label>
                <textarea name="content" rows="5" required></textarea>
                <input type="submit" value="Create">
            </form>
        </div>
        <div class="notes-container">
            <h2>My Notes</h2>
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="note">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['content']); ?></p>
                        <p class="timestamp">Created at: <?php echo $row['created_at']; ?></p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>No notes found.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>