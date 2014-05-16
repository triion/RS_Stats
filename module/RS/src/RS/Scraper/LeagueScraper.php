<?php
namespace RS\Scraper;

class LeagueScraper extends Scraper
{
    private $countryCode;
    private $season;
    private $level;
    private $group;

    public function __construct($countryCode, $season = 9, $level = 1, $group = 1)
    {
        $this->countryCode = $countryCode;
        $this->season = $season;
        $this->level = $level;
        $this->group = $group;
        parent::__construct();        
    }

    protected function getURL()
    {
        //$URL = "http://rs.local:8080/testdata/league.txt";
        $URL = 'http://rockingsoccer.com/en/soccer/league-%1$s.%2$d/level-%3$d/group-%4$d/clubs';
        return sprintf($URL, $this->getCountryCode(), $this->getSeason(), $this->getLevel(), $this->getGroup());
    }

    protected function scrapeHTML()
    {
        $teams = array();
        foreach($this->html->find('div#content') as $content)
        {
            foreach ($content->find('table.horizontal_table tr[class]') as $tr) {
                $team = array();
                $teamHref = $tr->find('td', 1)->find('a', 1)->href;
                $teamArray = explode('-', $teamHref);
                $team['id'] = trim(end($teamArray));
                $team['country'] = trim($tr->find('td', 1)->find('img', 0)->alt);
                $team['name'] = trim($tr->find('td', 1)->find('span', 0)->plaintext);
                if(is_null($tr->find('td', 2)->find('span', 0)))
                {
                    //probably Botteam
                    $team['manager'] = trim($tr->find('td', 2)->plaintext);
                }else{
                    $team['manager'] = trim($tr->find('td', 2)->find('span', 0)->plaintext);
                }
                $teams[$team['id']] = $team;
            }
        }
        return $teams;
    }

    /**
     * Gets the value of countryCode.
     *
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
    
    /**
     * Sets the value of countryCode.
     *
     * @param mixed $countryCode the country code
     *
     * @return self
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Gets the value of season.
     *
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }
    
    /**
     * Sets the value of season.
     *
     * @param mixed $season the season
     *
     * @return self
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Gets the value of level.
     *
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }
    
    /**
     * Sets the value of level.
     *
     * @param mixed $level the level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Gets the value of group.
     *
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }
    
    /**
     * Sets the value of group.
     *
     * @param mixed $group the group
     *
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }
}

