<?php
/**
 * Smarty {fetch} plugin
 *
 * Type:     function<br>
 * Name:     fetch<br>
 * Purpose:  fetch file, web or ftp data and display results
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 * @return string|null if the assign parameter is passed, Smarty assigns the result to a template variable
 */

function smarty_function_print_array($params, $template)
{
    $output = "";
    foreach($params['array'] as $line)
    {
        $line = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $line);
        $output .= $line . "<br>\r\n";
    }
    return $output;
}