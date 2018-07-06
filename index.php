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
          /**
           * Takes a string of emails separated by whitespace to initiate
           * Parses the emails and stores them as an array in an instance variable
           * Gets the domains of parsed emails and stores unique values
           * as an array in an instance variable
           */
          class EmailParser
          {
              private $domains = [];
              private $emails = [];

              public function __construct($unparsedEmails)
              {
                  $this->setEmails(preg_split("/\r\n|\n\r|\s/", $unparsedEmails));

                  foreach ($this->getEmails() as $key => $value) {
                      $this->addDomain($value);
                  }
              }

              // Validates dates an email domain an add it
              // to the array of domain if not found
              public function addDomain($email)
              {
                  if (strpos($email, "@")) {
                      $domain = end(explode("@", $email));
                      if (!in_array($domain, $this->getDomains())) {
                          $this->setDomains($domain);
                      }
                  }
              }

              // Takes and array of domains as an argument
              // Displays the list of domains inside a table
              public function showTable()
              {
                  echo "<table>
                <tr>
                  <th>Number</th>
                  <th>Domain</th>
                </tr>";

                  foreach ($this->getDomains() as $key => $value) {
                      echo "<tr>";
                      echo "<td>" . ($key + 1) . "</td>";
                      echo "<td>" . $value . "</td>";
                      echo "</tr>";
                  }
                  echo "</table>";
              }



              private function setDomains($domain)
              {
                  array_push($this->domains, $domain);
              }

              public function getDomains()
              {
                  return $this->domains;
              }

              private function setEmails($arr)
              {
                  $this->emails = $arr;
              }

              public function getEmails()
              {
                  return $this->emails;
              }
          }

          $parser = new EmailParser($_POST["emails"]);
          $parser->showTable();
      }
     ?>
  </body>
</html>
