<?php /* Smarty version Smarty-3.1-DEV, created on 2014-04-08 16:17:32
         compiled from "E:\Dev\RS_Stats\module\Application\view\error\404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12997534404fce4b6b8-43304579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fbd45fb2165ffaf4f0703f814e84b8d8dd492d2' => 
    array (
      0 => 'E:\\Dev\\RS_Stats\\module\\Application\\view\\error\\404.tpl',
      1 => 1396873609,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12997534404fce4b6b8-43304579',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_534404fceb2338_35146525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534404fceb2338_35146525')) {function content_534404fceb2338_35146525($_smarty_tpl) {?><h1><<?php ?>?php echo $this->translate('A 404 error occurred') ?<?php ?>></h1>
<h2><<?php ?>?php echo $this->message ?<?php ?>></h2>

<<?php ?>?php if (isset($this->reason) && $this->reason): ?<?php ?>>

<<?php ?>?php
$reasonMessage= '';
switch ($this->reason) {
    case 'error-controller-cannot-dispatch':
        $reasonMessage = $this->translate('The requested controller was unable to dispatch the request.');
        break;
    case 'error-controller-not-found':
        $reasonMessage = $this->translate('The requested controller could not be mapped to an existing controller class.');
        break;
    case 'error-controller-invalid':
        $reasonMessage = $this->translate('The requested controller was not dispatchable.');
        break;
    case 'error-router-no-match':
        $reasonMessage = $this->translate('The requested URL could not be matched by routing.');
        break;
    default:
        $reasonMessage = $this->translate('We cannot determine at this time why a 404 was generated.');
        break;
}
?<?php ?>>

<p><<?php ?>?php echo $reasonMessage ?<?php ?>></p>

<<?php ?>?php endif ?<?php ?>>

<<?php ?>?php if (isset($this->controller) && $this->controller): ?<?php ?>>

<dl>
    <dt><<?php ?>?php echo $this->translate('Controller') ?<?php ?>>:</dt>
    <dd><<?php ?>?php echo $this->escapeHtml($this->controller) ?<?php ?>>
<<?php ?>?php
if (isset($this->controller_class)
    && $this->controller_class
    && $this->controller_class != $this->controller
) {
    echo '(' . sprintf($this->translate('resolves to %s'), $this->escapeHtml($this->controller_class)) . ')';
}
?<?php ?>>
</dd>
</dl>

<<?php ?>?php endif ?<?php ?>>

<<?php ?>?php if (isset($this->display_exceptions) && $this->display_exceptions): ?<?php ?>>

<<?php ?>?php if(isset($this->exception) && $this->exception instanceof Exception): ?<?php ?>>
<hr/>
<h2><<?php ?>?php echo $this->translate('Additional information') ?<?php ?>>:</h2>
<h3><<?php ?>?php echo get_class($this->exception); ?<?php ?>></h3>
<dl>
    <dt><<?php ?>?php echo $this->translate('File') ?<?php ?>>:</dt>
    <dd>
        <pre class="prettyprint linenums"><<?php ?>?php echo $this->exception->getFile() ?<?php ?>>:<<?php ?>?php echo $this->exception->getLine() ?<?php ?>></pre>
    </dd>
    <dt><<?php ?>?php echo $this->translate('Message') ?<?php ?>>:</dt>
    <dd>
        <pre class="prettyprint linenums"><<?php ?>?php echo $this->exception->getMessage() ?<?php ?>></pre>
    </dd>
    <dt><<?php ?>?php echo $this->translate('Stack trace') ?<?php ?>>:</dt>
    <dd>
        <pre class="prettyprint linenums"><<?php ?>?php echo $this->exception->getTraceAsString() ?<?php ?>></pre>
    </dd>
</dl>
<<?php ?>?php
    $e = $this->exception->getPrevious();
    if ($e) :
?<?php ?>>
<hr/>
<h2><<?php ?>?php echo $this->translate('Previous exceptions') ?<?php ?>>:</h2>
<ul class="unstyled">
    <<?php ?>?php while($e) : ?<?php ?>>
    <li>
        <h3><<?php ?>?php echo get_class($e); ?<?php ?>></h3>
        <dl>
            <dt><<?php ?>?php echo $this->translate('File') ?<?php ?>>:</dt>
            <dd>
                <pre class="prettyprint linenums"><<?php ?>?php echo $e->getFile() ?<?php ?>>:<<?php ?>?php echo $e->getLine() ?<?php ?>></pre>
            </dd>
            <dt><<?php ?>?php echo $this->translate('Message') ?<?php ?>>:</dt>
            <dd>
                <pre class="prettyprint linenums"><<?php ?>?php echo $e->getMessage() ?<?php ?>></pre>
            </dd>
            <dt><<?php ?>?php echo $this->translate('Stack trace') ?<?php ?>>:</dt>
            <dd>
                <pre class="prettyprint linenums"><<?php ?>?php echo $e->getTraceAsString() ?<?php ?>></pre>
            </dd>
        </dl>
    </li>
    <<?php ?>?php
        $e = $e->getPrevious();
        endwhile;
    ?<?php ?>>
</ul>
<<?php ?>?php endif; ?<?php ?>>

<<?php ?>?php else: ?<?php ?>>

<h3><<?php ?>?php echo $this->translate('No Exception available') ?<?php ?>></h3>

<<?php ?>?php endif ?<?php ?>>

<<?php ?>?php endif ?<?php ?>>
<?php }} ?>
