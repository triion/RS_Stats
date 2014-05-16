{$this->doctype()}
<html lang="en">
<head>
    <meta charset="utf-8">
    {$this->headTitle()->setSeparator(' - ')->setAutoEscape(false)}

    {$basePath = $this->basePath()}
    {$this->headLink([ 'rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => $this->basePath('/images/favicon.ico')])
        ->appendStylesheet($this->basePath('/css/bootstrap.min.css'))
        ->appendStylesheet($this->basePath('/css/style.css'))
        ->prependStylesheet($this->basePath('/css/bootstrap-theme.min.css'))}

    {$this->headTitle('Triion\'s RS-Tool')}

    {$this->headMeta()}

     <!-- Scripts -->
    {$this->headScript()
            ->appendFile($this->basePath('/js/html5.js'), "text/javascript", ['conditional' => 'lt IE9'])
            ->prependFile($this->basePath('/js/bootstrap.min.js'))
            ->prependFile($this->basePath('/js/jquery.min.js'))
            ->prependFile($this->basePath('/js/respond.min.js'), 'text/javascript', ['conditional' => 'lt IE 9'])
            ->prependFile($this->basePath('/js/html5shiv.js'),   'text/javascript', ['conditional' => 'lt IE 9'])
    }

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
                    <a class="navbar-brand" href="{$this->url('home')}"><img src="{$this->basePath('img/zf2-logo.png')}" alt="Triion's RS-Tool"/>&nbsp;{$this->translate('RS Tool')}</a>
                </div>
                <div class="collapse navbar-collapse">
                        {$this->navigation('navigation')->menu()->setMinDepth(0)->setMaxDepth(0)->setUlClass('nav navbar-nav')->setPartial(array('application/navigation/topnav.phtml', 'Application'))}
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container">

            {$content}

            <hr>
            <footer>
                <p>&copy; 2014 - {$smarty.now|date_format:"%Y"} by Triion. {$this->translate('All rights reserved.')}</p>
            </footer>
        </div> <!-- /container -->
        {$this->inlineScript()}
    </body>
</html>