<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $feedback = $_POST['feedback'];

    // Here you can insert the feedback into a database, or send an email, etc.
    // For now, we just display a message.
    
    echo "Thank you for your feedback, $name!";
}
?>
