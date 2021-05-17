
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
	<body style="background-color:#404040 ;color:white">
		<center>
			<img src="bet123logo.png">
			<h2>League Information </h2>
		<div class="div-left">
			<h3>Search for League by Name</h3>
		<form  method="post" style="padding:15px">
			<input text="text" name="league_name" id="league_name" title="Enter name of League here"/>
			<input type="submit" value="search" name="search"/>

		</form>	

	<?php 
	    if(isset($_POST['search']) && strlen($_POST['league_name'])>=2 ){
		?><table style="padding:15px" border ="1"><?php 
		    $userinput = "%". $_POST['league_name']. "%";
		    $stmt= $pdo->prepare('SELECT L.name as Name, C.name FROM league L, Country C WHERE L.country_id=C.id AND L.name LIKE :user_input'); 
		    $stmt->bindParam(':user_input', $userinput);
		    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
		    $stmt->execute();
	?>
	<tr>
		<td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:15px">League</span></td>
	 	<td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:15px">Country</span></td>
	</tr>
	<?php
        while ($row = $stmt->fetch()): ?>	
	 <!-- Using a php variable to store the name, which is sent to the player_description.php page to determine which player's info to show -->    
       
           <tr>
          	<td><span style="font-family:Roboto;padding:15px"><?php echo (htmlspecialchars($row['Name'])) ?></span></td>
         	 <td><span style="font-family:Roboto;padding:15px"><?php echo (htmlspecialchars($row['name'])) ?></span></td>
            </tr>
           <?php endwhile;?></table> <?php }?>

</div>
<div class ="div-right">
	
		<h3>Search for League in a country</h3>
		<form  method="post" style="padding:15px">  
			<input text="text" name="country_names" id="country_names" title="Enter Name of Country Here"/>
			<input type="submit" value="search" name="search_2"/>
		</form>	

	<?php 
	    if(isset($_POST['search_2']) && strlen($_POST['country_names'])>=2){
		?><table style="padding:15px" border ="1"><?php 
		    $userinput = "%". $_POST['country_names']. "%";
		    $stmt= $pdo->prepare('SELECT L.name as Name, C.name FROM league L, Country C WHERE L.country_id=C.id AND C.name LIKE :user_input'); 
		    $stmt->bindParam(':user_input', $userinput);
		    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
		    $stmt->execute();
?>
	<tr>
		<td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:15px">League</span></td>
	 	<td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:15px">Country</span></td>
	</tr>
	<?php
        while ($row = $stmt->fetch()): ?>	
           <tr>
          	<td><span style="font-family:Roboto;padding:15px"><?php echo (htmlspecialchars($row['Name'])) ?></span></td>
         	 <td><span style="font-family:Roboto;padding:15px"><?php echo (htmlspecialchars($row['name'])) ?></span></td>
            </tr>
	   <?php endwhile;?></table> <?php }?>
</div>
<div>
		<h3> League of a Team</h3>
		<form  method="post" style="padding:15px">
			<input text="date" name="league" id="league" title="Enter Team Name Here"/>
			<input type="submit" value="search" name="search_3"/>

		</form>	

	<?php 
	    if(isset($_POST['search_3']) && strlen($_POST['league'])>=2){
		?><table style="padding:15px" border ="1"><?php 
		    $userinput = "%". $_POST['league']. "%";
		    $stmt= $pdo->prepare('SELECT DISTINCT L.name as Name, T.team_long_name as Team FROM league L, matches M, Team T WHERE L.id=M.league_id AND (M.home_team_api_id=T.team_api_id OR M.away_team_api_id=T.team_api_id) AND (T.team_long_name LIKE :user_input OR T.team_short_name LIKE :user_input)'); 
		    $stmt->bindParam(':user_input', $userinput);
		    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
		    $stmt->execute();
	?>
	<tr>
		<td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:15px">League</span></td>
	 	<td><span style="font-size:large;font-weight:bold;font-family:Roboto;padding:15px">Team</span></td>
	</tr>
	<?php
        while ($row = $stmt->fetch()): ?>	
	 <!-- Using a php variable to store the name, which is sent to the player_description.php page to determine which player's info to show -->    
       
           <tr>
          	<td><span style="font-family:Roboto;padding:15px"><?php echo (htmlspecialchars($row['Name'])) ?></span></td>
         	 <td><span style="font-family:Roboto;padding:15px"><?php echo (htmlspecialchars($row['Team'])) ?></span></td>
            </tr>
           <?php endwhile;?></table> <?php }?>
</div>
         <a href="/start.php"> <input type="submit" value="Home" style="padding:10px"></a>
</center>
</body>
</html>
