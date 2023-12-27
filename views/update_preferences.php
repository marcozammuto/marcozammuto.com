<?php

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
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $email = $_POST["email"];
          $field = $_POST["field"];
          
          $stmt_update = $connection->prepare("UPDATE newsletter_users SET field = ? WHERE email = ?");
          $stmt_update->bind_param("is", $field, $email);
          $stmt_update->execute();
          
          echo "Your preferences have been updated!";

          $connection->close();

          header("refresh:2; url=index.html");
          exit;

          }


          ?>