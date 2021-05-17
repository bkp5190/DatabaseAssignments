
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
    <head>
        <title>update bet amount</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Updating match: " . $_POST["mid"] . "..."; 
				$sql = 'update matches set  ' . $_POST["bettype"] . '=' . $_POST["bettype"] . '+' . $_POST["wager"] . ' WHERE match_api_id = "' . $_POST["mid"] . '"';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "Match updated successfully";
				?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='place.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
