<?php
namespace RS\Loader;

use RS\Scraper as Scraper;
use RS\Entity as Entity;

class RSLoader
{
    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
        set_time_limit(0);
    }

    public function loadPlayers($teamid)
    {
        $scraper = new Scraper\TeamPlayersScraper($teamid);
        $scrapedPlayers = $scraper->getScrapedInfo();
        $team = $this->em->find('RS\Entity\Team', $teamid);
        if(is_null($team)){
            return null;
        }

        foreach($scrapedPlayers as $scrapedPlayer)
        {
            $player = $this->em->find('RS\Entity\Player', $scrapedPlayer['id']);
            if(is_null($player))
            {
                $player = new Entity\Player();
                $player->setPlayerId($scrapedPlayer['id']);
                $player->setName($scrapedPlayer['name']);
                $player->setCountry($scrapedPlayer['country']);
                                
            }
            $player->setTeam($team);
            $playerScraper = new Scraper\PlayerScraper($player->getPlayerid());
            $stats = $playerScraper->getScrapedInfo();

            $player->setLanguage($stats['language']);
            $player->setTalent($stats['talent']);
            
            $playerStats = new Entity\PlayerStats();

            $playerStats->setPlayer($player);
            $playerStats->setDate();
            $playerStats->setAge(implode("#", $stats['age']));
            $playerStats->setPosition($stats['position']);
            $playerStats->setFlank($stats['flank']);
            $playerStats->setStars($stats['stars']);
            $playerStats->setStarsMax($stats['stars_max']);
            $playerStats->setSpecials(implode("#", $stats['specials']));
            $playerStats->setFitness($stats['fitness']);
            $playerStats->setSpeed($stats['speed']);
            $playerStats->setPower($stats['power']);
            $playerStats->setEndurance($stats['endurance']);
            $playerStats->setBlocking($stats['blocking']);
            $playerStats->setDueling($stats['dueling']);
            $playerStats->setPassing($stats['passing']);
            $playerStats->setScoring($stats['scoring']);
            $playerStats->setTactics($stats['tactics']);
            $playerStats->setGoalkeeping($stats['goalkeeping']);
            $playerStats->setDefending($stats['defense']);
            $playerStats->setMidfield($stats['midfield']);
            $playerStats->setAttacking($stats['attack']);
            $playerStats->setMatches($scrapedPlayer['stats']['matches']);
            $playerStats->setGoals($scrapedPlayer['stats']['goals']);
            $playerStats->setAssists($scrapedPlayer['stats']['assists']);
            $playerStats->setCleansheets($scrapedPlayer['stats']['cleansheet']);
            $playerStats->setYellowCards($scrapedPlayer['stats']['yellow']);
            $playerStats->setRedCards($scrapedPlayer['stats']['red']);
            $playerStats->setSuspended($scrapedPlayer['stats']['suspended']);
            $playerStats->setNT($scrapedPlayer['isNT']);

            $player->getStats()->add($playerStats);

            $this->em->persist($player);
            $this->em->flush();
        }

    }

    public function loadAllTeamDetails()
    {
        $teamRepo = $this->em->getRepository('RS\Entity\Team');
        $teams = $teamRepo->findAll();

        foreach($teams as $team)
        {
            $this->loadTeamDetails($team->getTeamid());
        }
    }

    public function loadTeamDetails($teamid)
    {
        $teamdetail = new Entity\TeamDetail();
        $tds = new Scraper\TeamDetailsScraper($teamid);
        $details = $tds->getScrapedInfo();

        $teamdetail->setDate();
        $teamdetail->setPopularity($details['popularity']);

        $tfs = new Scraper\TeamFacilitiesScraper($teamid);
        $facilities = $tfs->getScrapedInfo();

        $teamdetail->setTraining($facilities["training complex"]);
        $teamdetail->setScout($facilities["scout's office"]);
        $teamdetail->setHealth($facilities["health center"]);
        $teamdetail->setYouth($facilities["youth center"]);
        $teamdetail->setStadium($facilities["stadium"]);
        $teamdetail->setFanshop($facilities["fanshop"]);
        $teamdetail->setCatering($facilities["catering"]);
        $teamdetail->setDate();

        $new = false;
        $team = $this->em->find('RS\Entity\Team', $teamid);

        //var_dump($team);
        
        if(is_null($team))
        {
            $team = new Team();
            $team->setTeamid($teamid);
            $team->setTeamname($details['name']);
            $team->setCountry($details['country']);
            $team->setManager($details['manager']);
            $new = true;
        }

        $teamdetail->setTeam($team);
        $team->getDetails()->add($teamdetail);
        
        if($new) {
          $this->em->persist($team); 
        } 

        $this->em->flush(); 
    }
    
    public function loadLeagueTeams($countryCode, $league = 9, $level = 1, $group = 1)
    {
        $scraper = new Scraper\LeagueScraper($countryCode, $league, $level, $group);
        $scrapedTeams = $scraper->getScrapedInfo();

        $info = array();
        foreach($scrapedTeams as $scrapedTeam)
        {
            $newTeam = false;
            $team = $this->getTeamById($scrapedTeam['id']);
            $msg = "Updating team: ". $scrapedTeam['id'];
            if(is_null($team))
            {
                $msg = "Adding new Team: " . $scrapedTeam['id'];
                $team = new Entity\Team();
                $team->setTeamid($scrapedTeam['id']);
                $newTeam = true;
            }
            $msg .= " - " . $scrapedTeam['name'];
            $team->setTeamname($scrapedTeam['name']);
            $team->setCountry($scrapedTeam['country']);
            $team->setManager($scrapedTeam['manager']);
            if($newTeam) {
                //Import details, facilities and players
                $this->em->persist($team); 
            } 

            $this->em->flush();
            $info[] = $msg;
        }
        return $info;
    }

    private function getTeamById($teamid)
    {
        $team = $this->em->find('RS\Entity\Team', $teamid);
        return $team;
    }
}