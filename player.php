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
                <h2><span style="font-size:x-large;font-family:Roboto">Search for a player by name:</span></h2>
                <form method="post" style="padding:30px">
                    <input type="text" name="player_name" id="player_name" />
                    <input type="submit" value="Search" name="search" />
                </form>
                
                    <?php
                        //The strlen(...) > 2 ensures that the user entered at least 3 characters to avoid queries with too large a result size.
                        if(isset($_POST['search']) && strlen($_POST['player_name']) > 2) {
                            ?>
                            <?php
                            //The following is a functional use of a php prepare statement containing a query that is
                            //reliant upon user input.
                            $userinput = "%" . $_POST['player_name'] . "%";
                            $stmt = $pdo->prepare('SELECT DISTINCT P.player_name, P.height, P.weight FROM player P, Player_attributes A WHERE P.player_api_id=A.player_api_id AND P.player_name LIKE :user_input');
                            $stmt->bindParam(':user_input', $userinput);
                            $stmt->execute();

                            $count = $stmt->rowCount();

                            if($count > 0) {
                            ?>
                            <center><span style="font-size:large;font-family:Roboto;color:#999999">Click on a player's name for more information</span></center>
                            <table style="padding:24px" border="1">
                            <tr>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Name</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Height</span></td>
                            <td><span style="font-size:x-large;font-weight:bold;font-family:Roboto;padding:20px">Weight</span></td>
                            
                            
                            </tr>
                            <?php
                            while ($row = $stmt->fetch()): ?>
                                <!-- Using a php variable to store the name, which is sent to the player_description.php page to determine which player's info to show -->    
                                <?php
                                    $current_name = strtoupper($row['player_name']);
                                ?>
                                <tr>
                                    <td><a style="text-decoration:none;font-family:Roboto;color:#78ffef;font-weight:bold;font-size:large;padding:4px" href="player_description.php?<?= $current_name ?>"><?php echo strtoupper(htmlspecialchars($row['player_name'])) ?></a></td>
                                    <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo (htmlspecialchars($row['height'] . "cm")) ?></span></td>
                                    <td style="text-align:center"><span style="font-family:Roboto;padding:20px"><?php echo (htmlspecialchars($row['weight'] . "lbs")) ?></span></td>
                                </tr>
                        <?php endwhile;?></table> <?php } 
                        else { 
                            ?>
                            <center><span style="font-size:medium;font-family:Roboto;color:#999999">No players found</span></center>
                            <?php
                        } 

                    }?>
            </div>
        </center>

    </body>
</html>