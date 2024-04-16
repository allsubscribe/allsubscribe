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
$note_id = $_GET['id'];

// Fetch note details from the database
$sql = "SELECT * FROM notes WHERE id = '$note_id' AND user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
} else {
    // If note is not found or doesn't belong to the user, redirect to view.php
    header("Location: view.php");
    exit();
}

// Handle note update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Update the note in the database
    $sql = "UPDATE notes SET title = '$title', content = '$content' WHERE id = '$note_id' AND user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error updating note: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Note</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Note</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $note_id; ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo $title; ?>" required>

            <label for="content">Content:</label>
            <textarea name="content" required><?php echo $content; ?></textarea>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>