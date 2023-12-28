<?php
use PHPMailer\PHPMailer\PHPMailer;

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'vendor/autoload.php';

    $mail = new PHPMailer;

    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($email) && !empty($name) && !empty($message)) {
        $mail->addReplyTo($email, $name);
        $mail->Subject = 'PHPMailer Contact Form';
        $mail->isHTML(false);
        $mail->Body = "Email: $email\nName: $name\nMessage: $message";

        if ($mail->send()) {
            echo '<h2>Message sent! Thanks for contacting us.<h2>';
                      header("refresh:2; url=index.html");
                      exit;
        } else {
            $msg = 'Sorry, something went wrong. Please try again later.' . $mail->ErrorInfo;
        }
    } else {
        $msg = 'Please fill in all the fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact form</title>
</head>
<body>
<h1>Contact us</h1>
    <?php if (!empty($msg)) : ?>
        <h2><?= $msg ?></h2>
    <?php endif; ?>
    <form method="POST">
        <label for="name">Name: <input type="text" name="name" id="name"></label><br>
        <label for="email">Email address: <input type="email" name="email" id="email"></label><br>
        <label for="message">Message: <textarea name="message" id="message" rows="8" cols="20"></textarea></label><br>
        <input type="submit" value="Send">
    </form>
</body>
</html>
