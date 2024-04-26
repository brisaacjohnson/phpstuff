<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>insert data</title>
</head>

<body>
	
	<?php
$fname = filter_input(INPUT_POST, 'firstname');
$lname = filter_input(INPUT_POST, 'lastname');
if (!empty($username)){
if (!empty($password)){
$host = "";
$dbusername = "";
$dbpassword = "";
$dbname = "";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
$sql = "INSERT INTO users (firstname, lastname)
values ('$fname','$lname')";
if ($conn->query($sql)){
echo "New record is inserted sucessfully";
}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}
}
?>
	
</body>
</html>
