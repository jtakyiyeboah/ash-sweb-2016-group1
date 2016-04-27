<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['USER'])){

	header("location:login.php");
	exit();
}

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Ashesi | Student Medical Details</title>
			  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- Loading Flat UI -->
        <link href="css/style.css" rel="stylesheet">
        <!-- 	Web Browser thumbnail image -->
        <link rel="shortcut icon" href="#">
    </head>


    <body>
        <div class="navigation">
            <img src="images/logo.jpg" alt="" class="logo">


            <ul class="menu">
                <li><a href="studentslist.php">HOME</a></li>



								<li class="dropdown" id="complaints"><a  class="dropdown-button">COMPLAINTS</a>
                <ul class="dropdown-content">
    							<li><a href="medicalComplaintAdd.php">Add </a></li>

    							<li><a href="medicalComplaintList.php">View </a></li>

    							<li><a href="editComplaints.php">Edit </a></li>
    						</ul>

                </li>
			        <li class="dropdown" id="records"><a class="dropdown-button2" >STUDENT RECORDS</a>
                  <ul class="dropdown-content2">
                      <li><a href="studentslist.php">View </a></li>
                      <li><a href="editStudentRecord.php">Edit </a></li>
                  </ul>

                </li>
								<li><a href="generateReport.php">GET REPORT</a></li>
                <li><a href="medicalComplaintAdd.php" class="btn">NEW COMPLAINT</a></li>
                <li><img src="images/profie.jpg" alt="" class="profile-pic"></li>
            </ul>
        </div>



					<?php
					$strStatusMessage="Display Users";

					if(isset($_REQUEST['message'])){
						$strStatusMessage=$_REQUEST['message'];
					}

					?>
					<div id="divStatus" class="status">
						<?php echo  $strStatusMessage ?>
					</div>

					<div class="row">
				  <div class="col s3 offset-s9"><span class="flow-text">

					</span></div>
					</div>
					<section class="medical-history">
						<?php
						$strStatusMessage ="Edit Medical Complaint";
						include_once("medicalComplaint.php");
						$obj=new medicalComplaint();
						$complaintID = $_REQUEST["complaintID"];

						$result =$obj->getComplaintByID($complaintID);
						if(!$result){
							echo "Error getting data.";
							exit();

						}
						$row =$obj->fetch();


						?>
						<div id="divStatus" class="status">
								<?php echo  $strStatusMessage ?>
						</div>
						<div id="divContent">
							Content space
							<form action="updateComplaint.php" method="GET">
							<input type="hidden" name="complaintID" value="<?php echo $row['COMPLAINTID'] ?>">
							<div>Student ID: <input type="text" name="studentID" value="<?php echo $row['STUDENTID'] ?>";/></div>
							<div>Date: <input type="date" name="date" value="<?php echo $row['DATE'] ?>"/></div>
							<div>Temperature: <input type="text" name="temperature" value="<?php echo $row['TEMPERATURE'] ?>"/></div>
							<div>Symptoms: <input type="text" name="symptoms" value="<?php echo $row['SYMPTOMS'] ?>"/></div>
          	<div>
              Diagnosis: <select class="browser-default" name="diagnosis">
  							<?php

  							include_once("diseases.php");
  				      	$disease=new diseases();
  				      	$result=$disease->getAllDiseases();

  				      	$diseaseRow=$disease->fetch();
  				        		while($diseaseRow==true){
                        if($diseaseRow['DISEASEID']==$row['DIAGNOSIS']){
                  				//echo "<option value='{$value['id']}' selected>{$value['name']}</option>";
                          echo "<option value={$diseaseRow['DISEASEID']} selected>{$diseaseRow['NAME']}</option>";
                  			}
                  			else{
                  					echo "<option value={$diseaseRow['DISEASEID']}>{$diseaseRow['NAME']}</option>";
                  			}

  											$diseaseRow=$disease->fetch();
  				        	}
  				      ?>
  						</select>
            </div>

						<div>Cause: <input type="text" name="cause" value="<?php echo $row['CAUSE'] ?>";/></div>
						<div>Prescription: <input type="text" name="prescription" value="<?php echo $row['PRESCRIPTION'] ?>";/></div>
						<div>Nurse ID: <input type="text" name="nurseID" value="<?php echo $row['NURSEID'] ?>";/></div>



						<input type="submit" name= "save" value="Update">
					</form>
					</div>
				</td>
			</tr>
		</table>

  </section>
	</body>
</html>
