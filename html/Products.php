<html><head>
<title>Library System</title>
<link href="../css/responsive_page.css" rel="stylesheet" type="text/css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

<style>
body {font-family: arial;}
h1 {margin-left: 20px;
align: center;}
.copy {
	margin-left: 20px; 
	margin-right: 10px;
}
#user_inf{
vertical-align: top;
margin-right: 20px;
}
#logout{
vertical-align: top;
margin-right: 20px;
}
footer { 
 width: 1200px; 
 height: 75px; 
 clear: both; 
 border: solid thin; 
 margin-left: 10px; 
 margin-bottom: 10px; 
 background-color: #efdfec; 
} 
.title {margin-left: 20px;}
#wrapper { width: 1220px;  
margin-right: auto; 
margin-left: auto; 
border: thin solid;  
background-color: #ffc;  
} 
  header { width: 1200px; 
 height: 260px; 
 margin-top: 10px; 
 margin-left: 10px; 
 border: thin solid;  
background-color: #e5dfec; 
 } 
  aside { 
 width: 200px; 
 height: 600px; 
 float: right; 
 margin: 20px 8px 0px 0px; 
 border: solid thin; 
 background-color: #c6d9f1; 
} 
nav { 
 width: 200px; 
 height: 600px; 
 float: left; 
 margin: 20px 14px 0px 10px; 
 text-align: center; 
 border: thin solid; 
 background-color: #fabf8f; 
}
  article { 
width: 770px; 
float: left; 
margin: 20px 0px 20px 0px; 
border: thin solid; 
background-color: #fff; 
} 
</style>

</head>
<body>
<div id="wrapper">

<header><h1>Welcome to the Library!</h1>  
 <img src="../images/libraryicon.png" alt="books" width="150" height="150" style="float: left;"/>
<div id="logout" align="right"> 

<a href="logout.php">Logout</a>
</div>
<div id="user_inf" align="right"> 
<?php
if (!$link = mysql_connect('localhost', 'fecteaul_Project', 'mypassword')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('fecteaul_Project', $link)) {
    echo 'Could not select database';
    exit;
}
$email = $_REQUEST['email'];
session_start();
if($email != ""){
$_SESSION["email_variable"] = $email ; 
}
else if($_SESSION['email_variable'] == ""){
     header("Location: ./login.php");
    exit;
}
$email_variable= $_SESSION['email_variable']; 
$sql    = 'SELECT id, fname, lname, DOB, user_code, email, picture FROM `Profiles` WHERE email = "'.$email_variable.'" ';
$result = mysql_query($sql, $link);
if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mfnameysql_error();
    exit;
}
while ($rs = mysql_fetch_assoc($result)) {
        echo 'Hello '.$rs['fname'];    
        echo "<br>";
        echo '<img height="80" width="80" src="data:image/jpeg;base64,'.base64_encode( $rs['picture'] ).'"/>';
}
?>

<div id="edit_profile" align="right"> 

<a href="edit_profile.php">EditProfile</a>
</div>

</div></header>
<nav><h2>Navigation</h2>
<p><a href="Products.php">Getting started</a></p>
<p><a href="Product1.php">Book search and borrow</a></p>
<?php
if (!$link = mysql_connect('localhost', 'fecteaul_Project', 'mypassword')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('fecteaul_Project', $link)) {
    echo 'Could not select database';
    exit;
}
$sql1    = 'SELECT id, fname, lname, DOB, user_code, email, picture FROM `Profiles` WHERE email = "'.$email_variable.'" ';
$result1 = mysql_query($sql1, $link);
$res = mysql_fetch_assoc($result1);
if($res['user_code']=="3"){
echo '<p><a href="Page2.php">Book add, delete or change state</a></p>';
echo '<p><a href="Page3.php">Pie Chart Of Record Time</a></p>';
}
?>

</nav>

<article>
<h2 class="title">Welcome!</h2>
<p class="copy">
<?php
require('start.php');
?>
</p>
</article>
<aside><h2 class="title">Aside</h2></aside>
<footer><h2 class="title">Footer</h2></footer>


</div>

</body></html>
