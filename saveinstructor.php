
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

if(isset($_POST['instructor-name']))
{
	$input = $_POST['instructor-name'];
	if($input != "")
	{
		$file = "data/instructors.xml";
		$fp = fopen($file, "rb") or die("cannot open file");      // open file and create new element
		$str = fread($fp, filesize($file));		
		$dom = new DOMDocument();
		$dom->formatOutput = true;
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($str) or die("Error"); 
		$root   = $dom->documentElement;		
				
		$i=0;
		$xml = simplexml_load_file($file) ;
		foreach($xml->children() as $data)				// scan it and determine the index of node
		{	
			if($_GET['iid'] == $data['instructorId'])			
				$ins_id = $i;
	
			$i++;
		}			
		
		$oldnode = $root->childNodes->item($ins_id);
		$instructor    = $dom->createElement('instructor',$input);
		$insAttribute  = $dom->createAttribute('instructorId');
		$insAttribute->value = $_GET['iid'];         // assign id
		$instructor->appendChild($insAttribute);		
		$root->replaceChild($instructor,$oldnode);    // replade node
				
		$dom->save($file) or die("Error");				
		echo "Instructor edited successfully";
	}	
}
?>


</body>
</html>
