 <!DOCTYPE html>
<html>
<head>
	<title>Formulario</title>
</head>
<body>
	<p>
	<?php 
	include 'db_connnection.php';

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
		   	$conn = OpenCon();
		    //Insert user data
		  	$sql = "SELECT * FROM TB_USER_DATA";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    			echo $v;
  			}
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$conn = null;
	?>
	</p>
	<p>
		<form action="index.php">
            		<input type="submit" name="Back" value="Back to index" />
    		</form>
	</p>
</body>
</html> 
