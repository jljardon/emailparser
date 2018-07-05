<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Emails</h1>

    <h3>Please input the list of emails to be processed:</h3>
    <form class="form" action="index.php" method="post">
      <textarea name="emails" rows="8" cols="80"></textarea>
      <br>
      <input type="submit" name="submit">
    </form>
      <br>
      <hr>

    <?php
      if (isset($_POST['submit'])) {

          $emails = preg_split("/\r\n|\n\r|\s/", $_POST["emails"]);
          foreach ($emails as $key => $value) {
            echo $key . "-" .  $value;
            echo "<br>";
          }
      }
     ?>

  </body>
</html>
