<?php
namespace RS\Scraper;

class TeamFacilitiesScraper extends Scraper
{
    private $teamid;

    public function __construct($teamid)
    {
        $this->teamid = $teamid;
        parent::__construct();
    }

    protected function getURL()
    {
        //$URL = "http://rs.local:8080/testdata/team-facilities.txt";
        $URL = 'http://rockingsoccer.com/en/soccer/info/team-%1$d/facilities';
        return sprintf($URL, $this->getTeamId());
    }

    protected function scrapeHTML()
    {
        $details = array();
        foreach($this->html->find('div#content') as $content)
        {
            foreach ($content->find('table.horizontal_table tbody tr[class]') as $tr) {
                //var_dump($tr);
                $facility = strtolower(trim($tr->find('td', 0)->plaintext));
                $level = trim($tr->find('td', 1)->plaintext);
                
                $details[$facility] = $level;
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

