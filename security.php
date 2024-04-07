<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>security</title>
	
	<style>
		.error{
			color:red;
		}
	</style>
	
</head>

<body>
	
	
	
	<?php
	if(isset($_POST["formSubmit"]))//form was submitted
	{
		if(isset($_POST["firstname"]) && strlen(trim($_POST["firstname"])) > 0)
		{
			//passed validation
			$firstname = $_POST["firstname"];
		}
		else
		{
			//failed validation
			$errors .= "First Name is required<br>";
		}
		
		if(isset($_POST["lastname"]) && strlen(trim($_POST["lastname"])) > 0)
		{
			//passed validation
			$lastname = $_POST["lastname"];
		}
		else
		{
			//failed validation
			$errors .= "Last Name is required<br>";
		}
		
		if(isset($errors))//at least one error occurred
		{
			echo "<div class='error'>".$errors."</div>";
		}
		else
		{
			//all validation passed
		}
	}
?>
	
	<form action="insert.php" method="post">
	
		<label for="firstname">First Name:</label><input type="text" 
											  value="<? if(isset($firstname)) echo $firstname; ?>" 
											  firstname="firstname" 
											  id="firstname"><br>
<label for="lastname">Last Name:</label><input type="text" 
											  value="<? if(isset($lastname)) echo $lastname; ?>" 
											  lastname="lastname" 
											  id="lastname"><br>
		<br>
		<input type="submit" name="formSubmit" value="Submit the form">
	</form>
	
	
    <br>
	<br>
	<br>
	<br>	
	
	<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

$servername = "";
$username = "";
$password = "";
$dbname = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, firstname, lastname FROM users");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</body>
</html>
