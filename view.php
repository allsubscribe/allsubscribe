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

// Handle note deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the note from the database
    $sql = "DELETE FROM notes WHERE id = '$delete_id' AND user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Note deleted successfully";
    } else {
        echo "Error deleting note: " . $conn->error;
    }
}

// Fetch notes for the logged-in user from the database
$sql = "SELECT * FROM notes WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Notes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .create-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .create-button:hover {
            background-color: #45a049;
        }

        .notes-container {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
            margin-bottom: 20px;
            width: 100%;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>My Notes</h2>
            <a href="#" class="create-button" onclick="openCreateNoteModal(); return false;">Create New Note</a>
        </div>
        <div class="notes-container">
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='note'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['content'] . "</p>";
                    echo "<p class='timestamp'>Created at: " . $row['created_at'] . "</p>";
                    echo "<div class='actions'>";
                    echo "<a href='edit_note.php?id=" . $row['id'] . "'>Edit</a>";
                    echo "<a href='view.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this note?\")'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No notes found.</p>";
            } ?>
        </div>
    </div>

    <div class="footer">
        &copy; 2023 Note Taking App. All rights reserved.
    </div>

    <!-- Create Note Modal -->
    <div id="createNoteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCreateNoteModal()">&times;</span>
            <h3>Create New Note</h3>
            <form id="createNoteForm">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="content">Content:</label>
                <textarea name="content" id="content" required></textarea>

                <input type="button" value="Create" onclick="createNote()">
            </form>
        </div>
    </div>

    <script>
        function openCreateNoteModal() {
            document.getElementById("createNoteModal").style.display = "block";
        }

        function closeCreateNoteModal() {
            document.getElementById("createNoteModal").style.display = "none";
        }

        function createNote() {
            var title = document.getElementById("title").value;
            var content = document.getElementById("content").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Note created successfully
                        closeCreateNoteModal();
                        location.reload(); // Reload the page to display the latest notes
                    } else {
                        // Error occurred while creating the note
                        alert("Error creating note. Please try again.");
                    }
                }
            };

            xhr.open("POST", "create_note.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("title=" + encodeURIComponent(title) + "&content=" + encodeURIComponent(content));
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("createNoteModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
</body>
</html>