<?php

if(isset($_REQUEST['cmd'])){
$cmd=$_REQUEST['cmd'];
switch($cmd){
	case 1:
	updateComplaint();
	break;
	default:
	echo "wrong command";
	break;
}
}

function updateComplaint(){
	if(!isset($_REQUEST['cid'])){
		echo '{"result":0,"message":"complaint code is not correct"}';
		return;
	}

  $complaintID=$_REQUEST['cid'];
  $studentID=$_REQUEST['sid'];
  $date=$_REQUEST['date'];
  $temperature=$_REQUEST['temp'];
  $symptoms=$_REQUEST['sympt'];
  $diagnosis=$_REQUEST['diag'];
  $cause=$_REQUEST['cause'];
  $prescription=$_REQUEST['presc'];
  $nurseID=$_REQUEST['nid'];

  include_once("medicalComplaint.php");
	$complaint=new medicalComplaint();

  $result=$complaint->updateComplaint($complaintID, $studentID, $temperature, $symptoms, $diagnosis, $cause, $prescription, $nurseID);

  $result=$complaint->getComplaints();
  $row=$complaint->fetch();
  if($row==false){
    echo '{"result":0,"message":"error updating name"}';
	    }
	  else{
      echo '{"result":1,"complaint":[';
    	while($row){
      echo json_encode($row);

    	$row=$complaint->fetch();
    if($row!=false){
    	echo ",";
    }
    }
    echo "]}";
	}

}

?>
