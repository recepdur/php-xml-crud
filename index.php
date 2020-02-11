<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
</head>

<body>
<p><a href="index.php">Search</a> | <a href="addinstructor.php">Add Instructor</a> | <a href="listinstructor.php">List Instructors</a> | <a href="addcourse.php">Add Course</a> | <a href="listcourse.php">List Courses</a></p>
<hr />

<form id="form1" name="form1" method="post" action="searchi.php">
  <p>
    <label for="keyword"></label>
    <input type="text" name="searchinstructor" id="keyword" />
    <input type="submit" name="search" id="search" value="Search Instructor" />
  </p>
</form>

<form id="form2" name="form2" method="post" action="searchc.php">
  <label for="keyword3"></label>
  <input type="text" name="searchcourse" id="keyword3" />
  <input type="submit" name="search2" id="search2" value="Search Course" />
</form>
<p>&nbsp;</p>
</body>
</html>
