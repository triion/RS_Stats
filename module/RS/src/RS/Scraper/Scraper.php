<?php
namespace RS\Scraper;
require_once '/vendor/simplehtmldom/simple_html_dom.php';

abstract class Scraper
{
    protected $html;
    protected $scrapedInfo;
    private static $USE_PROXY = FALSE;

    public function __construct() 
    {
        $this->loadHTML();
    }

    protected function loadHTML()
    {
        $context = NULL;
        if(self::$USE_PROXY)
        {
            $auth = base64_encode('mathias.vandebroeck:tiogapass');
            $contextOptions = array
            ( 
                   /*'http' => array
                   ( 
                          'proxy' => 'tcp://proxies.finbel.intra:8080', // This needs to be the server and the port of the NTLM Authentication Proxy Server. 
                          'request_fulluri' => true,
                          'header' => array("Proxy-Authorization: Basic $auth")
                   ), */
                    'http' => array
                    ( 
                          'proxy' => 'tcp://10.12.3.196:8118', // This needs to be the server and the port of the NTLM Authentication Proxy Server. 
                          'request_fulluri' => true,
                    ), 
            );
            $context = stream_context_create($contextOptions);  
        }
        $this->html = \file_get_html($this->getURL(), FALSE, $context);
    }

    /**
     * Abstract method for injecting the correct URL for a specific Scraper
     * 
     */
    abstract protected function getURL();
    
    /**
     * ScrapeHTML function that uses the html-var to extract information to the scrapedInfo-var
     * 
     */
    abstract protected function scrapeHTML();

    /**
     * Gets the value of html.
     *
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }
    
    /**
     * Sets the value of html.
     *
     * @param mixed $html the html
     *
     * @return self
     */
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

    /**
     * Gets the value of scrapedInfo.
     *
     * @return mixed
     */
    public function getScrapedInfo()
    {
        if(empty($this->scrapedInfo))
            $this->scrapedInfo = $this->scrapeHTML();
        return $this->scrapedInfo;
    }
    
    /**
     * Sets the value of scrapedInfo.
     *
     * @param mixed $scrapedInfo the scraped info
     *
     * @return self
     */
    public function setScrapedInfo($scrapedInfo)
    {
        $this->scrapedInfo = $scrapedInfo;
        return $this;
    }
}