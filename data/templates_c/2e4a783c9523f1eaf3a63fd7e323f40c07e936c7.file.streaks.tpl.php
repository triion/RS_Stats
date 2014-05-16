<?php /* Smarty version Smarty-3.1-DEV, created on 2014-05-16 11:32:32
         compiled from "E:\Dev\RS_Stats\module\Application\view\application\stats\streaks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19058536e2f658b3e83-36271809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e4a783c9523f1eaf3a63fd7e323f40c07e936c7' => 
    array (
      0 => 'E:\\Dev\\RS_Stats\\module\\Application\\view\\application\\stats\\streaks.tpl',
      1 => 1400232749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19058536e2f658b3e83-36271809',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_536e2f658c2590_18454431',
  'variables' => 
  array (
    'season' => 0,
    'matchday' => 0,
    'i' => 0,
    'teams' => 0,
    'position' => 0,
    'team' => 0,
    'result' => 0,
    'place' => 0,
    'saldo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_536e2f658c2590_18454431')) {function content_536e2f658c2590_18454431($_smarty_tpl) {?>
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

<table cellspacing='1px'><caption>Belgium League 1 Season <?php echo $_smarty_tpl->tpl_vars['season']->value;?>
 - <span class='small'>Thanks to <a href='http://rockingsoccer.com/en/soccer/info/manager-1549'>Mats</a> for the idea.</span></caption><thead><tr><th>#</th><th style='text-align:left;' class='frborder'>Team</th>
<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['matchday']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['matchday']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
    <th><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</th>
<?php }} ?>
<th class='frborder flborder'>Points</th><th>W</th><th>L</th><th class='frborder'>D</th><th title='Goals for'>GF</th><th title='Goals against'>GA</th><th title='Goal Saldo' class='frborder'>GS</th><th>Max Win</th><th>Max Loss</th><th class='frborder'>Max Draw</th><th>Longest without loss</th><th>Longest without Win</th></tr></thead><tbody>
<?php $_smarty_tpl->tpl_vars['position'] = new Smarty_variable(1, null, 0);?>
<?php  $_smarty_tpl->tpl_vars['team'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['team']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['teams']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['team']->key => $_smarty_tpl->tpl_vars['team']->value) {
$_smarty_tpl->tpl_vars['team']->_loop = true;
?>
    <?php if ((1 & $_smarty_tpl->tpl_vars['position']->value)) {?> 
        <tr class='odd'>
    <?php } else { ?> 
        <tr>
    <?php }?>
    <td><?php echo $_smarty_tpl->tpl_vars['position']->value;?>
</td>
    <td style='text-align:left;' class='frborder' nowrap><?php echo $_smarty_tpl->tpl_vars['team']->value['teamname'];?>
</td>
    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['matchday']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['matchday']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
        <?php if (isset($_smarty_tpl->tpl_vars['team']->value[$_smarty_tpl->tpl_vars['i']->value])) {?>
            <?php $_smarty_tpl->tpl_vars['result'] = new Smarty_variable($_smarty_tpl->tpl_vars['team']->value[$_smarty_tpl->tpl_vars['i']->value]['result'], null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['team']->value[$_smarty_tpl->tpl_vars['i']->value]['home']) {?>
                <?php $_smarty_tpl->tpl_vars['place'] = new Smarty_variable('home', null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars['place'] = new Smarty_variable('away', null, 0);?>
            <?php }?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars['result'] = new Smarty_variable('', null, 0);?>
            <?php $_smarty_tpl->tpl_vars['place'] = new Smarty_variable('', null, 0);?>
        <?php }?>
        
        <td class='minwidth <?php echo $_smarty_tpl->tpl_vars['result']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['place']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['result']->value;?>
</td>
    <?php }} ?>
    <td class='frborder flborder'><?php echo $_smarty_tpl->tpl_vars['team']->value['points'];?>
</td>
    <td class='minwidth'><?php echo $_smarty_tpl->tpl_vars['team']->value['W'];?>
</td>
    <td class='minwidth'><?php echo $_smarty_tpl->tpl_vars['team']->value['L'];?>
</td>
    <td class='minwidth frborder'><?php echo $_smarty_tpl->tpl_vars['team']->value['D'];?>
</td>
    <td class='minwidth'><?php echo $_smarty_tpl->tpl_vars['team']->value['goalsmade'];?>
</td>
    <td class='minwidth'><?php echo $_smarty_tpl->tpl_vars['team']->value['goalsagainst'];?>
</td>
    <?php $_smarty_tpl->tpl_vars['saldo'] = new Smarty_variable($_smarty_tpl->tpl_vars['team']->value['goalsmade']-$_smarty_tpl->tpl_vars['team']->value['goalsagainst'], null, 0);?>
    <td class='minwidth frborder'><?php echo $_smarty_tpl->tpl_vars['saldo']->value;?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['team']->value['streaks']['maxwin'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['team']->value['streaks']['maxloss'];?>
</td>
    <td class='frborder'><?php echo $_smarty_tpl->tpl_vars['team']->value['streaks']['maxdraw'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['team']->value['streaks']['noLoss'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['team']->value['streaks']['noWin'];?>
</td></tr>
    <?php $_smarty_tpl->tpl_vars['position'] = new Smarty_variable($_smarty_tpl->tpl_vars['position']->value+1, null, 0);?>
<?php } ?>
</tbody></table>
<table cellspacing='0'><caption>Legend</caption><tbody>
<tr><td class='minwidth W away'>W</td><td>Won away</td><td class='minwidth D'>D</td><td>Draw away</td><td class='minwidth L away'>L</td><td>Lost away</td></tr>
<tr><td class='minwidth W home'>W</td><td>Won home</td><td class='minwidth D home'>D</td><td>Draw home</td><td class='minwidth L home'>L</td><td>Lost home</td></tr>
</tbody></table><?php }} ?>
