<?php 
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `records` WHERE CONCAT(`Reg_No`)LIKE'%".$valueToSearch."%'";
    $search_result = filterTable($query);
       
}
else{
    $query = "SELECT * FROM `records`";
    $search_result = filterTable($query);
}

function filterTable($query)
{
    $connect = mysqli_connect("localhost","root","","healthcare");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../Healthcare/doctorpatientrecords.css">

    <title>Medical Center Records System</title>
    <style>
        
    </style>
</head>

<body>
    <div class="Body">
        <div class="upper">
            <div style="padding: 25px 0 0 25px;">
                <h1>Doctor's Report</h1>
            </div>
            <div class="nav">
                <div class="dropdown">
                    <a class="dropbtn">Service</a>
                    <div class="dropdown-content">
                        <a href="../Healthcare/doctorreport.html">Patient-Diagnosis</a>
                        <a href="../Healthcare/doctorreport.html">Patient-Records</a>
                    </div>
                </div>
                <a class="btn" href="../Healthcare/home.html">Log Out</a>

            </div>
        </div>
    </br>
        <div class="records">
            <form action="doctorpatientrecords.php" method="post">
                <input type="text" name="valueToSearch" placeholder="Enter Registration Number"><br><br>
                <input type="submit" name="search" value="Search"><br><br>
            <?php 
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "healthcare"; 
$mysqli = new mysqli($host, $dbusername, $dbpassword, $dbname); 
$query = "SELECT * FROM records";
 
 
echo '<table align="center" border="1px" cellspacing="1" cellpadding="5"> 
<tr class="tab"><td colspan="11" align="center"> <font face="Arial">PATIENT RECORDS</font> </td> </tr>      
<tr class="tab"> 
          <td> <font face="Arial">Reg_No</font> </td> 
          <td> <font face="Arial">Patient Name</font> </td> 
          <td> <font face="Arial">Age</font> </td> 
          <td> <font face="Arial">Address</font> </td> 
          <td> <font face="Arial">Blood Group</font> </td> 
          <td> <font face="Arial">Gender</font> </td> 
          <td> <font face="Arial">Date of Birth</font> </td> 
          
          <td> <font face="Arial">Diagnosis</font> </td> 
          <td> <font face="Arial">Prescription</font> </td> 
          <td> <font face="Arial">Additional Notes</font> </td> 
          <td> <font face="Arial">Doctor ID</font> </td> 
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = mysqli_fetch_array($search_result)) {
        $Reg_No = $row["Reg_No"];
        $name = $row["Patient_Name"];
        $age = $row["Age"];
        $address = $row["Address"];
        $bloodgrp = $row["Blood_Group"];
        $gender = $row["Gender"];
        $dob = $row["DOB"];
        
        $diag = $row["Diagnosis"];
        $presc = $row["Prescription"];
        $add = $row["Additional_Notes"];
        $doc = $row["Doctor_ID"];
 
        echo '<tr> 
                  <td>'.$Reg_No.'</td> 
                  <td>'.$name.'</td> 
                  <td>'.$age.'</td> 
                  <td>'.$address.'</td> 
                  <td>'.$bloodgrp.'</td> 
                  <td>'.$gender.'</td> 
                  <td>'.$dob.'</td> 
                 
                  <td>'.$diag.'</td> 
                  <td>'.$presc.'</td> 
                  <td>'.$add.'</td> 
                  <td>'.$doc.'</td> 
                 
              </tr>';
    }
    $result->free();
} 
?>

                
            </form>
            
        </div>

    </div>
</body>

</html>