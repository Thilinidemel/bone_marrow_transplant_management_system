<?php

$hospital_id = $_SESSION['hospital_id'];

//Patients count
$sql1="SELECT count(patient_id) FROM patient WHERE hospital_id=$hospital_id";
$result1=mysqli_query($connection,$sql1);
if($result1){
    while($row1=mysqli_fetch_assoc($result1)){
      $patient=$row1['count(patient_id)'];
      $_SESSION['p']=$patient;  
    }
}

//Donors count
$sql2="SELECT count(donor_id) FROM donor WHERE hospital_id=$hospital_id";
$result2=mysqli_query($connection,$sql2);
if($result2){
  while($row2=mysqli_fetch_assoc($result2)){
    $donor=$row2['count(donor_id)'];
    $_SESSION['d']=$donor;
  }
}

//Concultants count
$sql3="SELECT count(consultant_id) FROM consultant WHERE hospital_id=$hospital_id";
$result3=mysqli_query($connection,$sql3);
if($result3){
  while($row3=mysqli_fetch_assoc($result3)){
    $consultant=$row3['count(consultant_id)'];
    $_SESSION['con']=$consultant;
  }
}

//Clinicians count
$sql4="SELECT count(clinician_id) FROM clinician WHERE hospital_id=$hospital_id";
$result4=mysqli_query($connection,$sql4);
if($result4){
  while($row4=mysqli_fetch_assoc($result4)){
    $clinician=$row4['count(clinician_id)'];
    $_SESSION['cli']=$clinician;
  }
}

//Sessions count
$sql5="SELECT count(session_id) FROM session WHERE hospital_id=$hospital_id";
$result5=mysqli_query($connection,$sql5);
if($result5){
  while($row5=mysqli_fetch_assoc($result5)){
    $session=$row5['count(session_id)'];
    $_SESSION['s']=$session;
  }
}


$p=$_SESSION['p'];
$d=$_SESSION['d'];
$con=$_SESSION['con'];
$cli=$_SESSION['cli'];
$s=$_SESSION['s'];

?>