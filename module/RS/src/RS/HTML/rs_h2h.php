<?php
echo "<!DOCTYPE html>
<html>
<head>
<style> 
html {font-size:14px;
font-family: Calibri, Candara, Segoe, Arial, sans-serif; 
}
table,th,td
{
border:1px solid #ccc;
text-align:center; 
vertical-align:middle;
}
.W { color: #2c6152; background-color: #c6efce; }
.L { color: #cf2c06; background-color: #ffc7ce;}
.D { color: #be6500; background-color: #ffeb9c; }
.odd { background-color: #eee; }
caption { font-size: 120%; }
.small {text-transform:uppercase; font-size:60%;}
.frborder { border-right:thick ridge #ccc; }
.flborder { border-left:thick ridge #ccc; }
.minwidth { width:16px; }
</style>
</head>
<body>";

$team1 = getGetVar("team1");
$team2 = getGetVar("team2");

showTeamSelect($team1, $team2);

if(!(isset($team1) && is_numeric($team1) && isset($team2) && is_numeric($team2)))
{
 die();
}
$matches = getTeamMatches($team1,$team2);
if($team1==$matches[0]['hometeamid']) {
	$team1name = $matches[0]['hometeam'];
	$team2name = $matches[0]['awayteam'];
} else {
	$team2name = $matches[0]['hometeam'];
	$team1name = $matches[0]['awayteam'];
}

echo "<table cellspacing='0'><caption>Head2Head $team1name Vs $team2name</caption>";
echo "<thead><tr><th>Season</th><th>date</th><th>Match</th><th>Result</th></thead><tbody>";
$agghome = 0;
$aggaway = 0;
foreach($matches as $match)
{
	if($team1==$match['hometeamid']) $home=true;
	echo "<tr><td>{$match['season']}</td>";
	echo "<td>{$match['date']}</td>";
	if($home) 
	echo "<td><b>{$match['hometeam']}</b> - {$match['awayteam']}</td>";
	else
	echo "<td>{$match['hometeam']} - <b>{$match['awayteam']}</b></td>";
	if($home) {
		$class = $match['resulthome'];
		$agghome += $match['goalshome'];
		$aggaway += $match['goalsaway'];
		$resultsHome[] = array($match['goalshome'],$match['goalsaway']);
	}else{
		$class = $match['resultaway'];		
		$agghome += $match['goalsaway'];
		$aggaway += $match['goalshome'];
		$resultsAway[] = array($match['goalshome'],$match['goalsaway']);
	}
	echo "<td class='$class'>{$match['goalshome']}-{$match['goalsaway']}</td>";
	$home = false;
}
$aggresult = getResultByGoals($agghome, $aggaway);
echo "<tr><td colspan='3' style='text-align:right;'>Aggregate:</td><td class='$aggresult'>$agghome - $aggaway</td></tr>";
$avghome = round($agghome / count($matches),1);
$avgaway = round($aggaway / count($matches),1);
echo "<tr><td colspan='3' style='text-align:right;'>Avg:</td><td class='$aggresult'>$avghome - $avgaway</td></tr>";
foreach($resultsHome as $rHome) {
	$rhgoalsHome += $rHome[0];
	$rhgoalsAway += $rHome[1];
}
$avghomeOnlyhome = round($rhgoalsHome / count($resultsHome ),1);
$avghomeOnlyaway = round($rhgoalsAway / count($resultsHome ),1);
$avghomeOnlyresult = getResultByGoals($avghomeOnlyhome,$avghomeOnlyaway);
echo "<tr><td colspan='3' style='text-align:right;'>Avg Home:</td><td class='$avghomeOnlyresult'>$avghomeOnlyhome - $avghomeOnlyaway</td></tr>";
foreach($resultsAway as $rAway) {
	$ragoalsHome += $rAway[0];
	$ragoalsAway += $rAway[1];
}
$avgawayOnlyhome = round($ragoalsHome / count($resultsAway),1);
$avgawayOnlyaway = round($ragoalsAway / count($resultsAway),1);
$avgawayOnlyresult = getResultByGoals($avgawayOnlyaway,$avgawayOnlyhome);
echo "<tr><td colspan='3' style='text-align:right;'>Avg Away:</td><td class='$avgawayOnlyresult'>$avgawayOnlyhome - $avgawayOnlyaway</td></tr>";
echo "</tbody></table>"; 

function getResultByGoals($home, $away)
{
	if($home> $away) {
		return 'W';
	}else if ($home < $away) {
		return 'L';
	} else {
		return 'D';
	}
}

function getTeamMatches($team1, $team2) 
{
	$link = mysql_connect('localhost', 'triion_rs', '?wpT5]^k*Dkf');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('triion_rs');
	
	$query = sprintf("SELECT * FROM matches WHERE (hometeamid=%d AND awayteamid=%d) OR (hometeamid=%d AND awayteamid=%d) ORDER BY date DESC",$team1,$team2,$team2,$team1);
	//echo $query;
	$result = mysql_query($query);
	$matches = array();
	while($row = mysql_fetch_assoc($result))
	{
		$matches[] = $row;
	}
	return $matches;
}

function getGetVar($name) {
	if(isset($_GET[$name]) && is_numeric($_GET[$name]))
	{
		return htmlspecialchars($_GET[$name]);
	}
	return "";
}

function showTeamSelect($selectedTeam1, $selectedTeam2)
{
	$link = mysql_connect('localhost', 'triion_rs', '?wpT5]^k*Dkf');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('triion_rs');
	
	$query = "SELECT teamid, teamname FROM results GROUP BY(teamid) ORDER BY teamname ASC";
	//echo $query;
	$result = mysql_query($query);
	$matches = array();
	while($row = mysql_fetch_assoc($result))
		$teams[] = $row;
	
	echo "<form action='rs_h2h.php' method='GET'>";
	showSelect("team1", $teams, $selectedTeam1);
	showSelect("team2", $teams, $selectedTeam2);
	echo "<br /><input type='submit'></form>";
}

function showSelect($name, $teams, $selected)
{
	echo "<label for='$name'>$name:</label>";
	echo "<select name='$name' required>";
  	foreach($teams as $team) {
  		if($selected==$team['teamid'])
  			echo "<option value='{$team['teamid']}' selected>{$team['teamname']}</option>";
  		else
  			echo "<option value='{$team['teamid']}'>{$team['teamname']}</option>";
  	}
	echo "</select><br />";
}

?>