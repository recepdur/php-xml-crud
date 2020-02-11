
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Instructors</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />
<p><b>Edit Instructor</b> </p>

	<?php
	$xml = simplexml_load_file("data/instructors.xml") ;
	foreach($xml->children() as $data)
		if($_GET['iid'] == $data['instructorId'])               // determine the id in xml file 
		{
			echo '
				<form id="form1" name="form1" method="post" action="saveinstructor.php?iid='. $data['instructorId'] . '">
					<label for="instructor"></label>
					<input type="text" name="instructor-name" id="instructor" value="' . $data .'"/>
					<input type="submit" name="button" id="button" value="Save Instructor" />
				</form>
				';			
		}			
		
	?>
	


<p>&nbsp;</p>

				

</body>
</html>
