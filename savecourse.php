<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Instructors</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />

<?php

	if(isset($_POST['course-code']) && isset($_POST['course-name']) && isset($_POST['instructor-id']))
	{
		$ccode  = $_POST['course-code'];
		$cname  = $_POST['course-name'];
		$ins_id = $_POST['instructor-id'];
			
		$file = "data/courses.xml";
		$fp = fopen($file, "rb") or die("cannot open file");
		$str = fread($fp, filesize($file));			
		$dom = new DOMDocument('1.0', "utf-8");
		$dom->formatOutput = true;
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($str) or die("Error"); 
		$root   = $dom->documentElement;
		
		$i=0;
		$xml = simplexml_load_file($file) ;
		foreach($xml->children() as $data)			// determine index of replacing node
		{
			if($_GET['cid'] == $data['courseId'])
				$c_id = $i;	
				
			$i++;
		}
		
		$oldnode = $root->childNodes->item($c_id);				
		$course_code    = $dom->createElement('course_code',$ccode);         // create element
		$course_name    = $dom->createElement('course_name',$cname);
		$course = $dom->createElement("course");
		$cAttribute1  = $dom->createAttribute('courseId');
		$cAttribute1->value = $_GET['cid'] ; 		
		$cAttribute2  = $dom->createAttribute('instructorId');	
		$cAttribute2->value = $ins_id ;		
		
		$course->appendChild($cAttribute1);
		$course->appendChild($cAttribute2);		
		$course->appendChild($course_code);
		$course->appendChild($course_name);
		
		$root->replaceChild($course,$oldnode);          // replace nodes
		
		$dom->save($file) or die("Error");
		
		echo "Course edited successfully";	
				
	}

?>




</body>
</html>