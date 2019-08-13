<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/form.css" >
<script src="../js/validation.js">  </script>
</head>
<body>
<form action="insert_into_profiles.php" onsubmit="return validate_password()" method="post" enctype="multipart/form-data">
<!-- get has to be capital GET , you can change to POST Capital too-->
<div>
<label for="fname">First Name</label> 
 <input type="text"  required name="fname"><br>
</div>  
<div>
<label for="Lname">Last Name</label> 
<input type="text" required name="lname"><br>
</div>  

<!-- adding drop down lists that reads from user_codes table -->

<?php
if (!$link = mysql_connect('localhost', 'fecteaul_Project', 'mypassword')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('fecetaul_Project', $link)) {
    echo 'Could not select database';
    exit;
}
$sql    = 'SELECT user_code, user_description FROM user_codes';
$result = mysql_query($sql, $link);
if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mfnameysql_error();
    exit;
}
echo '<div> <label for="user_code">User_code</label>  ';
$select= '<select name="user_code">';
while ($rs = mysql_fetch_assoc($result)) {
      $select.='<option value="'.$rs['user_code'].'">'.$rs['user_description'].'</option>';
}
$select.='</select> </div>';
echo $select;
?>
<br>

<!-- adding file to browse the picture -->

<div>
    <label for="dob">Date of Birth</label>
   

 <input type="date" name="dob">
</div>
<br>
<div>
    <label for="email">Email</label>
<input type="email" name="email">

</div>
<div>
    <label for="pwd">Password</label>
<input type="password" id="pwd" name="pwd">

</div>
<div>
    <label for="cpwd">Confirm password</label>
<input type="password" id="cpwd" name="cpwd">

</div>


<div>
    <label for="picture">Profile picture</label>
 
<input type="file" required name ="picture" accept="image/*">
</div>


  <input type="submit" value="Submit" >
</form>
</div>
</body>
</html>
