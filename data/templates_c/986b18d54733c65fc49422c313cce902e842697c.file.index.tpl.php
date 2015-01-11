<?php /* Smarty version Smarty-3.1-DEV, created on 2014-06-15 21:39:07
         compiled from "E:\Dev\RS_Stats\module\Application\view\application\batch\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14265345b4d5b67e76-05344344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '986b18d54733c65fc49422c313cce902e842697c' => 
    array (
      0 => 'E:\\Dev\\RS_Stats\\module\\Application\\view\\application\\batch\\index.tpl',
      1 => 1402861104,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14265345b4d5b67e76-05344344',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5345b4d5b9e416_74485183',
  'variables' => 
  array (
    'info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5345b4d5b9e416_74485183')) {function content_5345b4d5b9e416_74485183($_smarty_tpl) {?><?php if (!is_callable('smarty_function_print_array')) include 'E:\\Dev\\RS_Stats\\vendor\\smarty\\smarty\\distribution\\libs\\plugins\\function.print_array.php';
?><?php echo smarty_function_print_array(array('array'=>$_smarty_tpl->tpl_vars['info']->value),$_smarty_tpl);?>

<pre>
<?php echo var_dump($_smarty_tpl->tpl_vars['info']->value);?>

</pre>

<hr /><?php }} ?>
