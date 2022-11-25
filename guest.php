<!DOCTYPE html>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $phone_number = $email = $date = $party_size = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check input errors before inserting in database
    // Prepare an insert party_sizement
    $sql = "INSERT INTO guest_reservations (name, phone_number,email,date,party_size) VALUES (?, ?, ?, ?, ?)"; ;
         
    if($stmt = mysqli_prepare($link, $sql)){
        
// Bind variables to the prepared party_sizement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_phone_number, $param_email, $param_date, $param_party_size);
            
        // Set parameters
        $param_name = trim($_POST["name"]);;
		$param_phone_number = trim($_POST["phone_number"]);;
		$param_email = trim($_POST["email"]);;
		$param_date = trim($_POST["date"]);;
		$param_party_size = trim($_POST["party_size"]);;
            
        // Attempt to execute the prepared party_sizement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to welcome page
            header("location: welcome.php");
        } else{
             echo "Oops! Something went wrong. Please try again later.";
        }

        // Close party_sizement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<html lang="en">
<head>
	<title> Profile Management </title>
</head>
<body>
	<center>
		<h1>Guest Reservation</h1> <br>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<label for="name">Full name:</label><br>
			<input type="text" id="name" name="name" value="" maxlength="50" required><br><br>
  
			<label for="phone_number">Phone Number:</label><br>
			<input type="text" id="phone_number" name="phone_number" value="" maxlength="10" required><br><br>
  
			<label for="email">Email:</label><br>
			<input type="text" id="email" name="email" value="" maxlength="100" ><br><br>
  
			<label for="date">Date:</label><br>
			<input type="text" id="date" name="date" value="" maxlength="100" required><br><br>
			
			<label for="party_size">Party Size:</label><br>
			<select name="party_size" id="party_size" required>
				<option value=""> </option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>	
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
			</select>
			<br><br>
  
			<input type="submit" value="Submit"> <a href="welcome.php" class="btn btn-warning">Home</a>
		</form>
	</center>
</body>
</html>