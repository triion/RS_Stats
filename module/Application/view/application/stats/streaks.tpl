{literal}
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
.D.home { border: 1px solid #be6500; text-decoration:underline; font-weight: bold;}
caption { font-size: 150%; }
.small {text-transform:uppercase; font-size:60%;}
.frborder { border-right:thick ridge #ccc; }
.flborder { border-left:thick ridge #ccc; }
.minwidth { width:16px; }
</style>
{/literal}
<table cellspacing='1px'><caption>Belgium League 1 Season {$season} - <span class='small'>Thanks to <a href='http://rockingsoccer.com/en/soccer/info/manager-1549'>Mats</a> for the idea.</span></caption><thead><tr><th>#</th><th style='text-align:left;' class='frborder'>Team</th>
{for $i=1 to $matchday}
    <th>{$i}</th>
{/for}
<th class='frborder flborder'>Points</th><th>W</th><th>L</th><th class='frborder'>D</th><th title='Goals for'>GF</th><th title='Goals against'>GA</th><th title='Goal Saldo' class='frborder'>GS</th><th>Max Win</th><th>Max Loss</th><th class='frborder'>Max Draw</th><th>Longest without loss</th><th>Longest without Win</th></tr></thead><tbody>
{$position = 1}
{foreach $teams as $team}
    {if $position is not even} 
        <tr class='odd'>
    {else} 
        <tr>
    {/if}
    <td>{$position}</td>
    <td style='text-align:left;' class='frborder' nowrap>{$team['teamname']}</td>
    {for $i=1 to $matchday}
        {if isset($team[$i])}
            {$result = $team[$i]['result']}
            {if $team[$i]['home']}
                {$place='home'}
            {else}
                {$place='away'}
            {/if}
        {else}
            {$result = ''}
            {$place = ''}
        {/if}
        
        <td class='minwidth {$result} {$place}'>{$result}</td>
    {/for}
    <td class='frborder flborder'>{$team['points']}</td>
    <td class='minwidth'>{$team['W']}</td>
    <td class='minwidth'>{$team['L']}</td>
    <td class='minwidth frborder'>{$team['D']}</td>
    <td class='minwidth'>{$team['goalsmade']}</td>
    <td class='minwidth'>{$team['goalsagainst']}</td>
    {$saldo = $team['goalsmade'] - $team['goalsagainst']}
    <td class='minwidth frborder'>{$saldo}</td>
    <td>{$team['streaks']['maxwin']}</td>
    <td>{$team['streaks']['maxloss']}</td>
    <td class='frborder'>{$team['streaks']['maxdraw']}</td>
    <td>{$team['streaks']['noLoss']}</td>
    <td>{$team['streaks']['noWin']}</td></tr>
    {$position=$position+1}
{/foreach}
</tbody></table>
<table cellspacing='0'><caption>Legend</caption><tbody>
<tr><td class='minwidth W away'>W</td><td>Won away</td><td class='minwidth D'>D</td><td>Draw away</td><td class='minwidth L away'>L</td><td>Lost away</td></tr>
<tr><td class='minwidth W home'>W</td><td>Won home</td><td class='minwidth D home'>D</td><td>Draw home</td><td class='minwidth L home'>L</td><td>Lost home</td></tr>
</tbody></table>