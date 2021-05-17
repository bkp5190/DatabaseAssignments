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
    <center>
    <body style="background-color:#404040;color:white">
        <table>
            <head>
                <center>
                    <a href="/start.php"><img src="bet123logo.png"></a>
                    <?php
                         $current_name = strtoupper(str_replace('%20', ' ', $_SERVER['QUERY_STRING']));

                    ?>
                    <h2><span style="font-size:x-large;font-family:Verdana;font-weight:bold"><?php echo $current_name?></span></h2>

                    <table style="padding:24px;border-collapse:collapse" border="1">
                    <tr>
                            
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Overall Rating</span></th>
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Potential</span></th>
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Preferred Foot</span></th>
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Sprint Speed</span></th>
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Acceleration</span></th>
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Agility</span></th>
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Stamina</span></th>
                            <th style="text-align:center"><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:20px">Free Kick Accuracy</span></th>
                            
                            </tr>

                    <?php
                        $stmt1 = $pdo->prepare('SELECT DISTINCT A.player_api_id FROM player P, Player_attributes A WHERE P.player_api_id=A.player_api_id AND P.player_name LIKE :user_input');
                        $stmt1->bindParam(':user_input', $current_name);
                        $stmt1->execute();
                        $result1 = $stmt1->fetch();
                        $api_id = $result1[0];

                        $stmt2 = $pdo->prepare('SELECT DISTINCT player_api_id, overall_rating, potential, preferred_foot, sprint_speed, acceleration, agility, stamina, free_kick_accuracy FROM Player_attributes WHERE player_api_id=:apid ORDER BY overall_rating DESC LIMIT 1');
                        $stmt2->bindParam(':apid', $api_id);
                        $stmt2->execute();

                        while ($row = $stmt2->fetch()): ?>
                            <tr>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['overall_rating']) ?></span></td>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['potential']) ?></span></td>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['preferred_foot']) ?></span></td>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['sprint_speed']) ?></span></td>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['acceleration']) ?></span></td>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['agility']) ?></span></td>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['stamina']) ?></span></td>
                            <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['free_kick_accuracy']) ?></span></td>
                            </tr>
                        <?php endwhile;
                    ?>
                </table>
                </center>

            </head>
        </table>
        <center><button style="color:#96e7ff;background-color:#202020;font-weight:bold;font-family:Roboto;padding:10px" onclick="history.go(-1);">Back To Search Results</button></center>
    </body>
</center>
</html>