<?php /* Smarty version Smarty-3.1-DEV, created on 2014-05-10 23:27:19
         compiled from "E:\Dev\RS_Stats\module\Application\view\application\stats\h2h.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13291536e45757379e7-47646408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22db7634e2b1410e637615b4bf3e617fb2e892db' => 
    array (
      0 => 'E:\\Dev\\RS_Stats\\module\\Application\\view\\application\\stats\\h2h.tpl',
      1 => 1399757237,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13291536e45757379e7-47646408',
  'function' => 
  array (
    'getResultByGoals' => 
    array (
      'parameter' => 
      array (
        'home' => 0,
        'away' => 0,
      ),
      'compiled' => '',
    ),
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_536e45757e2577_83239021',
  'variables' => 
  array (
    'team1name' => 0,
    'team2name' => 0,
    'stats' => 0,
    'match' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_536e45757e2577_83239021')) {function content_536e45757e2577_83239021($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\Dev\\RS_Stats\\vendor\\smarty\\smarty\\distribution\\libs\\plugins\\modifier.date_format.php';
?>

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

<table cellspacing='0'><caption>Head2Head <?php echo $_smarty_tpl->tpl_vars['team1name']->value;?>
 Vs <?php echo $_smarty_tpl->tpl_vars['team2name']->value;?>
</caption>
<thead><tr><th>Season</th><th>date</th><th>Match</th><th>Result</th></thead><tbody>
<?php  $_smarty_tpl->tpl_vars['match'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['match']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['stats']->value['matches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['match']->key => $_smarty_tpl->tpl_vars['match']->value) {
$_smarty_tpl->tpl_vars['match']->_loop = true;
?>
    <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['match']->value['season'];?>
</td>
    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['match']->value['date']);?>
</td>
    <?php if ($_smarty_tpl->tpl_vars['match']->value['ishome']) {?> 
        <td><b><?php echo $_smarty_tpl->tpl_vars['match']->value['hometeam'];?>
</b> - <?php echo $_smarty_tpl->tpl_vars['match']->value['awayteam'];?>
</td>
    <?php } else { ?>
        <td><?php echo $_smarty_tpl->tpl_vars['match']->value['hometeam'];?>
 - <b><?php echo $_smarty_tpl->tpl_vars['match']->value['awayteam'];?>
</b></td>
    <?php }?>
    <td class="<?php echo $_smarty_tpl->tpl_vars['match']->value['class'];?>
"><?php echo $_smarty_tpl->tpl_vars['match']->value['goalshome'];?>
-<?php echo $_smarty_tpl->tpl_vars['match']->value['goalsaway'];?>
</td>
<?php } ?>
<tr><td colspan='3' style='text-align:right;'>Aggregate:</td><td class='<?php echo $_smarty_tpl->tpl_vars['stats']->value['aggresult'];?>
'><?php echo $_smarty_tpl->tpl_vars['stats']->value['agghome'];?>
 - <?php echo $_smarty_tpl->tpl_vars['stats']->value['aggaway'];?>
</td></tr>
<tr><td colspan='3' style='text-align:right;'>Avg:</td><td class='<?php echo $_smarty_tpl->tpl_vars['stats']->value['aggresult'];?>
'><?php echo $_smarty_tpl->tpl_vars['stats']->value['avghome'];?>
 - <?php echo $_smarty_tpl->tpl_vars['stats']->value['avgaway'];?>
</td></tr>
<tr><td colspan='3' style='text-align:right;'>Avg Home:</td><td class='<?php echo $_smarty_tpl->tpl_vars['stats']->value['avghomeOnlyresult'];?>
'><?php echo $_smarty_tpl->tpl_vars['stats']->value['avghomeOnlyhome'];?>
 - <?php echo $_smarty_tpl->tpl_vars['stats']->value['avghomeOnlyaway'];?>
</td></tr>
<tr><td colspan='3' style='text-align:right;'>Avg Away:</td><td class='<?php echo $_smarty_tpl->tpl_vars['stats']->value['avgawayOnlyresult'];?>
'><?php echo $_smarty_tpl->tpl_vars['stats']->value['avgawayOnlyhome'];?>
 - <?php echo $_smarty_tpl->tpl_vars['stats']->value['avgawayOnlyaway'];?>
</td></tr>
</tbody></table><?php }} ?>
