<?php
  session_start();
  $p_title = $_REQUEST['ptitle'];
  $hn = 'localhost'; //hostname
  $db = 'fecteaul_Project'; //database
  $un = 'fecteaul'; //username
  $pw = 'MyPassword'; //password
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) 
      die($conn->connect_error);
$query  = "SELECT * FROM books WHERE title like '%$p_title%'";
  $result = $conn->query($query);
  if (!$result) die($conn->error);
$rows = $result->num_rows;
echo '<body> <div id="table_ajax"> <table> <thead> <tr> <td>';
echo 'Author </td>  <td> Title</td> <td> Category</td> </tr></thead> <tbody>';
for ($j = 0 ; $j < $rows ; ++$j)
  { echo '<tr>';
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo '<td>'   . $row['author']   . '</td>';
    echo '<td>'    . $row['title']    . '</td>';
    echo '<td>'    . $row['category']    . '</td>';
    $borrow_state= $row['borrowed'] ;
If($borrow_state=="NO"){
    echo '<td>'    . 
    '<form name="form" action="borrow.php" method="get">
    <input type="submit" name="submit" id="submit" value="Borrow This Book">
    <input type="hidden" name="isbn" id="isbn" value=' . $row['isbn'] .'>
    </form>'   
 . '</td>';
}
    echo '</tr>';
  }
 echo '</div> </tbody> </table>'; 
 echo 'Your borrow record: <br>'; 
$email=$_SESSION['email_variable'];
$query  = "SELECT * FROM borrow_record WHERE borrower_email='$email'";
  $result = $conn->query($query);
  if (!$result) die($conn->error);
$rows = $result->num_rows;
echo '<body> <div id="table_ajax"> <table> <thead> <tr> <td>';
echo 'Record Number </td>  <td> Borrower Email</td> <td> ISBN</td> <td> Borrowed Time</td> </tr></thead> <tbody>';
for ($j = 0 ; $j < $rows ; ++$j)
  { echo '<tr>';
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo '<td>'   . $row['record_id']   . '</td>';
    echo '<td>'    . $row['borrower_email']    . '</td>';
    echo '<td>'    . $row['isbn']    . '</td>';
    echo '<td>'    . $row['borrowed_time']    . '</td>';
    echo '</tr>';
  }
 echo '</div> </tbody> </table>'; 
  $result->close();
  $conn->close();
?>
