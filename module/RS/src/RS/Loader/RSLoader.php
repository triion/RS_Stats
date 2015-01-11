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

    public function processTransfers($teamid)
    {
        $info = array();
        $scraper = new Scraper\TeamTransfersScraper($teamid);
        $transfers = $scraper->getScrapedInfo();
        $team = $this->getTeamById($teamid);
        if(is_null($team)){
            return null;
        }
        $info[] = "Team found in DB: ".$team->getTeamName();
        foreach($transfers as $transfer)
        {
            $info[] = "\tProcessing transfer: ".$transfer['playername'];
            if($transfer['toTeamId']==$teamid)
            {
                $info[] = "\t\tIncoming transfer, skipping...";
                continue; // skip player if player is incoming tranfser (will be processed with loadPlayers)
            }
            $player = $this->em->find('RS\Entity\Player', $transfer['playerId']);
            if(is_null($player))
            { // player doesn't exist in DB (Reserve of other player)
                $info[] = "\t\tPlayer not found in DB...";
                continue;
            }
            $toTeam = $this->getTeamById($transfer['toTeamId']);
            if(!is_null($toTeam))
            { //Transfer is to another team in DB, keep records, but change the team.
                $info[] = "\t\tTransfer to KNOWN team ".$toTeam->getTeamName().", switching team...";
                $player->setTeam($toTeam);
                $toTeam->getPlayers()->add($player);
                $this->em->flush();
                continue;
            }
            // Player transfer to unknown team... removing...
            $info[] = "\t\tTransfer to UNKNOWN team, removing from DB";
            $this->em->remove($player);
            $this->em->flush();
        }

        return $info;
    }

    public function loadPlayers($teamid)
    {
        $info = array();
        $scraper = new Scraper\TeamPlayersScraper($teamid);
        $scrapedPlayers = $scraper->getScrapedInfo();
        $team = $this->getTeamById($teamid);
        if(is_null($team)){
            return null;
        }
        $info[] = "scrapedPlayers: ".var_export($scrapedPlayers, TRUE);
        $info[] = "Team found in DB: ".$team->getTeamName();
        foreach($scrapedPlayers as $scrapedPlayer)
        {
            $info[] = "\tParsing scrapedPlayer: ".$scrapedPlayer['name'];
            $player = $this->em->find('RS\Entity\Player', $scrapedPlayer['id']);
            if(is_null($player))
            {
                $info[] = "\tPlayer not found in DB, creating new...";
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
            
            $this->updatePlayer($player);
        }
        return $info;
    }

    public function updatePlayer(Entity\Player &$player)
    {
        $playerScraper = new Scraper\PlayerScraper($player->getPlayerid());
        $stats = $playerScraper->getScrapedInfo();
        
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

    public function loadAllTeamDetails()
    {
        $info = array();
        $teamRepo = $this->em->getRepository('RS\Entity\Team');
        $teams = $teamRepo->findAll();
        $info[] = "Loaded all Teams from DB";
        foreach($teams as $team)
        {
            $info[] = "\tLoading TeamDetails for ".$team->getTeamName();
            $info[] = $this->loadTeamDetails($team->getTeamid());
        }
        return $info;
    }

    public function loadTeamDetails($teamid, $firstCapture = false)
    {
        $info[] = array();
        $info[] = "Loading TeamDetails for ".$teamid;
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

        $new = false;
        $team = $this->getTeamById($teamid);

        //var_dump($team);
        
        if(is_null($team))
        {
            $info[] = "\tTeam not found in DB, creating new...";
            $team = new Entity\Team();
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

    public function loadLeagueTeams(Entity\Division $division)
    {
        $scraper = new Scraper\LeagueScraper($division);
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

            // Is division-team link new?
            // TODO: check contains works
            if(!$team->getDivisions()->contains($division))
            {
                $team->getDivisions()->add($division);
                $division->getTeams()->add($team);
            }
            
            $info[] = $msg;
            if($newTeam) {
                //persist new team
                $this->em->persist($team); 

                //Import details, facilities and players for new team
                $info[] = "\tLoading TeamDetails for new team ".$team->getTeamName();
                $info[] = $this->loadTeamDetails($team->getTeamid());
                $info[] = $this->loadPlayers($team->getTeamid());
            } 

            $this->em->flush();            
        }
        return $info;
    }
    
    public function createNewDivision($country, $season, $level, $group)
    {
        $query = $this->em->createQuery('SELECT d FROM RS\Entity\Division d WHERE d.country=:country 
                    AND d.season=:season AND d.level=:level AND d.group=:group');
        $query->setParameter('country', $country);
        $query->setParameter('season', $season);
        $query->setParameter('level', $level);
        $query->setParameter('group', $group);
        $division = $query->getOneOrNullResult();

        if(is_null($division))
        {
            $division = new Entity\Division();
            $division->setCountry($country);
            $division->setSeason($season);
            $division->setLevel($level);
            $division->setGroup($group);

            $this->em->persist($division);
        }

        return $division;
    }

    private function getTeamById($teamid)
    {
        $team = $this->em->find('RS\Entity\Team', $teamid);
        return $team;
    }
}