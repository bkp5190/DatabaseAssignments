
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
    $sql = 'SELECT matches.match_api_id  as id, HT.team_long_name AS  home_team,AT.team_long_name AS away_team,matches.date AS date,matches.betamountforhome AS homeamount,matches.betamountforaway AS awayamount FROM matches    
                               LEFT JOIN Team AS HT on HT.team_api_id = matches.home_team_api_id
                               LEFT JOIN Team AS AT on AT.team_api_id = matches.away_team_api_id
                               order by matches.date DESC ,matches.match_api_id  DESC Limit 10';    
        $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<body style="background-color:#404040;color:white">
<center>
<a href="/start.php"><img src="bet123logo.png"></a>
<div>
<h2>Place Your Bets!<br><br><br></h2>
<br><br><br></h2>
<h2>Latest 10 matches in table<br><br></h2>
<table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Match ID</th>
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Match Date</th>
                                                <th>Home_ bet_amount</th>
                                               <th>Away_bet_amount</th>

                        <th>Bet on Home Team?</th>
                        <th>Bet on Away Team?</th>
                    </tr>
                </thead><tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                                                        
                            <td><?php echo htmlspecialchars($row['id']) ?></td>
                            <td><?php echo htmlspecialchars($row['home_team']) ?></td>
                            <td><?php echo htmlspecialchars($row['away_team']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['homeamount']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['awayamount']); ?></td>

                            <td><center><?php echo '<form action ="/update.php" method="post"><input type="submit" id="submit1" value="Bet!"><input type="hidden" name="mid" value="' . htmlspecialchars($row['id']) . '"><input type="hidden" name="bettype" value="betamountforhome"><input type="number" id="wager" name="wager" value=""></form>'; ?></center></td>
                            <td><center><?php echo '<form action ="/update.php" method="post"><input type="submit" id="submit2" value="Bet!" ><input type="hidden" name="mid" value="' . htmlspecialchars($row['id']) . '"><input type="hidden" name="bettype" value="betamountforaway"><input type="number" id="wager" name="wager" value=""></form>'; ?></center></td>
                                                        <td><center><?php echo '<form action ="/reset.php" method="post"><input type="submit" value="Reset" ><input type="hidden" name="mid" value="' . htmlspecialchars($row['id']) . '"></form>'; ?></center></td>
                                                             </tr>
                    <?php endwhile; ?>
                </tbody></table></div>
    </center>

</body>
</html>