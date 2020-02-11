<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Instructors</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr/>
<b>List of instructors</b>
            <table border="1">
			
                <tr>
                    <th>Instructor</th> 
                    <th>Edit</th> 
                    <th>Delete</th> 
                </tr>      
                
		<?php
			$file = "data/instructors.xml";
			$xml = simplexml_load_file($file) ;
			foreach($xml->children() as $data)              // list all of instructors
			{	
			   echo "<tr>&nbsp;
                         <td>" . $data . "<br></td> 
                         <td><a href="."editinstructor.php?iid=". $data['instructorId'] ." title=Delete".">Edit</a></td>
                         <td><a href="."delinstructor.php?iid=" . $data['instructorId'] ." title=Delete".">Delete</a></td>
                    </tr> " ; 
			}
		?>	
                                                                                            
                                         
            </table> 
			
			
</body>
</html>
