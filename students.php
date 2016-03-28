
<?php
	include_once("databasehelper.php");
	/**
	*Students class

	* @method boolean addStudentRecord() should insert a student and return a boolean result
	* @method students() is a constructor of the student class
	*/

	class students extends databasehelper{

		function students(){

		}
		/**
		*gets students records based on a filter
		*@param string condition to filter. If false, the condition will not be applied.
		*@return boolean true if successful, false if unsuccessful
		*/
		function getStudents($filter=false){
			$strQuery= "select students.STUDENTID, USERNAME, students.FIRSTNAME, students.LASTNAME, GENDER, students.EMAIL, students.PHONENUMBER, HEIGHT, WEIGHT, BLOODTYPE, emergencycontact.FIRSTNAME as CONTACTFIRSTNAME, emergencycontact.LASTNAME as CONTACTLASTNAME from students left join studenthasrecord on students.STUDENTID= studenthasrecord.STUDENTID left join emergencycontact on students.EMERGENCYCONTACTID= emergencycontact.CONTACTID";



			if($filter!=false){
				$strQuery=$strQuery . " where $filter";
			}
			return $this->query($strQuery);
		}

		/**
		*Searches for students by username, firstname, last name
		*@param string search text
		*@return boolean true if successful, false if insuccessful
		**/
		function searchStudents($text=false){
			$filter=false;
			if($text!=false){
				$filter=" students.USERNAME like '$text' or students.FIRSTNAME like '$text' or students.LASTNAME like '$text' ";
			}
			return $this->getStudents($filter);
		}






		/**
		*Adds a new user
		*@param int studentID
		*@param decimal weight weight of student
		*@param decimal height height of student
		*@param string bloodtype bloodtype of student
		*@return boolean returns true if successful or false
		*/
		function addStudentRecord($studentID,$weight,$height,$bloodtype){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="Update studentHasRecord set
							HEIGHT=$height,
							WEIGHT=$weight,
							BLOODTYPE='$bloodtype' where STUDENTID=$studentID";
			return $this->query($strQuery);
		}
		/**
		*Adds a new user
		*@param int studentID
		*@param decimal weight weight of student
		*@param decimal height height of student
		*@param string bloodtype bloodtype of student
		*@return boolean returns true if successful or false
		*/
		function addNewStudentRecord($studentID,$weight,$height,$bloodtype){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="insert into studentHasRecord set
			STUDENTID =$studentID,
							HEIGHT=$height,
							WEIGHT=$weight,
							BLOODTYPE='$bloodtype'";
			return $this->query($strQuery);
		}
		/**
		*log in a nurse
		*@param int nurseID
		*@param string password password of nurse
		*@param string email email of nurse
		*@return boolean returns true if successful or false
		*/
		function login($email,$password){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="SELECT * FROM `nurses` WHERE `PASSWORD` LIKE '$password' AND `EMAIL` LIKE '$email'";
			return $this->query($strQuery);
		}


		function updateStudentRecord($studentID, $weight, $height, $bloodtype){

			$strQuery="Update studenthasrecord set HEIGHT='$height', WEIGHT='$weight', BLOODTYPE='$bloodtype' where STUDENTID=$studentID";
			return $this->query($strQuery);
		}

		function getStudentByID($studentID){
			$strQuery="Select STUDENTID, HEIGHT, WEIGHT, BLOODTYPE from studenthasrecord where STUDENTID=$studentID";
			return $this->query($strQuery);
		}

	}


	?>
