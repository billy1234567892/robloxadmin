<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>RokianStats II</title>
<link rel="shortcut icon" href="/RMLogo.ico" >
<script type="text/javascript">
    function updateTextInput(val) {
      document.getElementById('textInput').value=val+" PP"; 
    }
</script>
</head>
<body id='blur'>
<img src="RM1.png" alt="" id="blurpic" style="width:100%;max-width:400px">
<?php
session_start();
$userName = $_POST["username"];
$passWord = $_POST["password"];
$submitted = $_POST["submitted"];
if($submitted=="true"){
$_SESSION["username"] = $userName;
$_SESSION["password"] = $passWord;
mail("example@example.com","RokianStats","Someone attempted to sign in with username '" . $userName . "' on " . date('n\/j\/Y \a\t g:i a T'));
}
else{
$passWord= $_SESSION["password"];
}
$con=mysqli_connect("127.0.0.1","496400","password","496400");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
$sql="SELECT * FROM members WHERE password='$passWord'";
$passOrNo=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($passOrNo)) {
if($row['password']==$_SESSION["password"] and strtolower($row['username'])==strtolower($_SESSION["username"]))
{
$ok = true;
$securitylvl = 1;
}
}
}
?>
<br/><br/><br/>
<h2><?php
if($ok==true){
echo("DATABASE BACKUP");}
else{
echo("You do not have access to this page");
}
?>
</h2>
<?php echo("<a href='http://www.roblox.com/User.aspx?username=" . $_SESSION['username'] . "'><img id='char' src='http://www.roblox.com/Thumbs/Avatar.ashx?x=100&y=100&format=png&username=" . $_SESSION['username'] . "'></img></a>"); ?>
<hr>
<?php
if ($ok==true){
echo("Manual updates only");
echo("<br/><div id='header'><br/>
<a href='Process2.php' class='logbutton'>Refresh</a> | <a href='Log.php' class='logbutton'>Back</a> | <a id='logout' href='Google.php' class='logbutton'>Logout</a>");
echo("<br/><p></p></div><br/>");
    if ($ok==true and $securitylvl>1) {
echo("<b>ADD/EDIT ENTRY:</b>");
echo("<br/><small>Remember, your actions will be logged.</small><br/>");
echo("<form action='Submit.php' method='post'><input type='text' name='username' placeholder='Full Username'/><br/>");

if ($ok==true and $securitylvl==2) {
echo("<input type='range' name='pp' min='-5' max='5' value='0' onmousemove='updateTextInput(this.value);'><input type='text' style='width: 40px;' id='textInput' value='0 PP' readonly='true'><br/><br/>");
}
if ($ok==true and $securitylvl==3) {
echo("<input type='number' name='pp' placeholder='Amount of RCs to add'><br/>");
}

echo("<input type='submit' /></form>");
}
$sql="SELECT * FROM rokians ORDER BY username";
$result=mysqli_query($con,$sql);
echo("<b>CURRENT BACKUP ENTRIES:</b><br/><small>Alphabetical Order</small><br/>");
$count = 0;
echo("<table style='width:500px'>496400
  <th>RC</th>
  <th>Username</th>
  <th>Last Change Date/Time (EST)</th>
  <th>Last Changer</th>
</tr>");
while($row = mysqli_fetch_array($result)) {
$count = $count+1;
  echo("<tr><td>" . $row['pp'] . "</td>" . "<td>" . "<a id='a' title='Person with the RCs' href='http://www.roblox.com/User.aspx?username=" . $row['username'] . "'>" . $row['username'] . "</a>" . "</td>" . "<td>" . $row['mostrecentchangetime'] . "</td>" . "<td>" . "<a id='a' title='Last Changer' href='http://www.roblox.com/User.aspx?username=" . $row['mostrecentchanger'] . "'>" . $row['mostrecentchanger'] . "</a>" . "</td>" . "</tr>");
}
echo("</table>");
echo('<br/><b>' . $count . ' total entries</b><br/>');


}
else{
$_SESSION["password"]="";
echo("<a href='Google.php'>Back</a><br/><br/>Wrong password.<br/><br/>Remember to use exact capitalization<br/>for both username and password.");
}
?>

</body>
</html>