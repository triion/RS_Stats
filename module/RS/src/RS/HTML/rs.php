<?php
include('/home/triion/simple_html_dom.php');
 
list($season, $matchday, $numberMatches) = getCurrentSeasonMatchday();
echo "$season - $matchday - $numberMatches";
$matches = getMatchResults($season, $matchday);
addMatchesToDb($season,$matchday,$matches);

/*for ($season = 1; $season <= 8; $season++) {
    for($matchday=1; $matchday<=34; $matchday++) {
	$matches = getMatchResults($season,$matchday);
	addMatchesToDb($season,$matchday,$matches);
    }
}*/


function getCurrentSeasonMatchday()
{
	$link = mysql_connect('localhost', 'triion_rs', '?wpT5]^k*Dkf');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('triion_rs');
	
	$query = "SELECT max(season) as season FROM results";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	$season = $row['season'];
	//$query = "SELECT max(matchday) as matchday FROM results WHERE season=$season";
	$query = "SELECT matchday FROM results WHERE season=$season GROUP BY matchday HAVING count(matchday)=18 ORDER BY matchday desc LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	$matchday = $row['matchday'];	
	if($matchday==34) {//update to new season
		$matchday=0;
		$season++;
	}
	$query = sprintf("SELECT count(*) as numberOfMatches FROM results WHERE season=%d && matchday=%d", $season, $row['matchday']);
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	$numberOfMatches=$row['numberOfMatches'];
	if($numberOfMatches==18) {
		$matchday++;
		$numberOfMatches=0;
	}
	return array($season, $matchday, $numberOfMatches);
}

function getMatchResults($season, $matchday)
{
	echo "Getting $season - $matchday <br />";
	$URL = "http://rockingsoccer.com/en/soccer/league-be.".$season."/level-1/group-1/results/".$matchday;
	$html = file_get_html($URL);

	$matches = array();
	foreach($html->find('div#content') as $content)
	{
	    $table = $content->find('table.horizontal_table', 0);
	    foreach($table->find('span.ltr') as $points)
	    	$points->innertext= "";
	
	    foreach($table->find('tbody tr[class]') as $tr)
	    {
	    	$match['day']   = $tr->find('td', 0)->find('span',0)->title;
	    	$match['hometeamid'] = end(explode("-", $tr->find('td', 1)->find('a',1)->href));
	    	$match['hometeam']   = trim($tr->find('td', 1)->find('span',0)->plaintext);
			$match['result'] = $tr->find('td', 2)->find('a',0)->innertext; 
			//echo "~".$match['result']."## <br />";
			if($match['result']=="") //Old matches don't have link (a)
				$match['result'] = $tr->find('td', 2)->innertext;
			$match['matchid'] = end(explode("-", $tr->find('td', 2)->find('a',0)->href)); 
			$match['awayteamid'] = end(explode("-", $tr->find('td', 3)->find('a',1)->href));
			$match['awayteam'] = trim($tr->find('td', 3)->find('span',0)->plaintext);
			/*if($match['result']=='&hellip;') {//end search if match isn't played
				echo "MATCHES AREN'Y PLAYED YET!";
				return array();
			}*/
			$matches[] = $match;
	    }
	}
	return $matches;
}

function addMatchesToDb($season, $matchday, $matches)
{
	$link = mysql_connect('localhost', 'triion_rs', '?wpT5]^k*Dkf');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('triion_rs');
	
	foreach($matches as $match)
	{
		if($match['result']=='&hellip;' || $match['result']=='[live]') {//end search if match isn't played
			echo "MATCH ".$match['hometeam']."-".$match['awayteam']." ISN'T PLAYED YET!<br />";
			continue;
		}
		$query = sprintf("SELECT * FROM matches WHERE matchid=%d",$match['matchid']);
		$result = mysql_query($query);
		if($row = mysql_fetch_assoc($result)){
			echo "MATCH ".$match['hometeam']."-".$match['awayteam']." ALREADY IN DB!<br />";
			continue;
		}
		echo "ADDING MATCH ".$match['hometeam']."-".$match['awayteam']." TO DB!<br />";
		list($goalshome, $goalsaway) = explode("-", $match['result']);
		if($goalshome > $goalsaway) {
			$resulthome = 'W';
			$resultaway = 'L';
		}else if($goalshome < $goalsaway) {
			$resulthome = 'L';
			$resultaway = 'W';
		} else {
			$resulthome = 'D';
			$resultaway = 'D';
		}
		$date = date("Y-m-d H:i:s" , strtotime($match['day']));
		$query = sprintf("INSERT INTO matches (matchid, season, matchday, date, hometeamid, hometeam, awayteamid, awayteam, goalshome, goalsaway, 
		resulthome, resultaway) values (%d, %d, %d, '%s', %d, '%s', %d, '%s', %d, %d, '%s', '%s')", 
		$match['matchid'],$season, $matchday, $date, $match['hometeamid'], $match['hometeam'], $match['awayteamid'], $match['awayteam'], $goalshome, 	
		$goalsaway, $resulthome, $resultaway);
	
		// Perform Query 
		$result = mysql_query($query);
		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    mysql_close($link);
		    die($message);
		}
		
		$query_home = sprintf("INSERT INTO results (teamid, teamname, season, matchday, date, matchid, result, home, goalsmade, goalsagainst) 
				values (%d, '%s', %d, %d, '%s', %d, '%s', %s, %d, %d)", 
				$match['hometeamid'], $match['hometeam'], $season, $matchday, $date, $match['matchid'], $resulthome, 'true', $goalshome, 
				$goalsaway);
		$result = mysql_query($query_home);
		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query_home;
		    mysql_close($link);
		    die($message);
		}
		$query_away = sprintf("INSERT INTO results (teamid, teamname, season, matchday, date, matchid, result, home, goalsmade, goalsagainst) 
				values (%d, '%s', %d, %d, '%s', %d, '%s', %s, %d, %d)", 
				$match['awayteamid'], $match['awayteam'], $season, $matchday, $date, $match['matchid'], $resultaway, 'false', $goalsaway, 
				$goalshome);
		$result = mysql_query($query_away);
		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query_away;
		    mysql_close($link);
		    die($message);
		}
	}
	mysql_close($link);
}
?>