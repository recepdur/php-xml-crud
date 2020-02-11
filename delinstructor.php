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
	
		/** delete course**/
		
	$file2 = "data/courses.xml";
	$fp2 = fopen($file2, "rb") or die("cannot open file");       // open courses.xml file
	$str2 = fread($fp2, filesize($file2));			
	$dom2 = new DOMDocument('1.0', "utf-8");
	$dom2->formatOutput = true;
	$dom2->preserveWhiteSpace = false;
	$dom2->loadXML($str2) or die("Error"); 
	$root2   = $dom2->documentElement;
		
	$j=0;
	$rdizi = array();     						  // add all course belong the same instructor
	$xml2 = simplexml_load_file($file2) ;
	foreach($xml2->children() as $data2)             // check course id and determine it's index
	{
		if($_GET['iid'] == $data2['instructorId'])
		{
			$rdizi[] = $root2->childNodes->item($j);	      // determine remove node add array
		}
		$j++;
	}
	
	foreach($rdizi as $rnode2)
	{
		$root2->removeChild($rnode2);						  // remove all array
		$dom2->save($file2) or die("Error");    			 // save file
	}
	
	
	/** delete instructor **/
	
	$file = "data/instructors.xml";
	$fp = fopen($file, "rb") or die("cannot open file");    // open instructors.xml file
	$str = fread($fp, filesize($file));			
	$dom = new DOMDocument('1.0', "utf-8");
	$dom->formatOutput = true;
	$dom->preserveWhiteSpace = false;
	$dom->loadXML($str) or die("Error"); 	
	$root = $dom->documentElement;
		
	$i=0;
	$xml = simplexml_load_file($file);
	foreach ($xml->children() as $data)         //  check instructor id and determine it's index
	{
		if($_GET['iid'] == $data['instructorId'])		
			$ins_id = $i;		
	
		$i++;
	}	
	
	$rnode = $root->childNodes->item($ins_id);	   // determeni the remove node
	$root->removeChild($rnode);					// remove node
	$dom->save($file) or die("Error");
	
	echo "Instructor deleted successfully";
	
	?>
	
               
</body>
</html>