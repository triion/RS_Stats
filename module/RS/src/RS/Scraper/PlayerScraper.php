<?php
namespace RS\Scraper;

class PlayerScraper extends Scraper
{
    private $playerid;

    public function __construct($playerid)
    {
        $this->playerid = $playerid;
        parent::__construct();        
    }

    protected function getURL()
    {
        //$URL = "http://rs.local:8080/testdata/player-def2.txt";
        $URL = 'http://rockingsoccer.com/en/soccer/info/player-%1$s';
        return sprintf($URL, $this->getPlayerId());
    }

    protected function scrapeHTML()
    {
        $player = array();
        foreach($this->html->find('div#content') as $content)
        {
            $table = $content->find('table.vt_col1', 0);
            $trNumber = 0;
            $player['country'] = strtoupper($table->find('tr', $trNumber++)->find('td', 0)->find('img',0)->alt);
            $player['language'] = $table->find('tr', $trNumber++)->find('td', 0)->plaintext;
            $age = $table->find('tr', $trNumber++)->find('td', 0)->plaintext;

            //$player['age']['years'] = strstr($age, "year", TRUE);
            //$player['age']['weeks'] = substr(strstr($age, "weeks", TRUE), -2);
            //24year, 43weeks (94%)
            preg_match("/(\d+)year,\s(\d+)weeks\s.(\d+)\%./", $age, $age_matches);
            $player['age']['year'] = $age_matches[1];
            $player['age']['weeks'] = $age_matches[2];
            $player['age']['percentage'] = $age_matches[3];

            $startOfSeason = $table->find('tr', $trNumber)->find('th',0)->plaintext;
            if($startOfSeason=="Age at season start")
            {
                $trNumber++;
            }

            $player['position'] = $table->find('tr', $trNumber++)->find('td', 0)->plaintext;
            $player['stars'] = $table->find('tr', $trNumber++)->find('td', 0)->find('span', 0)->title;
            $player['stars_max'] = $player['stars'];
            if(PlayerScraper::startsWith($player['stars'], "Youth player:")) {
                    $startPosition = strpos($player['stars'], ":") + 1;
                    $tmpStars = substr($player['stars'], $startPosition);
                    $stars = explode(' - ', $tmpStars);
                    $player['stars'] = $stars[0];
                    $player['stars_max'] = $stars[1];
            }

            $player['specials'] = array();
            foreach($table->find('tr', $trNumber++)->find('td', 0)->find('span') as $special)
            {
                $player['specials'][] = trim($special->plaintext);
            }

            $fitnessWidth = $table->find('tr', $trNumber++)->find('td', 0)->find('div', 1)->style;
            $player['fitness'] = substr($fitnessWidth, 6, 2) / 40 * 100;

            /* TABLE WITH STATS */
            $table = $content->find('table.vt_col3', 0);
            $player['talent'] = $table->find('tr[class]', 0)->find('td', 0)->find('span', 0)->title;
            $player['scoring'] = $table->find('tr[class]', 0)->find('td', 1)->find('span', 0)->title;
            $player['attack'] = $table->find('tr[class]', 0)->find('td', 2)->find('span', 0)->title;

            $player['endurance'] = $table->find('tr[class]', 1)->find('td', 0)->find('span', 0)->title;
            $player['passing'] = $table->find('tr[class]', 1)->find('td', 1)->find('span', 0)->title;
            $player['midfield'] = $table->find('tr[class]', 1)->find('td', 2)->find('span', 0)->title;

            $player['power'] = $table->find('tr[class]', 2)->find('td', 0)->find('span', 0)->title;
            $player['dueling'] = $table->find('tr[class]', 2)->find('td', 1)->find('span', 0)->title;
            $player['defense'] = $table->find('tr[class]', 2)->find('td', 2)->find('span', 0)->title;

            $player['speed'] = $table->find('tr[class]', 3)->find('td', 0)->find('span', 0)->title;
            $player['blocking'] = $table->find('tr[class]', 3)->find('td', 1)->find('span', 0)->title;
            $player['goalkeeping'] = $table->find('tr[class]', 3)->find('td', 2)->find('span', 0)->title;
            
            $player['tactics'] = $table->find('tr[class]', 4)->find('td', 1)->find('span', 0)->title;
            $player['flank'] = trim($table->find('tr[class]', 4)->find('td', 2)->find('span', 0)->plaintext);
        }
        return $player;
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
    public function getPlayerid()
    {
        return $this->playerid;
    }
    
    /**
     * Sets the value of teamid.
     *
     * @param mixed $teamid the teamid
     *
     * @return self
     */
    public function setPlayerid($playerid)
    {
        $this->playerid = $playerid;

        return $this;
    }
}

