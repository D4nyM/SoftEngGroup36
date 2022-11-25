<!DOCTYPE html>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address1 = $address2 = $payment_option = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check input errors before inserting in database
    // Prepare an insert statement
    $sql = "UPDATE users SET name = ?, address1= ?, address2= ?, payment_option= ?;" ;
         
    if($stmt = mysqli_prepare($link, $sql)){
        
// Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_address1, $param_address2, $param_payment_option);
            
        // Set parameters
        $param_name = trim($_POST["name"]);;
		$param_address1 = trim($_POST["address1"]);;
		$param_address2 = trim($_POST["address2"]);;
        $param_payment_option = trim($_POST["payment_option"]);;
  
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to welcome page
            header("location: welcome.php");
        } else{
             echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<html lang="en">
<head>
	<title> User Register </title>
</head>
<body>
	<center>
		<h1>User Register</h1> <br>
		<form action=" " method="post">
			<label for="name">Full name:</label><br>
			<input type="text" id="name" name="name" value="" maxlength="50" required><br><br>
  
			<label for="address1">Mailing Address:</label><br>
			<input type="text" id="address1" name="address1" value="" maxlength="100" required><br><br>
			
			<input type="checkbox" id="myCheck" onclick="myFunction()">  
			<label for="myCheck">Same as Shipping Address:</label><br><br>
			
			<script>
			function myFunction() {
				var checkBox = document.getElementById("myCheck");  
				var textShip = document.getElementById("address1");  
				var textBil = document.getElementById("address2"); 
				if (checkBox.checked == true){
					  textBil.value=textShip.value;  
				} else {
					  textBil.value="";
				}
			}
			</script>	
  
			<label for="address2">Billing Adress:</label><br>
			<input type="text" id="address2" name="address2" value="" maxlength="100" ><br><br>
			
			<label for="diner">Preferred Diner #:</label><br><br>
			
			<label for="points">Earned Points:</label><br><br>
			
			<label for="paymentmeth">Preferred Payment Method:</label><br>
			<script>
			function onlyOne(checkbox) {
				var checkboxes = document.getElementsByName('check')
				checkboxes.forEach((item) => {
					if (item !== checkbox) item.checked = false
				})
			}
			</script>
			<table>
				<tr>
					<td>Cash</td>
					<td><input type="checkbox" id ="payment_option" name="check" value="0" onclick="onlyOne(this)"></td>
					<td>Credit</td>
					<td><input type="checkbox" id ="payment_option" name="check" value="1" onclick="onlyOne(this)"></td>
					<td>Check</td>
					<td><input type="checkbox" id ="payment_option" name="check" value="2" onclick="onlyOne(this)"></td>
				</tr>
			</table><br>
  
			
			<input type="submit" value="Submit"> <a href="welcome.php" class="btn btn-warning">Home</a>
		</form>
	</center>
</body>
</html>
