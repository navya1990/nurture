 <?php
 echo "hi";
 echo $_POST['cType'];
 echo $_POST['cName'];
 echo $_POST['crsId'];
	 $conn = new mysqli("localhost" ,'root', '','assignment');
	 if (mysqli_connect_errno()){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 }
	if ($conn) {
	   $sql = "INSERT INTO assignment.coursedetails (CourseName, CourseType, CourseId) VALUES ('".$_POST['cType']."', '".$_POST['cName']."','".$_POST['crsId']."');";
	   $db = mysqli_query($conn, $sql);
	if(mysqli_query($conn, $sql)){
	   
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}//Used to insert the data
	}
	
	?>