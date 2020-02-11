<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Course</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />
<form id="form1" name="form1" method="post" action="addcourse.php">
  <p>Course Code: 
    <label for="course-code"></label>
  <input type="text" name="course-code" id="course-code" />
  </p>
  <p>Course Name: 
    <label for="Course Name"></label>
    <input type="text" name="course-name" id="course-name" />
  </p>
  <p>Instructor: 
    <label for="instructor-id"></label>
    <select name="instructor-id" id="instructor-id">	
	<?php
	$xml = simplexml_load_file("data/instructors.xml") ;
	foreach($xml->children() as $data)
	{
		echo ' <option value="'. $data['instructorId'] .'">'. $data.'</option>'; 
	}
	?>           	                   	
    </select>
  </p>
  
  <p>
    <input type="submit" name="add-course" id="add-course" value="Add Course" />
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>

<?php

if(isset($_POST['course-code']) && isset($_POST['course-name']) && isset($_POST['instructor-id']))
{
	$ccode = $_POST['course-code'];
	$cname = $_POST['course-name'];
	$ins_id = $_POST['instructor-id'];
	
	if($ccode != "" && $cname != "")   // i check the input
	{
		$file = "data/courses.xml";
		$fp = fopen($file, "rb") or die("cannot open file");   // open xml file
		$str = fread($fp, filesize($file));			
		$dom = new DOMDocument('1.0', "utf-8");
		$dom->formatOutput = true;
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($str) or die("Error");        //  Loads an XML document from a string. 
		
		$root = $dom->documentElement;		
		
		$course_code    = $dom->createElement('course_code',$ccode);    // create nodes
		$course_name    = $dom->createElement('course_name',$cname);

		$course = $dom->createElement("course");
		$cAttribute1  = $dom->createAttribute('courseId');
		
		$courseid=0;
		$xml = simplexml_load_file($file) ;           // add the courseId
		foreach($xml->children() as $data)
			$courseid = $data['courseId'];				// scan all id in xml than add new id
		$cAttribute1->value = $courseid+1 ; 
		
		$cAttribute2  = $dom->createAttribute('instructorId');	
		$cAttribute2->value = $ins_id ;		
		$course->appendChild($cAttribute1);
		$course->appendChild($cAttribute2);
		
		$course->appendChild($course_code);
		$course->appendChild($course_name);
		
		$root->insertBefore($course);     			// add the node in root 
		
		$dom->save($file) or die("Error");   // save

		echo $ccode . " added successfully";
		
	}

	
}

?>