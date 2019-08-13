<?php 
  echo <<<_END
    <link href="../css/table.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/checkboxes.js"></script>
_END;
   $hn = 'localhost'; //hostname
   $db = 'fecteaul_Project'; //database
   $un = 'fecteaul_ad'; //username
   $pw = 'MyPassword'; //password
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
if (isset($_POST['update_button'])) {
    $checked1 = $_POST['delete'];
for($knt=0; $knt < count($checked1); $knt++){
    $isbn1   = get_post($conn, 'isbn');
$query1  = "SELECT * FROM books WHERE isbn = '$checked1[$knt]'";
  $result1 = $conn->query($query1);
  if (!$result1) die($conn->error);
$row1 = $result1->fetch_array(MYSQLI_ASSOC);
    $brw1 = $row1['borrowed'];
    If($brw1 == "NO"){
        $query1  = "UPDATE books SET borrowed = 'YES'  WHERE isbn='$checked1[$knt]'";
    }
    else{
        $query1  = "UPDATE books SET borrowed = 'NO'  WHERE isbn='$checked1[$knt]'";
    }
    
    $result1 = $conn->query($query1);
  	if (!$result1) echo "UPDATE failed: $query1<br>" .
      $conn->error . "<br><br>";
}
}
else if (isset($_POST['delete_button'])) {
    $checked = $_POST['delete'];
for($i=0; $i < count($checked); $i++){
    $isbn   = get_post($conn, 'isbn');
    $query  = "DELETE FROM books WHERE isbn='$checked[$i]'";
    $result = $conn->query($query);
  	if (!$result) echo "DELETE failed: $query<br>" .
      $conn->error . "<br><br>";
}
} else {
    //no button pressed
}
  if (isset($_POST['author'])   &&
      isset($_POST['title'])    &&
      isset($_POST['category']) &&
      isset($_POST['year'])     &&
      isset($_POST['isbn'])     &&
      isset($_POST['borrowed']))
  {
    $author   = get_post($conn, 'author');
    $title    = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year     = get_post($conn, 'year');
    $isbn     = get_post($conn, 'isbn');
    $borrowed = get_post($conn, 'borrowed');
    $query    = "INSERT INTO books VALUES" .
      "('$author', '$title', '$category', '$year', '$isbn', '$borrowed')";
    $result   = $conn->query($query);
  	if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }
  echo <<<_END
  <form action="Page2.php" method="post"><pre>
    Author <input type="text" name="author">
     Title <input type="text" name="title">
  Category <input type="text" name="category">
      Year <input type="text" name="year">
      ISBN <input type="text" name="isbn">
  Borrowed <input type="text" name="borrowed">
           <input type="submit" value="ADD RECORD">
  </pre></form>
_END;
  echo <<<_END
  <form action="Page2.php" method="post">
  <input type="submit" value="DELETE RECORD" name="delete_button">
  <input type="submit" value="Change Borrowed State" name="update_button">
  <table>
  <thead>
    <th>Author</th>
    <th>Title</th> 
    <th>Category</th>
    <th>Year</th> 
    <th>ISBN</th>
    <th>Borrowed</th>
    <th><input type="checkbox" onClick="javascript:check_all(this)" /></th>
  </thead>
_END;
  $query  = "SELECT * FROM books";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
  echo <<<_END
  <tr>
    <td><pre>$row[0]</pre></td>
    <td><pre>$row[1]</pre></td>
    <td><pre>$row[2]</pre></td>
    <td><pre>$row[3]</pre></td>
    <td><pre>$row[4]</pre></td>
    <td><pre>$row[5]</pre></td>
    <td><input type="checkbox" name="delete[]" value="$row[4]"></td>
    <input type="hidden" name="isbn[]" value="$row[4]">
  </tr>
_END;
  }
  echo <<<_END
  </table>
  </form>
_END;
$query  = "SELECT * FROM borrow_record";
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
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
