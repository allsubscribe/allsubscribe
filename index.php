<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Note Taking App</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px); /* Adjust the value based on your header height */
            text-align: center;
        }

        h1 {
            font-size: 48px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Note Taking App</h1>
    </div>
</body>
</html>