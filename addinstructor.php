<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Instructor</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />
<form id="form1" name="form1" method="post" action="addinstructor.php">
  <p>Instructor Name:
     <label for="instructor-name"></label>
     <input type="text" name="instructor-name" id="instructor-name" />
  </p>
  <p>
     <input type="submit" name="add-instructor" id="add-instructor" value="Add Instructor" />
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>

<?php

if(isset($_POST['instructor-name'])) // check input
{
	$input = $_POST['instructor-name'];
	if($input != "")		// check input
	{
		$file = "data/instructors.xml";
		$fp = fopen($file, "rb") or die("cannot open file"); // open file
		$str = fread($fp, filesize($file));			
		$dom = new DOMDocument('1.0', "utf-8");
		$dom->formatOutput = true;
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($str) or die("Error"); 
		
		$root = $dom->documentElement;		
		$instructor    = $dom->createElement('instructor',$input);  // create nodes
		$insAttribute  = $dom->createAttribute('instructorId');
		
		
		$id=0;
		$xml = simplexml_load_file($file) ;           // add the instructorId
		foreach($xml->children() as $data)            // firstly check all id than add
			$id = $data['instructorId'];			
		$insAttribute->value = $id+1 ;      	
		
		
		$instructor->appendChild($insAttribute);
		$root->insertBefore($instructor);         // add the root all of nodes
		$dom->save($file) or die("Error");

		echo $input . " added successfully";		
	}
	
}

?>