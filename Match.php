
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
<a href="/start.php"><img src="bet123logo.png"></a>
<div>
<h2>Search for a Match by Match ID:</h2>
<table>
<tbody>
<tr>
<td>Match Id:</td>
<form method="post">
<td><input id="Matchid" name="Matchid" type="number" /></td>
</tr>
</tbody>
</table>
<input type="submit" value="Submit" name="Submit1" />
</form></div>
<div>
<h2>Search for a Match by home Team ID:</h2>
<table>
<tbody>
<tr>
<td>Team Id:</td>
<form method="post">
<td><input id="Teamid" name="Teamid" type="number"  /></td>
</tr>
</tbody>
</table>
<input type="submit" value="Submit" name="Submit2" />
</form></div>
<div>
<h2>Search for a Match by Date:</h2>
<table>
<tbody>
<tr>
<td>Date:</td>
<form method="post">
<td><input id="Date" name="Date" type="date"  /></td>
</tr>
</tbody>
</table>
<input type="submit" value="Submit" name="Submit3" />
</form></div>
<table style="padding:24px" border="1">
                    <tr>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">MatchID</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Country</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">League</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Date</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Home-Team name</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Away-Team name</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365H</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365D</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">B365A</span></td>
                            </tr>

                    <?php
                        if(isset($_POST['Submit1'])) {
		   
                    $sql = 'SELECT matches.match_api_id,Country.name as countryname,league.name as leaguename,matches.date,HT.team_long_name AS  home_team,AT.team_long_name AS away_team,Betting_Odds.B365H,Betting_Odds.B365D,Betting_Odds.B365A
                                FROM matches JOIN Country on Country.id = matches.country_id
                                JOIN league on league.id = matches.league_id
                                LEFT JOIN Team AS HT on HT.team_api_id = matches.home_team_api_id
                                LEFT JOIN Team AS AT on AT.team_api_id = matches.away_team_api_id
                               JOIN Betting_Odds on Betting_Odds.match_api_id = matches.match_api_id
                                WHERE matches.match_api_id = "' . $_POST["Matchid"] . '"';
	            $q = $pdo->query($sql);
		    $q->setFetchMode(PDO::FETCH_ASSOC);
		    $row = $q->fetch();
                                         if($row==NULL)
                                                   {echo "No relevant Data found! "; }
		      
                        while ($row): ?>
                            <tr>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['match_api_id']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['countryname']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['leaguename']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['date']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['home_team']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['away_team']) ?></span></td>
                             <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365H']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365D']) ?></span></td>
                             <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365A']) ?></span></td>

                            </tr>
                                                       <?php    $row = $q->fetch();?>
           
                        <?php endwhile;}
                                           
                   if(isset($_POST['Submit2'])) {
		   
                    $sql = 'SELECT matches.match_api_id,Country.name as countryname,league.name as leaguename,matches.date,HT.team_long_name AS  home_team,AT.team_long_name AS away_team,Betting_Odds.B365H,Betting_Odds.B365D,Betting_Odds.B365A
                                FROM matches JOIN Country on Country.id = matches.country_id
                                JOIN league on league.id = matches.league_id
                                LEFT JOIN Team AS HT on HT.team_api_id = matches.home_team_api_id
                                LEFT JOIN Team AS AT on AT.team_api_id = matches.away_team_api_id
                               JOIN Betting_Odds on Betting_Odds.match_api_id = matches.match_api_id
                                WHERE matches.home_team_api_id = "' . $_POST["Teamid"] . '"';
	            $q = $pdo->query($sql);
		    $q->setFetchMode(PDO::FETCH_ASSOC);
		     $row = $q->fetch();
                                         if($row==NULL)
                                                   {echo "No relevant Data found! "; }
		      
                        while ($row): ?>
                            <tr>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['match_api_id']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['countryname']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['leaguename']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['date']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['home_team']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['away_team']) ?></span></td>
                             <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365H']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365D']) ?></span></td>
                             <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365A']) ?></span></td>

                            </tr>
                                                       <?php    $row = $q->fetch();?>
           
                        <?php endwhile;}
                                        if(isset($_POST['Submit3'])) {
		   
                    $sql = 'SELECT matches.match_api_id,Country.name as countryname,league.name as leaguename,matches.date,HT.team_long_name AS  home_team,AT.team_long_name AS away_team,Betting_Odds.B365H,Betting_Odds.B365D,Betting_Odds.B365A
                                FROM matches JOIN Country on Country.id = matches.country_id
                                JOIN league on league.id = matches.league_id
                                LEFT JOIN Team AS HT on HT.team_api_id = matches.home_team_api_id
                                LEFT JOIN Team AS AT on AT.team_api_id = matches.away_team_api_id
                               JOIN Betting_Odds on Betting_Odds.match_api_id = matches.match_api_id
                                WHERE matches.date = "' . $_POST["Date"] . '"';
	            $q = $pdo->query($sql);
		    $q->setFetchMode(PDO::FETCH_ASSOC);
		    $row = $q->fetch();
                                         if($row==NULL)
                                                   {echo "No relevant Data found! "; }
		      
                        while ($row): ?>
                            <tr>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['match_api_id']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['countryname']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['leaguename']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['date']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['home_team']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['away_team']) ?></span></td>
                             <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365H']) ?></span></td>
                            <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365D']) ?></span></td>
                             <td><span style="font-family:Roboto;padding:20px"><?php echo htmlspecialchars($row['B365A']) ?></span></td>

                            </tr>
                                                       <?php    $row = $q->fetch();?>
           
                        <?php endwhile;}


                    ?>
                </table>
</center>

</body>
</html>