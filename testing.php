<html>
<head>
<title>GetRank</title>
</head>
<body>
<?php
$username="noobkilervip";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.roblox.com/User.aspx?UserName=".$username);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$a = curl_exec($ch);
$l=false;
if(preg_match('#Location: (.*)#', $a, $r))
$l = trim($r[1]);
if ($l){
$l = intval(substr($l, 14));
}


curl_setopt($ch, CURLOPT_URL, "http://www.roblox.com/Game/LuaWebService/HandleSocialRequest.ashx?method=GetGroupRole&playerid=". $l ."&groupid=1035601");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$rank = curl_exec($ch);
echo $rank;

?>
</body>
</html>