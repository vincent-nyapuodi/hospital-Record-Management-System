<?php
$reg = $_POST['reg'];
$name = $_POST['name'];
$age = $_POST['age'];
$address = $_POST['address'];
$bloodgrp = $_POST['bloodgrp'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$diag = $_POST['diag'];
$presc = $_POST['presc'];
$add = $_POST['add'];
$doc = $_POST['doc'];

if(!empty($reg) ||!empty($name) ||!empty($age) ||!empty($address) ||
!empty($bloodgrp) ||!empty($gender) || !empty($dob) || !empty($email) || 
!empty($diag) || !empty($presc)  || !empty($add) || 
!empty($doc)){
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
        $SELECT = "SELECT email From records Where email = ? Limit 1";
        $INSERT = "INSERT into records(Reg_No, Patient_Name, Age, Address, Blood_Group,
        Gender, DOB, Email, Diagnosis, Prescription, Additional_Notes, Doctor_ID )
        values(?,?,?,?,?,?,?,?,?,?,?)";
        
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssssssss", $reg, $name, $age, $address, $bloodgrp, $gender, $dob, $diag, $presc, $add, $doc);
            $stmt->execute();
            echo "<script type='text/javascript'>
                alert('New record added successfully');
            </script>";
          
        }
        else{
            echo "email is already registered";
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