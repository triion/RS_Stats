<?php
namespace RS\Scraper;

class TeamDetailsScraper extends Scraper
{
    private $teamid;

    public function __construct($teamid)
    {
        $this->teamid = $teamid;
        parent::__construct();        
        //$this->details = $this->scrape();
    }

    protected function getURL()
    {
        //$URL = "http://rs.local:8080/testdata/team-info.html";
        $URL = 'http://rockingsoccer.com/en/soccer/info/team-%1$s';
        return sprintf($URL, $this->getTeamId());
    }

    protected function scrapeHTML()
    {
        $details = array();
        foreach($this->html->find('div#content') as $content)
        {
            foreach ($content->find('table.vertical_table tr') as $tr) {
                $key = strtolower(trim($tr->find('th', 0)->plaintext));
                $value = trim($tr->find('td', 0)->plaintext);
                if($key=='popularity')
                {
                    $value = str_replace(',','',$value); //Filter comma from popularity
                }
                if($key=='country')
                {
                    $value = trim($tr->find('td', 0)->find('img', 0)->alt);
                }
                $details[$key] = $value;
            }
        }
        return $details;
    }

    /**
     * Gets the value of teamid.
     *
     * @return mixed
     */
    public function getTeamid()
    {
        return $this->teamid;
    }
    
    /**
     * Sets the value of teamid.
     *
     * @param mixed $teamid the teamid
     *
     * @return self
     */
    public function setTeamid($teamid)
    {
        $this->teamid = $teamid;

        return $this;
    }
}

