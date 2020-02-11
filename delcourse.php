
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Instructors</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />


<?php

		$file = "data/courses.xml";
		$fp = fopen($file, "rb") or die("cannot open file");       // open file
		$str = fread($fp, filesize($file));			
		$dom = new DOMDocument('1.0', "utf-8");
		$dom->formatOutput = true;
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($str) or die("Error"); 
		$root   = $dom->documentElement;
		
		$i=0;
		$xml = simplexml_load_file($file) ;
		foreach($xml->children() as $data)             // check course id and determine it's index
		{
			if($_GET['cid'] == $data['courseId'])
				$c_id = $i;	
				
			$i++;
		}
		
		$rnode = $root->childNodes->item($c_id);	      // determine remove node
		$root->removeChild($rnode);						  // remove it
		$dom->save($file) or die("Error");

		echo "Course deleted successfully";	


?>


               
</body>
</html>
