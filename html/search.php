<?php
echo <<<_END
<html> <head> 
<link href="../css/table.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/ajax.js"></script>
</head> <body> 
 <form name='ajax' onsubmit='return false;'>
 Search by Title : <input name='ptitle' id='ptitle' type='text' onkeyup='searchtitle();'>
 </form> 
_END;
require_once 'table_div.php';
?>
