<?php
if(isset($_GET["season"]) && is_numeric($_GET["season"]))
{
	$season = htmlspecialchars($_GET["season"]);
}else{
	$season = 9;
}

$teams = getResults($season);
$matchday = count($teams[0])-9;

//echo $matchday;
echo "<!DOCTYPE html>
<html>
<head>
<style>
html {font-size:12px;
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
.W.away { border: 1px solid green; text-decoration:underline; font-weight:bold; }
.L.home { border: 1px solid red; text-decoration:underline; font-weight:bold; }
caption { font-size: 150%; }
.small {text-transform:uppercase; font-size:60%;}
.frborder { border-right:thick ridge #ccc; }
.flborder { border-left:thick ridge #ccc; }
.minwidth { width:16px; }
</style>
</head>
<body>";
echo "<table cellspacing='0'><caption>Belgium League 1 Season $season - <span class='small'>Thanks to <a href='http://rockingsoccer.com/en/soccer/info/manager-1549'>Mats</a> for the idea.</span></caption><thead><tr><th>#</th><th style='text-align:left;' class='frborder'>Team</th>";
for($i=1;$i<=$matchday;$i++) {
	echo "<th>$i</th>";
}
echo "<th class='frborder flborder'>Points</th><th>W</th><th>L</th><th class='frborder'>D</th><th title='Goals for'>GF</th><th title='Goals against'>GA</th><th title='Goal Saldo' class='frborder'>GS</th><th>Max Win</th><th>Max Loss</th><th class='frborder'>Max Draw</th><th>Longest without loss</th><th>Longest without Win</th></tr></thead><tbody>";
$position = 1;
foreach($teams as $team)
{
	if($position % 2 == 1) echo "<tr class='odd'>";
	else echo "<tr>";
	echo "<td>$position</td>";
	echo "<td style='text-align:left;' class='frborder' nowrap>{$team['teamname']}</td>";
	for($i=1;$i<=$matchday;$i++) {
		$result = $team[$i]['result'];
		if($team[$i]['home']) { $place = 'home'; } else { $place = 'away'; }
		echo "<td class='minwidth $result $place'>$result</td>";
	}
	echo "<td class='frborder flborder'>{$team['points']}</td>";
	echo "<td class='minwidth'>{$team['W']}</td>";
	echo "<td class='minwidth'>{$team['L']}</td>";
	echo "<td class='minwidth frborder'>{$team['D']}</td>";
	echo "<td class='minwidth'>{$team['goalsmade']}</td>";
	echo "<td class='minwidth'>{$team['goalsagainst']}</td>";
	$saldo = $team['goalsmade'] - $team['goalsagainst'];
	echo "<td class='minwidth frborder'>$saldo</td>";
	echo "<td>{$team['streaks']['maxwin']}</td>";
	echo "<td>{$team['streaks']['maxloss']}</td>";
	echo "<td class='frborder'>{$team['streaks']['maxdraw']}</td>";
	echo "<td>{$team['streaks']['noLoss']}</td>";
	echo "<td>{$team['streaks']['noWin']}</td></tr>";
	$position++;
}
echo "</tbody></table>";
showLegend();

function showLegend()
{
	echo "<table cellspacing='0'><caption>Legend</caption><tbody>";
	echo "<tr><td class='minwidth W away'>W</td><td>Won away</td></tr>";
	echo "<tr><td class='minwidth W home'>W</td><td>Won home</td></tr>";
	echo "<tr><td class='minwidth D'>D</td><td>Draw</td></tr>";
	echo "<tr><td class='minwidth L away'>L</td><td>Lost away</td></tr>";
	echo "<tr><td class='minwidth L home'>L</td><td>Lost home</td></tr>";
	echo "</tbody></table>";
}

function getResults($season)
{
	$link = mysql_connect('localhost', 'triion_rs', '?wpT5]^k*Dkf');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('triion_rs');
	
	$query = "SELECT * FROM results WHERE season=$season";
	$result = mysql_query($query);
	$teams = array();
	while($row = mysql_fetch_assoc($result))
	{
		$teams[$row['teamid']]['teamname'] = $row['teamname'];
		$teams[$row['teamid']][$row['matchday']] = array("result" => $row['result'], "home" => $row['home'], "goalsmade" => $row['goalsmade'], "goalsagainst" => $row['goalsagainst']);
	}	
	
	foreach($teams as &$team) {
		$maxwin = 0;
		$current_win = 0;
		$maxloss = 0;
		$current_loss = 0;
		$maxdraw = 0;
		$current_draw = 0;
		$longestNoLoss = 0;
		$current_noLoss = 0;
		$longestNoWin = 0;
		$current_noWin = 0;
		$points = 0;
		$wins = 0;
		$losses = 0;
		$draws = 0;
		$goalsmade = 0;
		$goalsagainst = 0;
		for($i=1; $i<=count($team)-1; $i++) {
			$goalsmade += $team[$i]['goalsmade'];
			$goalsagainst += $team[$i]['goalsagainst'];
			switch($team[$i]["result"]) {
			    	case "W":
			    		if($current_loss > $maxloss) $maxloss = $current_loss;
			    		$current_los = 0;
			    		if($current_draw > $maxdraw) $maxdraw = $current_draw;
			    		$current_draw = 0;
			    		if($current_noWin > $longestNoWin) $longestNoWin = $current_noWin;
			    		$current_noWin = 0;
			    		
			        	$current_win++;
			        	$current_noLoss++;
			        	$points += 3;
			        	$wins++;
	        			break;
	    		    	case "L":
	    		    		if($current_win > $maxwin) $maxwin = $current_win;
	    		    		$current_win = 0;
	    		    		if($current_draw > $maxdraw) $maxdraw = $current_draw;
	    		    		$current_draw = 0;
	    		    		if($current_noLoss > $longestNoLoss) $longestNoLoss = $current_noLoss;
	    		    		$current_noLoss = 0;
	    		    		    		    		
	    		    		$current_loss++;
	    		    		$current_noWin++;
	    		    		$losses++;
	    		    		break;
	    		    	case "D":
	    		    		if($current_win > $maxwin) $maxwin = $current_win;
	    		    		$current_win = 0;
	    		    		if($current_loss > $maxloss) $maxloss = $current_loss;
			    		$current_los = 0;
			    		
	    		    		$current_draw++;
	    		    		$current_noLoss++;
	    		    		$current_noWin++;
	    		    		$points++;
	    		    		$draws++;
	    		    		break;
	    		}
	    		if($current_loss > $maxloss) $maxloss = $current_loss;
	    		if($current_draw > $maxdraw) $maxdraw = $current_draw;
	    		if($current_noWin > $longestNoWin) $longestNoWin = $current_noWin;
	    		if($current_win > $maxwin) $maxwin = $current_win;
	    		if($current_noLoss > $longestNoLoss) $longestNoLoss = $current_noLoss;
		}
		$team["streaks"] = array("maxwin" => $maxwin, "maxloss" => $maxloss, "maxdraw" => $maxdraw, "noLoss" => $longestNoLoss, "noWin" => $longestNoWin);
		$team["points"] = $points;
		$team["W"] = $wins;
		$team["L"] = $losses;
		$team["D"] = $draws;
		$team["goalsmade"] = $goalsmade;
		$team["goalsagainst"] = $goalsagainst;
		$team["goalsaldo"] = $goalsmade - $goalsagainst;
	}
	usort($teams, "compare_teams");
	return $teams;
}

function compare_teams($a, $b)
{
	if ($a["points"] == $b["points"]) {
		if($a["goalsaldo"] == $b["goalsaldo"]) {
			if($a["goalsmade"] == $b["goalsmade"]) {
		        	return 0;
		        }else{
		        	return ($a["goalsmade"] < $b["goalsmade"]) ? 1 : -1;
		        }
		} else {
			return ($a["goalsaldo"] < $b["goalsaldo"]) ? 1 : -1;
		}
    	}	
   	return ($a["points"] < $b["points"]) ? 1 : -1;
}
?>