<html>
<head>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Data</title>	
<style>
	 td{
		border: 1px solid green;
	}
</style>
</head>
<body>
 <?php
error_reporting(1);
$url="https://api.coursera.org/api/courses.v1";
$result1 = strip_tags(file_get_contents($url));
$process_res[]= json_encode(trim($result1,'\"'));
$Data= array();
foreach($process_res as $pno=>$pelements[]){
	foreach($pelements as $pindex=>$pdata){	
    $colmdata = explode(",",$pdata);
     $r =count($colmdata);
	for($e=0;$e<=$r;$e++){
		$strData = $colmdata[$e];
		$rowData = explode(":",$strData);
		if(isset($rowData[1]) && (!preg_match('[^a-zA-Z0-9]', $rowData))){
		$matchString = preg_replace('/[^a-zA-Z0-9]/s', '', $rowData[0]);
			switch ($matchString) {			
			case  "courseType":
			           $res= preg_replace('/[^a-zA-Z0-9]/s', '', $rowData[1]);
					   
					// if(strlen(trim($res," \t."))>0)
						$Data[$e]['courseType'] = $res;
			break;	
			case "id":
			$res =preg_replace('/[^a-zA-Z0-9]/s','', $rowData[1]);
			
			
				$Data[$e]['courseId'] = $res;
			break;
			case  "name":
			$res=preg_replace('/[^a-zA-Z0-9]/s', '', $rowData[1]);
			//if(isset($res)) {echo strlen($res);}
			$Data[$e]['courseName'] = $res;
				break;	
            default :break;				
			}
		}
        }
       }
}	
?>
<table>
  <tr>
    <th>CourseType</th>
    <th>CourseId</th> 
    <th>CourseName</th>
	<th>Edit</th>
	<th>Cancel</th>
  </tr>
<?php $i=0;
for($i=0;$i<count($Data);$i++){?>
<tr><td>

     <?php 
  echo "<tr><td>";
    echo $Data[$i]['courseType']."</td>";
  echo "<td>" . $Data[$i]['courseId'] . "</td>";
  echo "<td>" . $Data[$i]['courseName'] . "</td><td>";?>
  <input type="Button" name="edButton" value="Edit"/></td><td>
  <input type="Button" name="cancel" value="Cancel"></td></tr>
  
<?php  }?>
  
</table>

