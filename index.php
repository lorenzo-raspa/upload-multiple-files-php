<?php
session_start();
$messages = $_SESSION["messages"];
unset($_SESSION["messages"]);

include "./functions.php";
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload multiple files</title>
    </head>

    <body>

        <div class="messages-box">
            <?php foreach($messages as $message): ?>
                <h4><?= $message ?></h4>
            <?php endforeach; ?>
        </div>
        <!-- Form per upload files -->
        <form action="/upload.php" method="post" enctype="multipart/form-data">
            <label for="files-input">Seleziona files:</label>
            <input type="file" name="files[]" id="files-input" multiple required>
            <input type="submit" value="Upload">
        </form>
        
    </body>

</html>