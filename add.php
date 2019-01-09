<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Data</title>	
<style>
	table{
		width:80%;
		margin:40px;
		border :1 px solid green;
	}
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
 <?php
 error_reporting(0);
	 $conn = new mysqli("localhost" ,'root', '','assignment');
	 if (mysqli_connect_errno()){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 }
	$url="https://api.coursera.org/api/courses.v1";
	$result1 = strip_tags(file_get_contents($url));
	$process_res[]= json_encode(trim($result1,'\"'));
	$Data= array();
	$courseId = array();
	$courseName=  array();
	$courseType= array();
	foreach($process_res as $pno=>$pelements[]){
		foreach($pelements as $pindex=>$pdata){	
		$colmdata = explode(",",$pdata);
		 $r =count($colmdata);
		for($e=0;$e<=$r;$e++){
			$strData = $colmdata[$e];
			$rowData = explode(":",$strData);
			if(isset($rowData[1]) && (!preg_match('[^a-zA-Z0-9]', (string) $rowData))){
			$matchString = preg_replace('/[^a-zA-Z0-9]/s', '', (string)$rowData[0]);
				switch ($matchString) {			
				case  "courseType":
						   $res= trim(preg_replace('/[^a-zA-Z0-9]/s', '', (string)$rowData[1]));
							$courseType[] = $res;
				break;	
				case "id":
				$res =preg_replace('/[^a-zA-Z0-9]/s','', (string)$rowData[1]);
					$courseId[]= $res;
				break;
				case  "name":
				$res=preg_replace('/[^a-zA-Z0-9]/s', '',(string) $rowData[1]);
				$courseName[] = $res;
					break;				
				}
			}
			}
		   }
	}	
	?>
<table>
<tr><th>CourseType</th><th>CourseId</th> <th>CourseName</th><th>Edit</th><th>Cancel</th></tr>
<form name ="submitData" id="submit-data"  action ="" method="POST" >
<?php 
for($i=0,$j=0,$k=0;$i<count($courseType),$j<count($courseId),$j<count($courseName);$i++,$j++,$k++){
	  echo "<tr><td>";
	  echo "<input type='hidden' name='txtHidden' value='".$i."'  id='HidText$i'>";
	  echo "<textarea  name='CourseName'  id='courseType$i' type='readOnly'>$courseName[$i]</textarea></td><td>";
	   echo "<textarea  name='CourseName'  id='courseId$j' type='readOnly'>$courseId[$j]</textarea></td><td>";
	   echo "<textarea  name='CourseName'  id='courseName$k' type='readOnly'>$courseName[$k]</textarea></td><td>";
	   echo "<input type='submit' name='edButton' id='edButton$i' value='Edit'/></td><td>";
	   echo "<input type='Button' name='cancel' id='CancelButton<?php// echo $i;?>' value='Cancel'></td></tr>";
	 
	/* Check connection
	if ($conn) {
	   $sql = "INSERT INTO assignment.coursedetails (CourseName, CourseType, CourseId) VALUES ('".$courseName[$i]."', '".$courseType[$j]."','".$courseId[$k]."');";
	  $db = mysqli_query($conn, $sql);
	if(mysqli_query($conn, $sql)){
	   echo "Records inserted successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}//Used to insert the data
	}*/ 

}?>
</form>
</table>

<script>
$(document).ready(function(){
   $('input[type="submit"]').click(function(e) {
   var subm = e.target.id;
   var idNo = subm.slice(-1);
   var val1 = "#courseType"+idNo;
   var crsType =$(val1).val();
   
   var val2 = "#courseName"+idNo;
   var crsName =$(val2).val();
   
   var val3 = "#courseId"+idNo;
   var crsId =$(val3).val();
   
   $.ajax({
        type: 'POST',
        url: '/nurture/save-data.php',
        data: { 'cType' :crsType,
		        'cName' :crsName,
		         'crsId' :crsId,
				 'cId':idNo;
		},
		success: function(response) {
		
       }   
    });
 });
});
	
	</script>

