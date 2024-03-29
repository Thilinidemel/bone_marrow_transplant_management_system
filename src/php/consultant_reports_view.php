<?php
require_once('consultant_navbar_reports.php');
require_once('../../config/connection.php');
session_start();
if (!(isset($_SESSION['username']))) {
    header("Location:consultant_login.php");
}

if (isset($_GET['report-id'])) {
  $patient_id = $_GET['report-id'];

  $sql2 = "SELECT * FROM patient_clinical_reports LEFT JOIN patient ON patient_clinical_reports.patient_id=patient.patient_id";
  $result2 = mysqli_query($connection, $sql2);
  if ($result2) {
    while ($rows = mysqli_fetch_assoc($result2)) {
      $patient_cr_id = $rows['patient_cr_id'];
      $patient_name = $rows['patient_name'];
      $email = $rows['email'];
      $telephone_no = $rows['telephone_no'];
      $date_of_birth = $rows['date_of_birth'];
      $gender = $rows['gender'];
      $height = $rows['height'];
      $blood_group = $rows['blood_group'];
      $hospital_id = $rows['hospital_id'];
      $date = $rows['date'];
      $blood_pressure = $rows['blood_pressure'];
      $pulse_rate = $rows['pulse_rate'];
      $allergies = $rows['allergies'];
      $disabilities = $rows['disabilities'];
      $diet = $rows['diet'];
      $examinations = $rows['examinations'];
      $follow_ups = $rows['follow_ups'];
      $weight=$rows['weight'];
    }
  }

  $sql3 = "SELECT * FROM patient_medical_reports LEFT JOIN patient_clinical_reports ON patient_medical_reports.patient_cr_id=patient_clinical_reports.patient_cr_id";
  $result3 = mysqli_query($connection, $sql3);
  if ($result3) {
    while ($rows = mysqli_fetch_assoc($result3)) {
      $patient_mr_id = $rows['patient_mr_id'];
      $diagnosed_with = $rows['diagnosed_with'];
      $drugs = $rows['drugs'];
      $unit = $rows['unit'];
      $dosage = $rows['dosage'];
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Generation</title>
    <link rel="stylesheet" href="../../public/css/consultant_reports_view.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
  </head>

  <body>

    <div class="top-nav">
      <div class="head">
          <h1>Reports</h1>
      </div>

      <div class="search">
          <div class="search-bar">
            <span class="material-icons">search</span>
            <input type="search" placeholder="search here">
          </div>
        </div>

      <div class="top">
        <span class="material-icons">notifications</span>
        <span class="material-icons">chat_bubble</span>
        <div class="Loggedin"> Welcome! <?php echo $_SESSION['username'];?></div>
        <span class="material-icons">account_circle</span>
      </div>
    </div>

    <div class="board">
      <div id="whatToPrint">
        <div class="row1">
          <p class="date"><?php echo $date; ?></p>
        </div>
        <div class="row1">
          <h1>Patient Medical Records</h1>
        </div>
        <div class="row2">
          <div class="col">
            <h4>Name</h4>
            <p><?php echo $patient_name; ?></p>
          </div>
          <div class="col">
            <h4>Date of Birth</h4>
            <p><?php echo $date_of_birth; ?></p>
          </div>
        </div>
        <div class="row2">
          <div class="col">
            <h4>Telephone Number</h4>
            <p><?php echo $telephone_no; ?></p>
          </div>
          <div class="col">
            <h4>Weight</h4>
            <p><?php echo $weight; ?></p>
          </div>
        </div>
        <div class="">

        </div>
        <p><?php echo $blood_pressure; ?></p>
        <p><?php echo $patient_id; ?></p>
        <a href="javascript:generatePDF()" id="downloadButton">Click to Download</a>
        <script type="text/javascript">
          async function generatePDF() {
            document.getElementById("downloadButton").innerHTML = "Currently downloading, please wait";
            //Get the Element to be Downloaded
            var downloading = document.getElementById("whatToPrint");
            //Create a jason.pdf ('orientation', 'dimention', 'pdf size')
            var doc = new jsPDF('1', 'pt', 'a4');
            await html2canvas(downloading, {
              //allowTaint: true,
              //useCORS: true,
              width: 1000
            }).then((canvas)=>{
              //Get a canvas to convert to PNG
              doc.addImage(canvas.toDataURL("image/png"), 'PNG', 25, 5, 500, 1000);
            })
            doc.save("Document.pdf");
            //downloading Code
            document.getElementById("downloadButton").innerHTML = "Click to Download";
          }
        </script>
      </div>
    </div>
  </body>
</html>
