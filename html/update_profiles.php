
<?php
session_start();
if (!$link = mysql_connect('localhost', 'fecteaul_Project', 'mypassword')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('fecteaul_Project', $link)) {
    echo 'Could not select database';
    exit;
}
$sql    = 'SELECT MAX(id) as id FROM Profiles';
$result = mysql_query($sql, $link);
if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mfnameysql_error();
    exit;
}
//print the return record from table
while ($row = mysql_fetch_assoc($result)) {
    $id = $row['id'] ;
}
$id = $id + 1;
mysql_free_result($result);
?>

<?php
// get all elements that have been sent by form,
$fname = $_REQUEST['fname'];
$dob = $_REQUEST['dob'];
$lname = $_REQUEST['lname'];
//adding email and password
$email = $_SESSION['email_variable'];
$pwd = $_REQUEST['pwd'];
//echo $email;
$user_code = $_REQUEST['user_code'];
//echo $user_code;
 $link = new mysqli('localhost', 'fecteaul_Project', 'mypassword', 'fecteaul_Project');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
if(isset($_FILES['picture1'])) {
    // Make sure the file was sent without errors
    if($_FILES['picture1']['error'] == 0) {
        // Connect to the database
       
 
        // Gather all required data
        $name = $link->real_escape_string($_FILES['picture1']['name']);
        $mime = $link ->real_escape_string($_FILES['picture1']['type']);
        $data = $link ->real_escape_string(file_get_contents($_FILES  ['picture1']['tmp_name']));
        $size = intval($_FILES['picture1']['size']);
//echo $data; 
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['picture1']['error']);
    }
 
    
}
else {
    echo 'Error! A file was not sent!';
}
$link->close();
?>







<?php
if (!$link = mysql_connect('localhost', 'fecteaul_Project', 'mypassword')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('fecteaul_Project', $link)) {
    echo 'Could not select database';
    exit;
}
//STR_TO_DATE('22,3,1990', '%d,%m,%Y')
    $hn = 'localhost'; //hostname
    $db = 'fecteaul_Project'; //database
    $un = 'fecteaul_ad'; //username
    $pw = 'MyPassword'; //password
    $conn = new mysqli($hn, $un, $pw, $db);
if($fname!=""){
    $stmt= $conn->prepare("UPDATE Profiles SET fname=? WHERE email='$email'");
    $stmt->bind_param('s',$fname); 
    if($stmt->execute()){
    }
}
if($lname!=""){
    $stmt= $conn->prepare("UPDATE Profiles SET lname=? WHERE email='$email'");
    $stmt->bind_param('s',$lname); 
    if($stmt->execute()){
    }
}
    $stmt= $conn->prepare("UPDATE Profiles SET DOB =? WHERE email='$email'");
    $stmt->bind_param('s',$dob); 
    if($stmt->execute()){
    }
    $stmt= $conn->prepare("UPDATE `Profiles` SET `picture` = ? WHERE email='$email'");
    $stmt->bind_param('b',$data); 
    if($stmt->execute()){
    }
if($pwd!=""){
    $stmt= $conn->prepare("UPDATE Profiles SET password=? WHERE email='$email'");
    $stmt->bind_param('s',$pwd); 
    if($stmt->execute()){
    }
}
    echo "successfully sign up, jump to login page in 3 seconds\n";
    header('Refresh: 3; url=login.php');
    $link->commit();
?>
