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
        <center>
            <!-- Here, href is used to navigate to the start page when the logo image is clicked -->
            <a href="/start.php"><img src="bet123logo.png"></a>
            <div>
                <h2><span style="font-size:x-large;font-family:Roboto">Search For Teams in a League:</span></h2>
                <form method="post" style="padding:30px">
                    <input type="text" name="match" id="match" />
                    <input type="submit" value="Search" name="SearchMatch" />
                </form>
                <h2><span style="font-size:x-large;font-family:Roboto">Display Team Attributes:</span></h2>
                <form method="post" style="padding:30px">
                    <input type="text" name="team" id="team" />
                    <input type="submit" value="Search" name="searchTeam" />
                </form>
                <table style="padding:24px" border="1">
                    <?php
                        if(isset($_POST['SearchMatch'])) {
                            ?><?php
                            $userinput =   $_POST['match'];                         
                            $stmt = $pdo->prepare('SELECT L.name AS league_name, M.home_team_api_id AS x, HT.team_long_name AS home_team FROM matches M LEFT JOIN league L on L.id = M.League_id LEFT JOIN Team AS HT on HT.team_api_id = M.home_team_api_id LEFT JOIN Team AS AT on AT.team_api_id = M.away_team_api_id WHERE L.name = "' . $_POST["match"] . '" GROUP BY M.home_team_api_id, HT.team_long_name;');
                            $stmt->bindParam(':user_input', $userinput);
                            $stmt->execute();


                            ?>
                            <tr>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">League Name</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Team API ID</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Team Name</span></td>
                            
                            </tr>
                            <?php while ($row = $stmt->fetch()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['league_name']) ?></td>
                            <td><?php echo htmlspecialchars($row['x']); ?></td>
                            <td><?php echo htmlspecialchars($row['home_team']); ?></td>
                            
                        </tr>
                        
                    <?php endwhile; ?> <?php }?>
                    <?php
                        if(isset($_POST['searchTeam'])) {
                            ?><?php                        
                            $stmt2 = $pdo->prepare('SELECT T.team_api_id, T.team_long_name, T.team_short_name, A.buildUpPlaySpeedClass, A.buildUpPlayDribblingClass, A.buildUpPlayPassingClass, A.buildUpPlayPositioningClass, A.chanceCreationPassingClass, A.chanceCreationCrossingClass, A.chanceCreationShootingClass, A.chanceCreationPositioningClass, A.defencePressureClass, A.defenceAggressionClass, A.defenceTeamWidthClass, A.defenceDefenderLineClass FROM Team_attributes A, Team T WHERE T.team_api_id = A.team_api_id AND team_long_name = "' . $_POST["team"] . '";');
                            $stmt2->execute();
                            ?>
                            <tr>
                            <td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:10px">Team API Id</span></td>
                            <td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:10px">Team Long Name</span></td>
                            <td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:10px">Team Short Name</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">BuildUpPlaySpeedClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">BuildUpPlayDribblingClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">BuildUpPlayPassingClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">BuildUpPlayPositioningClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">ChanceCreationPassingClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">ChanceCreationCrossingClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">ChanceCreationShootingClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">ChanceCreationPositioningClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">DefencePressureClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">DefenceAggressionClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">DefenceTeamWidthClass</span></td>
                            <td><span style="font-size:medium;font-weight:bold;font-family:Roboto;padding:10px">DefenceDefenderLineClass</span></td>
                            
                            
                            </tr>
                            <?php while ($row2 = $stmt2->fetch()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row2['team_api_id']) ?></td>
                            <td><?php echo htmlspecialchars($row2['team_long_name']); ?></td>
                            <td><?php echo htmlspecialchars($row2['team_short_name']); ?></td>
                            <td><?php echo htmlspecialchars($row2['buildUpPlaySpeedClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['buildUpPlayDribblingClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['buildUpPlayPassingClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['buildUpPlayPositioningClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['chanceCreationPassingClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['chanceCreationCrossingClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['chanceCreationShootingClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['chanceCreationPositioningClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['defencePressureClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['defenceAggressionClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['defenceTeamWidthClass']); ?></td>
                            <td><?php echo htmlspecialchars($row2['defenceDefenderLineClass']); ?></td>
                            
                        </tr>   
                    <?php endwhile; ?> <?php }?></table>
            </div>
        </center>

    </body>
</html>