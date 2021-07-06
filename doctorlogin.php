<?php  
// creating a database connection
$servername ="localhost";
$username ="root";
$password ="";
$dbname ="healthcare";// enter te name of your database

$conn = mysqli_connect($servername, $username, $password, $dbname);
 if(!$conn){
 	die("Connection Failed" . mysqli_connect_error());
 }
 // end of db connection section
 //stores first name and password entered through the form in $fname and $userpwd variables
if(isset($_POST['submit'])){
	$reg= mysqli_real_escape_string($conn, $_POST['reg']);
	$pass= mysqli_real_escape_string($conn, $_POST['password']);
	$encryptedPass = password_hash($pass,PASSWORD_BCRYPT);
// it the selects the firstname and passwordfrom the registration table that was intially created
	$sql= "SELECT * FROM staff WHERE Staff_ID='".$reg."' AND PASSWORD='".$encryptedPass."'";
	$result=mysqli_query($conn, $sql);
    $rows=mysqli_num_rows($result);
    //the if statement compares the data entered through the form and the one stored in the database(registration table) 
     	if(password_verify($pass,$encryptedPass)){
     		header("Location: doctorpatientrecords.php");// if correct opens a new home.php or any file you would want it to go to
     	}
     	else {
        echo "<script type='text/javascript'>
        alert('Incorrect Password or Username');
    </script>";
     	}
}
?>
