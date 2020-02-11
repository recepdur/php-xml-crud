<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Courses</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />
<b>List of courses</b>
            <table border="1">
                <tr>
                    <th>Course Code</th> 
					<th>Course Name</th> 
					<th>Instructor</th> 
                    <th>Edit</th>
                    <th>Delete</th>  
                </tr>     	
						
			<?php
				$file = "data/courses.xml";
				$xml = simplexml_load_file($file) ;
				foreach($xml->children() as $course)         // list all course nodes
				{						
				   echo '<tr>&nbsp;
                            <td>'.$course->course_code.'<br></td>
							<td>'.$course->course_name.'<br></td> ';
							
						$file2 = "data/instructors.xml";
						$xml2 = simplexml_load_file($file2) ;
						foreach($xml2->children() as $data2)
						{
						    if(strcmp($data2['instructorId'] , $course['instructorId']) == 0  )
								echo "<td>".$data2."<br></td>"; 
						}

					echo	' 
							<td><a href="editcourse.php?cid='.$course['courseId'].'" title="Edit">Edit</a></td>
                            <td><a href="delcourse.php?cid='.$course['courseId'].'"  title="Delete">Delete</a></td>
                        </tr> ';
					
				}
			?>
			
			
			</table> 


                
                               
                                         
            
<p>&nbsp;</p>
</body>
</html>