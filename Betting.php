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
                <h2><span style="font-size:x-large;font-family:Roboto">Check Betting Odds by Match:</span></h2>
                <form method="post" style="padding:30px">
                    <input type="text" name="match" id="match" />
                    <input type="submit" value="SearchMatch" name="SearchMatch" />
                </form>
                <h2><span style="font-size:x-large;font-family:Roboto">Check Betting Odds by Team:</span></h2>
                <form method="post" style="padding:30px">
                    <input type="text" name="team" id="team" />
                    <input type="submit" value="Search" name="searchTeam" />
                </form>
                <table style="padding:24px" border="1">
                    <?php
                        if(isset($_POST['SearchMatch'])) {
                            ?><?php
                            $userinput =   $_POST['match'];                         
                            $stmt = $pdo->prepare('SELECT b.id,c.name,l.name as x,t1.team_long_name as y,t2.team_long_name as z, b.B365H,b.B365D,b.B365A,b.BWH,b.BWD,b.BWA,b.IWH,b.IWD,b.IWA FROM league l, Country c,Betting_Odds b LEFT                            JOIN Team t1 on t1.team_api_id = b.home_team_api_id LEFT JOIN Team t2 on t2.team_api_id = b.away_team_api_id WHERE b.country_id = c.id and b.league_id = l.id and b.id = :user_input;');
                            $stmt->bindParam(':user_input', $userinput);
                            $stmt->execute();


                            ?>
                            <tr>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">ID</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Country</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">League</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Home Team</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Away Team</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365H</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365D</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365A</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">BWH</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">BWD</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">BWA</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">IWH</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">IWD</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">IWA</span></td>
                            
                            
                            </tr>
                            <?php while ($row = $stmt->fetch()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']) ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['x']); ?></td>
                            <td><?php echo htmlspecialchars($row['y']); ?></td>
                            <td><?php echo htmlspecialchars($row['z']); ?></td>
                            <td><?php echo htmlspecialchars($row['B365H']); ?></td>
                            <td><?php echo htmlspecialchars($row['B365D']); ?></td>
                            <td><?php echo htmlspecialchars($row['B365A']); ?></td>
                            <td><?php echo htmlspecialchars($row['BWH']); ?></td>
                            <td><?php echo htmlspecialchars($row['BWD']); ?></td>
                            <td><?php echo htmlspecialchars($row['BWA']); ?></td>
                            <td><?php echo htmlspecialchars($row['IWH']); ?></td>
                            <td><?php echo htmlspecialchars($row['IWD']); ?></td>
                            <td><?php echo htmlspecialchars($row['IWA']); ?></td>
                            
                        </tr>
                        
                    <?php endwhile; ?> <?php }?>
                    <?php
                        if(isset($_POST['searchTeam'])) {
                            ?><?php                        
                            $stmt2 = $pdo->prepare('SELECT b.id,c.name,l.name as x,t1.team_long_name as y,t2.team_long_name as z, b.B365H,b.B365D,b.B365A,b.BWH,b.BWD,b.BWA,b.IWH,b.IWD,b.IWA FROM league l, Country c,Betting_Odds b                                LEFT JOIN Team t1 on t1.team_api_id = b.home_team_api_id LEFT JOIN Team t2 on t2.team_api_id = b.away_team_api_id WHERE b.country_id = c.id and b.league_id = l.id and (t1.team_long_name Like "' . $_POST["team"] . '" or t2.team_long_name like "' . $_POST["team"] . '" );');
                            $stmt2->execute();
                            ?>
                            <tr>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">ID</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Country</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">League</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Home Team</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Away Team</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365H</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365D</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365A</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">BWH</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">BWD</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">BWA</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">IWH</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">IWD</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">IWA</span></td>
                            
                            
                            </tr>
                            <?php while ($row2 = $stmt2->fetch()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row2['id']) ?></td>
                            <td><?php echo htmlspecialchars($row2['name']); ?></td>
                            <td><?php echo htmlspecialchars($row2['x']); ?></td>
                            <td><?php echo htmlspecialchars($row2['y']); ?></td>
                            <td><?php echo htmlspecialchars($row2['z']); ?></td>
                            <td><?php echo htmlspecialchars($row2['B365H']); ?></td>
                            <td><?php echo htmlspecialchars($row2['B365D']); ?></td>
                            <td><?php echo htmlspecialchars($row2['B365A']); ?></td>
                            <td><?php echo htmlspecialchars($row2['BWH']); ?></td>
                            <td><?php echo htmlspecialchars($row2['BWD']); ?></td>
                            <td><?php echo htmlspecialchars($row2['BWA']); ?></td>
                            <td><?php echo htmlspecialchars($row2['IWH']); ?></td>
                            <td><?php echo htmlspecialchars($row2['IWD']); ?></td>
                            <td><?php echo htmlspecialchars($row2['IWA']); ?></td>
                            
                        </tr>   
                    <?php endwhile; ?> <?php }?></table>
            </div>
        </center>

    </body>
</html>