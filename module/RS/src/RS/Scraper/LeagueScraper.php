<?php
namespace RS\Scraper;

class LeagueScraper extends Scraper
{
    private $division;

    public function __construct($division)
    {
        $this->division = $division;
        parent::__construct();        
    }

    protected function getURL()
    {
        //$URL = "http://rs.local:8080/testdata/league.txt";
        $URL = 'http://rockingsoccer.com/en/soccer/league-%1$s.%2$d/level-%3$d/group-%4$d/clubs';
        return sprintf($URL, $this->division->getCountry(), $this->division->getSeason(), $this->division->getLevel(), $this->division->getGroup());
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

    
}

