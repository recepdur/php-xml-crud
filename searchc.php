<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />

<?php
	
	if(isset( $_POST['searchcourse']))
	{
		$search_word = $_POST['searchcourse'];
		if($search_word != "")
		{
			$dizi=array();
			$sorgu=false;
			$file = "data/courses.xml";
			$xml = simplexml_load_file($file);
			foreach($xml->children() as $course)
				if(stristr($course->course_name, $search_word) == true)     // compare all nodes in xml file with search_word
				{
					$dizi[]=$course['courseId'];            // add course id in array
					$sorgu=true;
				}
			
			if($sorgu == true)             // if search word is there
			{
				echo "Search Word: &nbsp;&nbsp;". $search_word ."<br/>";
				echo "Search Result: <br/>" 
					.' <table border="2">
					 <tr>
						 <th>Course Code</th> 
						 <th>Course Name</th> 
						 <th>Instructor</th> 						  
					 </tr>';   
				
				foreach($dizi as $eleman)     // scan course id array
				{
					$file = "data/courses.xml";
					$xml = simplexml_load_file($file) ;
					foreach($xml->children() as $course)
					{							
						if(strcmp($eleman , $course['courseId']) == 0)  // determine the course id and print
						{
							echo '<tr>&nbsp;
										<td>'.$course->course_code.'<br></td>
										<td>'.$course->course_name.'<br></td> 
										<td>'.$course['instructorId'].'<br></td> 
								  </tr> ';
						}
								
					}
				}
				
				echo '</table>'; 
						
			}else
				echo $search_word . "&nbsp;&nbsp;&nbsp;  match is not found.";
		
		}		
	}
		
	
?>	
	

<p>&nbsp;</p>
</body>
</html>
