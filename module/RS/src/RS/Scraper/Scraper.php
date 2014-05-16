<?php
namespace RS\Scraper;
require_once '/vendor/simplehtmldom/simple_html_dom.php';

abstract class Scraper
{
    protected $html;
    protected $scrapedInfo;

    public function __construct() 
    {
        $this->loadHTML();
    }

    protected function loadHTML()
    {
        $this->html = \file_get_html($this->getURL());
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