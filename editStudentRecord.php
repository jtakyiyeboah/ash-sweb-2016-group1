<?php
<<<<<<< HEAD
	error_reporting(0);
=======
error_reporting(0);
>>>>>>> 20f110938434606bd45f0c2fd71f7c45cfc89864
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


    						</ul>

                </li>
			        <li class="dropdown" id="records"><a class="dropdown-button2" >STUDENT RECORDS</a>
                  <ul class="dropdown-content2">
                      <li><a href="studentslist.php">View </a></li>

                  </ul>

                </li>
								<li><a href="generateReport.php">GET REPORT</a></li>
                <li><a href="medicalComplaintAdd.php" class="btn">NEW COMPLAINT</a></li>
                <li><a href='logout.php' class='btn'>Logout</a><li>
                <li><img src="images/profie.jpg" alt="" class="profile-pic"><br>
                  <?php


                $id=$_SESSION['USER'];
                echo $id['FIRSTNAME']." " .$id['LASTNAME'];
                ?></li>
            </ul>
        </div>

					<?php
					$strStatusMessage="Edit Student Record";

					if(isset($_REQUEST['message'])){
						$strStatusMessage=$_REQUEST['message'];
					}

	?>
					<div id="divStatus" class="status">
						<?php echo  $strStatusMessage ?>
					</div>

		<div class="row">

			</span></div>
		</div>
		<section class="medical-history">
<?php

	include_once("students.php");
	 $obj=new students();
	$studentID = $_REQUEST["studentID"];

	$result =$obj->getStudentByID($studentID);
	if(!$result){
		echo "Error getting data.";
		exit();

	}
	$row =$obj->fetch();


?>

						<form class="position" action="update.php" method="GET">
						<input type="hidden" name="studentID" value="<?php echo $row['STUDENTID'] ?>">
						<div>Weight: <input class="text" type="text" name="weight" value="<?php echo $row['WEIGHT'] ?>";/> kg</div>
						<div>Height: <input class="text" type="text" name="height" value="<?php echo $row['HEIGHT'] ?> "/> m



						</div>
						<div>Blood Type:
							<select class="select" name="bloodtype">
								 <?php

									$groupA="";
									$groupB="";
									$groupAB="";
									$groupO="";

									if($row['BLOODTYPE']=='A'){
										$groupA="selected";

									}
									else if($row['BLOODTYPE']=='B'){
										$groupB="selected";

									}
									else if($row['BLOODTYPE']=='AB'){
										$groupAB="selected";

									}
									else{

										$groupO="selected";

									}



								?>
                   				 <option <?php echo $groupA ?> value =A>A</option>
                   				 <option <?php echo $groupB ?> value =B>B</option>
                   				 <option <?php echo $groupAB ?> value =AB>AB</option>
                    			<option <?php echo $groupO ?> value =O>O</option>




							</select>
						</div>
						<input class="submit" type="submit" name= "save" value="Update">
		</form>
					</div>
				</td>
			</tr>
		</table>

	</section>
	</body>
</html>
