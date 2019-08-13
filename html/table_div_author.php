<?php
  $p_author = $_REQUEST['pauthor'];
  $hn = 'localhost'; //hostname
  $db = 'fecteaul_Project'; //database
  $un = 'fecteaul_ad'; //username
  $pw = 'MyPassword'; //password
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) 
      die($conn->connect_error);
echo '<body> <div id="table_ajax"> <table> <thead> <tr> <td>';
echo 'Author </td>  <td> Title</td> <td> Category</td> </tr></thead> <tbody>';
$query1  = "SELECT * FROM books WHERE author like '%$p_author%'";
  $result1 = $conn->query($query1);
  if (!$result1) die($conn->error);
$rows1 = $result1->num_rows;
for ($k = 0 ; $k < $rows1 ; ++$k)
  { echo '<tr>';
    $result1->data_seek($k);
    $row = $result1->fetch_array(MYSQLI_ASSOC);
    echo '<td>'   . $row['author']   . '</td>';
    echo '<td>'    . $row['title']    . '</td>';
    echo '<td>'    . $row['category']    . '</td>';
    echo '</tr>';
  }
 echo '</div> </tbody> </table>'; 
  $result->close();
  $conn->close();
?>
