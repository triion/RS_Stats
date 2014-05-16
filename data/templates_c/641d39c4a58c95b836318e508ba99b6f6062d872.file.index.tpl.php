<?php /* Smarty version Smarty-3.1-DEV, created on 2014-04-22 11:48:05
         compiled from "E:\Dev\RS_Stats\module\Application\view\error\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2241253440581018b74-73807344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '641d39c4a58c95b836318e508ba99b6f6062d872' => 
    array (
      0 => 'E:\\Dev\\RS_Stats\\module\\Application\\view\\error\\index.tpl',
      1 => 1398160083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2241253440581018b74-73807344',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_53440581070bf5_27369875',
  'variables' => 
  array (
    'message' => 0,
    'display_exceptions' => 0,
    'exception' => 0,
    'e' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53440581070bf5_27369875')) {function content_53440581070bf5_27369875($_smarty_tpl) {?><h1>An error occurred</h1>
<h2><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</h2>
<?php $_smarty_tpl->smarty->loadPlugin('Smarty_Internal_Debug'); Smarty_Internal_Debug::display_debug($_smarty_tpl); ?>
<?php if ($_smarty_tpl->tpl_vars['display_exceptions']->value) {?>

<?php if ($_smarty_tpl->tpl_vars['exception']->value) {?>
<hr/>
<h2>Additional information:</h2>
<h3><?php echo get_class($_smarty_tpl->tpl_vars['exception']->value);?>
</h3>
<dl>
    <dt>File:</dt>
    <dd>
        <pre class="prettyprint linenums"><?php echo $_smarty_tpl->tpl_vars['exception']->value->getFile();?>
:<?php echo $_smarty_tpl->tpl_vars['exception']->value->getLine();?>
</pre>
    </dd>
    <dt>Message:</dt>
    <dd>
        <pre class="prettyprint linenums"><?php echo $_smarty_tpl->tpl_vars['exception']->value->getMessage();?>
</pre>
    </dd>
    <dt>Stack trace:</dt>
    <dd>
        <pre class="prettyprint linenums"><?php echo $_smarty_tpl->tpl_vars['exception']->value->getTraceAsString();?>
</pre>
    </dd>
</dl>
<?php $_smarty_tpl->tpl_vars['e'] = new Smarty_variable($_smarty_tpl->tpl_vars['exception']->value->getPrevious(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['e']->value) {?>
<hr/>
<h2>Previous exceptions:</h2>
<ul class="unstyled">
    <?php while ($_smarty_tpl->tpl_vars['e']->value) {?>
    <li>
        <h3><?php echo get_class($_smarty_tpl->tpl_vars['e']->value);?>
</h3>
        <dl>
            <dt>File:</dt>
            <dd>
                <pre class="prettyprint linenums"><?php echo $_smarty_tpl->tpl_vars['e']->value->getFile();?>
:<?php echo $_smarty_tpl->tpl_vars['e']->value->getLine();?>
</pre>
            </dd>
            <dt>Message:</dt>
            <dd>
                <pre class="prettyprint linenums"><?php echo $_smarty_tpl->tpl_vars['e']->value->getMessage();?>
</pre>
            </dd>
            <dt>Stack trace:</dt>
            <dd>
                <pre class="prettyprint linenums"><?php echo $_smarty_tpl->tpl_vars['e']->value->getTraceAsString();?>
</pre>
            </dd>
        </dl>
        <?php $_smarty_tpl->tpl_vars['e'] = new Smarty_variable($_smarty_tpl->tpl_vars['e']->value->getPrevious(), null, 0);?>
        <?php }?>
    </li>
</ul>
<?php }?>
<?php } else { ?>
<h3>No Exception available</h3>
<?php }?>
<?php }?><?php }} ?>
