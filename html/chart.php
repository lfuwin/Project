<?php
echo <<<_END
<!DOCTYPE html>
<html lang="en-US">
<head>
<script type="text/javascript" src="../js/loader.js"></script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
_END;
echo <<<_END
// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Record', 'Date'], //header
_END;
  $hn = 'localhost'; //hostname
  $db = 'fecteaul_Project'; //database
  $un = 'fecteaul_ad'; //username
  $pw = 'MyPassword'; //password
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  $query  = "SELECT borrowed_time,count(*) FROM borrow_record group by borrowed_time;";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
    {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
      if($j==($rows-1)){
echo <<<_END
    ['$row[0]', $row[1]]
_END;
      }
      else{
echo <<<_END
    ['$row[0]', $row[1]],
_END;
      }
    }
echo <<<_END
 ]);
  var options = {'title':'Record number in days', 'width':600, 'height':450};
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
</head>
<body>
<h1>Record number in days</h1>
<div id="piechart"></div>
</body>
</html> 
_END;
  $result->close();
  $conn->close();
  
?>
