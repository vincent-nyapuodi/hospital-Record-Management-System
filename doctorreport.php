<?php
$reg = filter_input(INPUT_POST, 'reg');
$name = filter_input(INPUT_POST, 'name');
$age = filter_input(INPUT_POST, 'age');
$address = filter_input(INPUT_POST, 'address');
$bloodgrp = filter_input(INPUT_POST, 'bloodgrp');
$gender = filter_input(INPUT_POST, 'gender');
$dob = filter_input(INPUT_POST, 'dob');
$email = filter_input(INPUT_POST, 'email');
$diag = filter_input(INPUT_POST, 'diag');
$presc = filter_input(INPUT_POST, 'presc');
$add = filter_input(INPUT_POST, 'add');
$doc = filter_input(INPUT_POST, 'doc');

if (!empty($reg)){
if (!empty($name)){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "healthcare";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
$sql = "INSERT INTO records (Reg_No, Patient_Name, Age, Address, Blood_Group,
Gender, DOB, Email, Diagnosis, Prescription, Additional_Notes, Doctor_ID)
values ( '$reg', '$name', '$age', '$address', '$bloodgrp', '$gender', '$dob','$email', '$diag', '$presc', '$add', '$doc')";
if ($conn->query($sql)){
    echo "<script type='text/javascript'>
    alert('New record added successfully');
</script>";
}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}
else{
echo "Password should not be empty";
die();
}
}
else{
echo "Username should not be empty";
die();
}
?>