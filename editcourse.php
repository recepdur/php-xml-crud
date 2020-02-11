<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Instructors</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />
<p><b>Edit Course</b>
 </p>
 
 <?php

	$xml = simplexml_load_file("data/courses.xml") ;
	foreach($xml->children() as $course)
		if($_GET['cid'] == $course['courseId'])     // check course id and determane it
		{
			   echo ' 
				    <form id="form1" name="form1" method="post" action="savecourse.php?cid=' .$course['courseId']. '">
						<p>
							<label for="course"></label>
						Course Code:
						<input type="text" name="course-code" id="coursecode" value="'.$course->course_code.'"/>
						</p>
						
						<p>Course Name: 
							<input type="text" name="course-name" id="coursename" value="'.$course->course_name.'"/>
						</p>
						
						<p>Instructor:
						<select name="instructor-id" id="instructor-id"> ';
						
						$xml = simplexml_load_file("data/instructors.xml") ;         //  add all instructor name in html select
						foreach($xml->children() as $data)
						{
							echo ' <option value="'. $data['instructorId'] .'">'. $data.'</option>'; 
						}
						  echo '							     
						</select> 
						</p>
								
						<p>
							<input type="submit" name="button" id="button" value="Save Course" />
						</p>
						
					</form>';
					
		}	
	
?>	
 

<p>&nbsp;</p>
</body>
</html>