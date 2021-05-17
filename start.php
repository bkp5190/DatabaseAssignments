
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'pmg5303';
$password = 'g215428';
$host = 'localhost';
$dbname = 'final';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
   
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
 <body style="background-color:#404040;color:white">  
<center><a href="/start.php"><img src="bet123logo.png"<br><br><br><br>></a>
  <th>Welcome To Bet123<br><br></th>
  <th>A one-stop-shop for all your football betting needs<br><br><br><br></th>
 <th>Click on a pages to get started<br><br></th>

<tr>
<td><form action="/player.php" method="post"> <input type="submit" value="Player Info" style="height:50px; width:300px"></form><br><td>
<td><form action="/Match.php" method="post"> <input type="submit" value="Match Info" style="height:50px; width:300px"></form><br><td>
<td><form action="/League.php" method="post"> <input type="submit" value="League Info" style="height:50px; width:300px"></form><br><td>
<td><form action="/Team.php" method="post"> <input type="submit" value="Team Info" style="height:50px; width:300px"></form><br><td>
<td><form action="/Betting.php" method="post"> <input type="submit" value="Betting Odds" style="height:50px; width:300px"></form><br><td>
 <td><form action="/place.php" method="post"> <input type="submit" value="Place a bet" style="height:50px; width:300px"></form><br><td>
</tr>
</body>
</html>
