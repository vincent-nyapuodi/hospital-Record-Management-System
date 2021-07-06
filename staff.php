<?php
$reg = $_POST['reg'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['mnum'];
$email = $_POST['email'];
$password = $_POST['password'];
$encryptedPass = password_hash($password,PASSWORD_BCRYPT);
$gender = $_POST['gender'];

if(!empty($reg) ||!empty($fname) || !empty($lname) || 
!empty($phone) || !empty($email)  || !empty($encryptedPass) || 
!empty($gender)){
    $host = "localhost";
    $dbUsername  = "root";
    $dbPassword = "";
    $dbname = "healthcare";

    //create connection
    $conn = new mysqli($host,$dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT STAFF_ID From staff Where STAFF_ID = ? Limit 1";
        
        $INSERT = "INSERT into staff (STAFF_ID, FIRST_NAME, LAST_NAME, PHONE, EMAIL, PASSWORD, GENDER)
        values(?,?,?,?,?,?,?)";
        
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $reg);
        $stmt->execute();
        $stmt->bind_result($reg);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssss", $reg, $fname, $lname, $phone, $email, $encryptedPass, $gender);
            $stmt->execute();
            echo "<script type='text/javascript'>
                alert('New record added successfully');
            </script>";
          
        }
        else{
            echo "<script type='text/javascript'>
            alert('Record not Added. The details you entered already exist.');
         </script>";
         
        }
        $stmt->close();
        $conn->close();
    }
}
else{
    echo "All fields are required";
    die();
}
?>