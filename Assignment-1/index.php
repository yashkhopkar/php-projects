<?php

//create log files to store errors
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');


error_reporting(E_ALL);
// ini_set('display_errors', 1);

//Added this undefined variable to check if error logging works
echo $undefined_variable;

//form to get name, email, and telephone number

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assignment 1</title>
  </head>
  <body>
    <form action="process.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" /><br /><br />
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" /><br /><br />
      <label for="phone">Phone:</label>
      <input type="tel" id="phone" name="phone" /><br /><br />
      <input type="submit" value="Submit" />
    </form>
  </body>
</html>
