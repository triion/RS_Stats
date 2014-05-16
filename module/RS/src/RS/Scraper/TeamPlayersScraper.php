<?php
namespace RS\Scraper;

class TeamPlayersScraper extends Scraper
{
    private $teamid;

    public function __construct($teamid)
    {
        $this->teamid = $teamid;
        parent::__construct();        
    }

    protected function getURL()
    {
        //$URL = "http://rs.local:8080/testdata/team-players.txt";
        $URL = 'http://rockingsoccer.com/en/soccer/info/team-%1$s/players';
        return sprintf($URL, $this->getTeamId());
    }

    protected function scrapeHTML()
    {
        $details = array();
        foreach($this->html->find('div#content') as $content)
        {
            foreach ($content->find('table.horizontal_table tbody tr[class]') as $tr) {
                $player = array();
                $player['isNT'] = FALSE;
                $ntElement = $tr->find('td', 0)->find('strong', 0);
                if(!is_null($ntElement)) {
                    $nt = $ntElement->plaintext;
                    if(strcasecmp($nt, "(NT)") == 0) {
                        $player['isNT'] = TRUE;
                    }
                }
                
                $player['name'] = $tr->find('td', 0)->find('a', 0)->plaintext;

                $playerlink = $tr->find('td', 0)->find('a', 0)->href;
                $playerlinkexplode = explode("-", $playerlink);
                $player['id'] = end($playerlinkexplode);

                $player['country'] = strtoupper($tr->find('td', 1)->find('img',0)->alt);
                $player['age'] = $tr->find('td', 2)->plaintext;
                $player['position'] = strstr($tr->find('td', 3)->plaintext, "(", TRUE);
                $player['flank'] = trim($tr->find('td', 3)->find('span', 0)->plaintext);
                $player['stars'] = $tr->find('td', 4)->find('span', 0)->title;
                if(TeamPlayersScraper::startsWith($player['stars'], "Youth player:")) {
                    $player['stars'] = substr($player['stars'], -10);
                }
                $player['stats']['matches'] = $tr->find('td', 5)->plaintext;
                $player['stats']['goals'] = $tr->find('td', 6)->plaintext;
                $player['stats']['assists'] = $tr->find('td', 7)->plaintext;
                $player['stats']['cleansheet'] = $tr->find('td', 8)->plaintext;
                $player['stats']['yellow'] = $tr->find('td', 9)->plaintext;
                $player['stats']['red'] = $tr->find('td', 10)->plaintext;
                $player['stats']['suspended'] = $tr->find('td', 11)->plaintext;
                $details[] = $player;
            }
        }
        return $details;
    }

    private static function startsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
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

