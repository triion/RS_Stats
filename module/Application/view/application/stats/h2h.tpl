
{literal}
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
{/literal}
<table cellspacing='0'><caption>Head2Head {$team1name} Vs {$team2name}</caption>
<thead><tr><th>Season</th><th>date</th><th>Match</th><th>Result</th></thead><tbody>
{foreach $stats['matches'] as $match}
    <tr>
    <td>{$match['season']}</td>
    <td>{$match['date']|date_format}</td>
    {if $match['ishome']} 
        <td><b>{$match['hometeam']}</b> - {$match['awayteam']}</td>
    {else}
        <td>{$match['hometeam']} - <b>{$match['awayteam']}</b></td>
    {/if}
    <td class="{$match['class']}">{$match['goalshome']}-{$match['goalsaway']}</td>
{/foreach}
<tr><td colspan='3' style='text-align:right;'>Aggregate:</td><td class='{$stats['aggresult']}'>{$stats['agghome']} - {$stats['aggaway']}</td></tr>
<tr><td colspan='3' style='text-align:right;'>Avg:</td><td class='{$stats['aggresult']}'>{$stats['avghome']} - {$stats['avgaway']}</td></tr>
<tr><td colspan='3' style='text-align:right;'>Avg Home:</td><td class='{$stats['avghomeOnlyresult']}'>{$stats['avghomeOnlyhome']} - {$stats['avghomeOnlyaway']}</td></tr>
<tr><td colspan='3' style='text-align:right;'>Avg Away:</td><td class='{$stats['avgawayOnlyresult']}'>{$stats['avgawayOnlyhome']} - {$stats['avgawayOnlyaway']}</td></tr>
</tbody></table>