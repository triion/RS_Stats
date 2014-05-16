<?php /* Smarty version Smarty-3.1-DEV, created on 2014-05-10 14:51:59
         compiled from "E:\Dev\RS_Stats\module\Application\view\layout\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11374534404cf0a25d3-58981072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fee7489ef5a5c8a2f45c927bf3838a16f1aeb924' => 
    array (
      0 => 'E:\\Dev\\RS_Stats\\module\\Application\\view\\layout\\layout.tpl',
      1 => 1399726206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11374534404cf0a25d3-58981072',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_534404cf0e4d18_39187502',
  'variables' => 
  array (
    'this' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534404cf0e4d18_39187502')) {function content_534404cf0e4d18_39187502($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\Dev\\RS_Stats\\vendor\\smarty\\smarty\\distribution\\libs\\plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->tpl_vars['this']->value->doctype();?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <?php echo $_smarty_tpl->tpl_vars['this']->value->headTitle()->setSeparator(' - ')->setAutoEscape(false);?>


    <?php $_smarty_tpl->tpl_vars['basePath'] = new Smarty_variable($_smarty_tpl->tpl_vars['this']->value->basePath(), null, 0);?>
    <?php echo $_smarty_tpl->tpl_vars['this']->value->headLink(array('rel'=>'shortcut icon','type'=>'image/vnd.microsoft.icon','href'=>$_smarty_tpl->tpl_vars['this']->value->basePath('/images/favicon.ico')))->appendStylesheet($_smarty_tpl->tpl_vars['this']->value->basePath('/css/bootstrap.min.css'))->appendStylesheet($_smarty_tpl->tpl_vars['this']->value->basePath('/css/style.css'))->prependStylesheet($_smarty_tpl->tpl_vars['this']->value->basePath('/css/bootstrap-theme.min.css'));?>


    <?php echo $_smarty_tpl->tpl_vars['this']->value->headTitle('Triion\'s RS-Tool');?>


    <?php echo $_smarty_tpl->tpl_vars['this']->value->headMeta();?>


     <!-- Scripts -->
    <?php echo $_smarty_tpl->tpl_vars['this']->value->headScript()->appendFile($_smarty_tpl->tpl_vars['this']->value->basePath('/js/html5.js'),"text/javascript",array('conditional'=>'lt IE9'))->prependFile($_smarty_tpl->tpl_vars['this']->value->basePath('/js/bootstrap.min.js'))->prependFile($_smarty_tpl->tpl_vars['this']->value->basePath('/js/jquery.min.js'))->prependFile($_smarty_tpl->tpl_vars['this']->value->basePath('/js/respond.min.js'),'text/javascript',array('conditional'=>'lt IE 9'))->prependFile($_smarty_tpl->tpl_vars['this']->value->basePath('/js/html5shiv.js'),'text/javascript',array('conditional'=>'lt IE 9'));?>


</head>
<body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url('home');?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['this']->value->basePath('img/zf2-logo.png');?>
" alt="Triion's RS-Tool"/>&nbsp;<?php echo $_smarty_tpl->tpl_vars['this']->value->translate('RS Tool');?>
</a>
                </div>
                <div class="collapse navbar-collapse">
                        <?php echo $_smarty_tpl->tpl_vars['this']->value->navigation('navigation')->menu()->setMinDepth(0)->setMaxDepth(0)->setUlClass('nav navbar-nav')->setPartial(array('application/navigation/topnav.phtml','Application'));?>

                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container">

            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>


            <hr>
            <footer>
                <p>&copy; 2014 - <?php echo smarty_modifier_date_format(time(),"%Y");?>
 by Triion. <?php echo $_smarty_tpl->tpl_vars['this']->value->translate('All rights reserved.');?>
</p>
            </footer>
        </div> <!-- /container -->
        <?php echo $_smarty_tpl->tpl_vars['this']->value->inlineScript();?>

    </body>
</html><?php }} ?>
