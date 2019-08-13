<?php
if (!$link = mysql_connect('localhost', 'fecteaul_Project', 'mypassword')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('fecteaul_Project', $link)) {
    echo 'Could not select database';
    exit;
}
$sql    = 'SELECT MAX(record_id) as record_id FROM borrow_record';
$result = mysql_query($sql, $link);
if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mfnameysql_error();
    exit;
}
//print the return record from table
while ($row = mysql_fetch_assoc($result)) {
    $record_id= $row['record_id'] ;
}
$record_id= $record_id+ 1;
mysql_free_result($result);
?>

<?php
 session_start();
 $isbn= $_REQUEST['isbn'];
 $email= $_SESSION['email_variable'];
if (!$link = mysql_connect('localhost', 'fecteaul_Project', 'mypassword')) {
    echo 'Could not connect to mysql';
    exit;
}
if (!mysql_select_db('fecteaul_Project', $link)) {
    echo 'Could not select database';
    exit;
}

$sql_insert = "INSERT INTO borrow_record(record_id, borrower_email, isbn, borrowed_time)
VALUES (".$record_id.",'".$email."','".$isbn."', STR_TO_DATE(CURDATE(), '%Y-%m-%d'))"; 
$result1 = mysql_query($sql_insert , $link);
if (!$result1) {
    echo "DB Error, could not insert into the database\n";
    echo 'MySQL Error: ' . mfnameysql_error();
    exit;
}
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
$sql_change = "UPDATE books SET borrowed ='YES' WHERE isbn = '$isbn' ";
$result2 = mysql_query($sql_change , $link);
if (!$result2) {
    echo "DB Error, could not update into the database\n";
    echo 'MySQL Error: ' . mfnameysql_error();
    exit;
}
 header("Location: ./product1.php");
    $link->commit();
?>
