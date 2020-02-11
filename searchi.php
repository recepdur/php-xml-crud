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
	
	if(isset( $_POST['searchinstructor']))
	{
		$search_word = $_POST['searchinstructor'];
		if($search_word != "")
		{
			$dizi=array();
			$sorgu=false;
			$file = "data/instructors.xml";
			$xml = simplexml_load_file($file);
			foreach($xml->children() as $data)
				if(stristr($data, $search_word) == true)       // compare the search word with all nodes
				{
					$dizi[]=$data;       // add it
					$sorgu=true;
				}
			
			if($sorgu == true)      // if search word in there
			{
				echo "Search Word: &nbsp;&nbsp;". $search_word ."<br/>";
				echo "Search Result: <br/>";
				echo '<table border="2">
						<tr>
							<th>Instructor</th> 
						</tr>  ';
						
				foreach($dizi as $eleman)        // print all array
					 echo "<tr>&nbsp;
								<td>" . $eleman . "<br></td> 
                           </tr> " ; 	
					
				echo "</table>";
				
			}else
				echo $search_word . "&nbsp;&nbsp;&nbsp;  match is not found.";
		
		}		
	}
		
	
?>	
	

<p>&nbsp;</p>
</body>
</html>
