 <!DOCTYPE html>
<html>
<head>
	<title>Formulario</title>
	<style>
		.error {color: #FF0000;}
	</style>
</head>
<body>
	<H1>User data recording</H1>
	<?php 
	include 'db_connnection.php';
	//Data integrity flag
	$clear = true;
	//Check data
	$formData = array('name'=>'', 'email'=>'', 'description'=>'', 'address'=>'', 'postalCode'=>'', 'pass'=>'');
	$formErrors = array('nameErr'=>'', 'emailErr'=>'', 'postalCodeErr'=>'', 'passErr'=>'');
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["name"])) {
	  	$clear = false;
	    $formErrors['nameErr'] = "Name is required";
	  } else {
	    $formData['name'] = test_input($_POST["name"]);
	    // Check if the name in formed only by letters and spaces
	    if (!preg_match("/^[a-zA-Z ]*$/",$formData['name'])) {
	      $formErrors['nameErr'] = "Only letters and white space allowed";
	    }
	  }
	  
	  if (empty($_POST["email"])) {
	  	$clear = false;
	    $formErrors['emailErr'] = "Email is required";
	  } else {
	    $formData['email'] = test_input($_POST["email"]);
	    // check if e-mail address is well-formed
	    if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
	      $formErrors['emailErr'] = "Invalid email format";
	    }
	  }
	    
	  if (empty($_POST["postalCode"])) {
	  	$clear = false;
	    $formErrors['postalCodeErr'] = "Postal Code is required";
	  } else {
	    $formData['postalCode'] = test_input($_POST["postalCode"]);
	    // check if postal code syntax is valid
	    if (!preg_match("/^[0-9]{5}/",$formData['postalCode'])) {
	      $formErrors['postalCodeErr'] = "Invalid postalCode";
	    }    
	  }

	  if (empty($_POST["description"])) {
	    $formData['description'] = "";
	  } else {
	    $formData['description'] = test_input($_POST["description"]);
	  }

	  if (empty($_POST["address"])) {
	    $formData['address'] = "";
	  } else {
	    $formData['address'] = test_input($_POST["address"]);
	  }

	  if (empty($_POST["pass"])) {
	  	$clear = false;
	    $formErrors['passErr'] = "Password is required";
	  }else {
	    $formData['pass'] = test_input($_POST["pass"]);
	  }
	  //Check if there are errors
	  foreach ($formErrors as $field => $des) {
	  	if (!empty($des)) {
	  		$clear = false;
	  	}
	  }
	  if ($clear) {
	  	try {
		    $conn = OpenCon();
		    //Insert user data
		  	$sql = "INSERT INTO TB_USER_DATA(USER_NAME, EMAIL, DESCRIPTION, ADDRESS, POSTAL_CODE) 
		  	    VALUES ('".$formData['name']."', '".$formData['email']."', '".$formData['description']."', '".$formData['address']."', '".$formData['postalCode']."')";
			// use exec() because no results are returned
			$conn->exec($sql);

			//Insert credentials data
			$formData['pass'] = crypt($formData['pass'],'st');
		  	$sql = "INSERT INTO TB_USER_CREDENTIALS(EMAIL, PASSWORD) VALUES ('".$formData['email']."', '".$formData['pass']."')";
			$conn->exec($sql);

			echo "New record created successfully";
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$conn = null;
	  }
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	?>
<p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	    <p>Name: <input type="text" name="name" />
	    <span class="error">* <?php echo $formErrors['nameErr'];?></span></p>
	    <p>E-Mail: <input type="text" name="email" />
		<span class="error">* <?php echo $formErrors['emailErr'];?></span>
	    </p>
	    <p>Description: <input type="text" name="description" /></p>
	    <p>Address: <input type="text" name="address" /></p>
	    <p>Postal Code: <input type="text" name="postalCode" />
		<span class="error">* <?php echo $formErrors['postalCodeErr'];?></span>
	    </p>
	    <p>Password: <input type="password" name="pass" />
	    <span class="error">* <?php echo $formErrors['passErr'];?></span>
		</p>
	    <p><input type="submit" value="Add User data"/></p>
    </form>
</p>

<p>
	<form action="list_data.php">
            <input type="submit" name="List_Data" value="List User Data" />
    </form>
</p>
</body>
</html> 

