 <!DOCTYPE html>
<html>
<head>
	<title>Formulario</title>
</head>
<body>
	<p>
	<?php 
	//Set DB configuration
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ingeteam_prueba";

	echo "<table style='border: solid 1px black;'>";
	echo "<tr><th>Name</th><th>E-Mail</th><th>Description</th><th>Address</th><th>Postal Code</th></tr>";

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
		
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //Insert user data
		$sql = "SELECT * FROM TB_USER_DATA";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		echo $v;
		}
		/*if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    echo "Name: " . $row["USER_NAME"]. " - E-mail: " . $row["EMAIL"]. " - DESCRIPTION" . $row["DESCRIPTION"]. " - ADDRESS" . $row["ADDRESS"]. " - POSTAL_CODE" . $row["POSTAL_CODE"]. "<br>";
		  }
		} else {
		  echo "0 results";
		}*/
	} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
	?>
	</p>
</body>
</html> 
