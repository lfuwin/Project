<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/form.css" >
<script type="text/javascript" src="../js/validation.js">  </script>
<script>
function showHint() {
var email = document.getElementById("email").value;
var pwd = document.getElementById("pwd").value;  
if (pwd != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
 var msg = this.responseText;
                document.getElementById("txtHint").innerHTML = msg;
document.getElementById("signal").value = "red";
if (msg=="ok")
{
document.getElementById("signal").value = "green";
}
}
        };
        xmlhttp.open("GET", "getinfo.php?email=" + email+"&pwd="+pwd, true);
        xmlhttp.send();
  
}         
}
</script>

</head>
<body>
<div>
<form action="Products.php" method="POST" onsubmit=" validate_matching();">
<!-- get has to be capital GET , you can change to POST Capital too-->

<!-- adding drop-down lists that reads from user_codes table -->

<div>
    <label for="email">Email</label>
<input type="email" name="email" id="email" onkeyup="showHint()">
</div>
<div>
    <label for="pwd">Password</label>
<input type="password" id="pwd" name="pwd" onkeyup="showHint()">
</div>
<p><span id="txtHint"></span></p>
<input type="hidden" name="signal" id="signal">
<div>
  <input type="submit" value="login" \> 
</div>
</form>
</div>
<form method="post" action="profiles_form.php">
<div>
  <input type="submit" value="Signup" \> 
</div>
</form>
</body>
</html>
