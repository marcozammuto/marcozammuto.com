<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h2, p {
            color: #333;
            margin-bottom: 20px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #4285f4;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //db data
    $host = "127.0.0.1:3306";
    $user = "u709623640_Marco_Zammuto";
    $password = "!Francescodipaola28";
    $database = "u709623640_Database1";
    
    //db connection
    $connection = new mysqli($host, $user, $password, $database);
    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
        }

    //form datas
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $email = $_POST["email"];
    $field = $_POST["mailing-list-field"];

    // personalized message for the subscription page
    $personalized_message = ($field === '0') ? 
    "coding journey, my progress, and the technologies I'm exploring. I also maintain a blog where I document these experiences." : 
    "musical journey, releases, and the genres I'm diving into. I maintain a blog where I share insights weekly.";
    $mailing_list = ($field === '0') ?  'my coding mailing list' : (($field === '1') ? 'my music mailing list' : 'both my mailing lists');
    
    // checking if the email is already registered
    $stmt_check = $connection->prepare("SELECT * FROM newsletter_users WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    $stmt_insert = $connection->prepare("INSERT INTO newsletter_users (first_name, last_name, email, field) VALUES (?, ?, ?, ?)");
    $stmt_insert->bind_param("sssi", $first_name, $last_name, $email, $field);
    $stmt_insert->execute();
    echo "Subscription completed!";
    } else {
        echo "<h2>Welcome $first_name!</h2>
        <p>You are already subscribed to my website with the following email: $email</p>
        <p>You are currently subscribed to $mailing_list, thank you for that! </p>
        <p>How can I help you?</p>
<form action='/index.html'>
    <legend>Send me mails about:</legend>
    <label><input type='radio' name='mailing-list-field' value='0'>Coding</label>
    <label><input type='radio' name='mailing-list-field' value='1'>Music</label>
    <label><input type='radio' name='mailing-list-field' value='2'>Both</label>
    <input type='submit' value='Update Subscription'>
</form>
        <a href='index.html' class='back-link'>Back to Homepage</a>";
        die();
    }
    }
    ?>
    <div class="container">
        <h2>Welcome <?php echo $first_name; ?>, thank you for subscribing!</h2>
        <p>Your subscription from <?php echo $email; ?> has been recorded.</p>
        <p>I'll contact you only when necessary. Excited to share with you my <?php echo $personalized_message; ?></p>
        <a href="index.html" class="back-link">Back to Homepage</a>
    </div>
</body>
</html>