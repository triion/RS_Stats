<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

use RS\Scraper\TeamDetailsScraper;
use RS\Scraper\TeamFacilitiesScraper;
use RS\Scraper\TeamPlayersScraper;
use RS\Scraper\PlayerScraper;
use RS\Scraper\LeagueScraper;
use RS\Loader\RSLoader;

class StatsController extends AbstractActionController
{

    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function indexAction()
    {
        //$tps = new LeagueScraper("be");
        //$info = $tps->getScrapedInfo();
        //set_time_limit(0);

        //$loader = new RSLoader($this->getEntityManager());
        //$info = $loader->loadLeagueTeams("be");
        //$info = $loader->loadPlayers('911');

        //$loader->loadAllTeamDetails();
        /*$tfs = new TeamFacilitiesScraper("911");
        $facilities = $tfs->getScrapedInfo();



        $em = $this->getEntityManager();
        $teamRepo = $em->getRepository('RS\Entity\Team');
        $teams = $teamRepo->findAll();

        $team = $teams[0];*/        
        //\RS\Entity\Team::getTeamFromUpstream($this->getEntityManager(), 897);

        return new ViewModel(array("info"=>"Ran"));
    }

    public function streaksAction()
    {
        $seasonGet = $this->params()->fromQuery('season',null);
        if(is_numeric($seasonGet)) {
            $season = htmlspecialchars($seasonGet);
        } else {
            $season = 9;
        }

        $em = $this->getEntityManager();
        $resultsRepo = $em->getRepository('RS\Entity\Results');
        $results = $resultsRepo->findBy(array('season' => $season));

        $teams = $this->_calcStreakResults($results);
        $matchday = count($teams[0])-9;

        return new ViewModel(array("season"=>$season, "teams"=>$teams, "matchday"=>$matchday));
    }

    public function h2hAction()
    {
        $team1 = $this->params()->fromQuery('team1',null);
        $team2 = $this->params()->fromQuery('team2',null);

        if(!(isset($team1) && is_numeric($team1) && isset($team2) && is_numeric($team2)))
        {
         die();
        }
        $em = $this->getEntityManager();
        $q = $em->createQuery("select m from RS\Entity\Matches m where (m.hometeamid=$team1 AND m.awayteamid=$team2) OR (m.hometeamid=$team2 AND m.awayteamid=$team1) ORDER BY m.date DESC");
        $matches = $q->getResult();

        if($team1==$matches[0]->getHometeamid()) {
            $team1name = $matches[0]->getHometeam();
            $team2name = $matches[0]->getAwayteam();
        } else {
            $team2name = $matches[0]->getHometeam();
            $team1name = $matches[0]->getAwayteam();
        }
        $stats = $this->_calcH2HMatches($matches, $team1);

        return new ViewModel(array("team1"=>$team1, "team2"=>$team2, "team1name"=>$team1name, "team2name"=>$team2name, "stats"=>$stats));
    }

    private function _calcH2HMatches($matchesDB, $team1)
    {
        $stats = array();
        $agghome = 0;
        $aggaway = 0;
        $home = false;
        foreach($matchesDB as $matchDB)
        {
            $match = array();
            $match['season'] = $matchDB->getSeason();
            $match['date'] = $matchDB->getDate();
            if($team1==$matchDB->getHometeamid()) $home=true;
            $match['ishome'] = $home;
            if($home) {
                $class = $matchDB->getResulthome();
                $agghome += $matchDB->getGoalshome();
                $aggaway += $matchDB->getGoalsaway();
                $resultsHome[] = array($matchDB->getGoalshome(),$matchDB->getGoalsaway());
            }else{
                $class = $matchDB->getResultaway();      
                $agghome += $matchDB->getGoalsaway();
                $aggaway += $matchDB->getGoalshome();
                $resultsAway[] = array($matchDB->getGoalshome(),$matchDB->getGoalsaway());
            }
            $match['class'] = $class;
            $match['hometeam'] = $matchDB->getHometeam();
            $match['awayteam'] = $matchDB->getAwayteam();
            $match['goalshome'] = $matchDB->getGoalshome();
            $match['goalsaway'] = $matchDB->getGoalsaway();
            $home = false;

            $stats['matches'][] = $match;
        }
        $stats['agghome'] = $agghome;
        $stats['aggaway'] = $aggaway;
        $stats['aggresult'] = $this->getResultByGoals($agghome, $aggaway);
        $stats['avghome'] = round($agghome / count($matchesDB),1);
        $stats['avgaway'] = round($aggaway / count($matchesDB),1);
        $rhgoalsHome = 0;
        $rhgoalsAway = 0;
        foreach($resultsHome as $rHome) {
            $rhgoalsHome += $rHome[0];
            $rhgoalsAway += $rHome[1];
        }
        $stats['avghomeOnlyhome'] = round($rhgoalsHome / count($resultsHome ),1);
        $stats['avghomeOnlyaway'] = round($rhgoalsAway / count($resultsHome ),1);
        $stats['avghomeOnlyresult'] = $this->getResultByGoals($stats['avghomeOnlyhome'],$stats['avghomeOnlyaway']);
        $ragoalsHome = 0;
        $ragoalsAway = 0;
        foreach($resultsAway as $rAway) {
            $ragoalsHome += $rAway[0];
            $ragoalsAway += $rAway[1];
        }
        $stats['avgawayOnlyhome'] = round($ragoalsHome / count($resultsAway),1);
        $stats['avgawayOnlyaway'] = round($ragoalsAway / count($resultsAway),1);
        $stats['avgawayOnlyresult'] = $this->getResultByGoals($stats['avgawayOnlyaway'],$stats['avgawayOnlyhome']);

        return $stats;
    }

    private function getResultByGoals($home, $away)
    {
        if($home> $away) {
            return 'W';
        }else if ($home < $away) {
            return 'L';
        } else {
            return 'D';
        }
    }

    private function _calcStreakResults($results)
    {
        $teams = array();
        foreach($results as $result)
        {
            $teams[$result->getTeamid()]['teamname'] = $result->getTeamName();
            $teams[$result->getTeamid()][$result->getMatchday()] = array("result" => $result->getResult(), "home" => $result->getHome(), "goalsmade" => $result->getGoalsmade(), "goalsagainst" => $result->getGoalsagainst());
        }
    
        foreach($teams as &$team) {
            $maxwin = 0;
            $current_win = 0;
            $maxloss = 0;
            $current_loss = 0;
            $maxdraw = 0;
            $current_draw = 0;
            $longestNoLoss = 0;
            $current_noLoss = 0;
            $longestNoWin = 0;
            $current_noWin = 0;
            $points = 0;
            $wins = 0;
            $losses = 0;
            $draws = 0;
            $goalsmade = 0;
            $goalsagainst = 0;
            for($i=1; $i<=count($team)-1; $i++) {
                $goalsmade += $team[$i]['goalsmade'];
                $goalsagainst += $team[$i]['goalsagainst'];
                switch($team[$i]["result"]) {
                        case "W":
                            if($current_loss > $maxloss) $maxloss = $current_loss;
                            $current_los = 0;
                            if($current_draw > $maxdraw) $maxdraw = $current_draw;
                            $current_draw = 0;
                            if($current_noWin > $longestNoWin) $longestNoWin = $current_noWin;
                            $current_noWin = 0;
                            
                            $current_win++;
                            $current_noLoss++;
                            $points += 3;
                            $wins++;
                            break;
                            case "L":
                                if($current_win > $maxwin) $maxwin = $current_win;
                                $current_win = 0;
                                if($current_draw > $maxdraw) $maxdraw = $current_draw;
                                $current_draw = 0;
                                if($current_noLoss > $longestNoLoss) $longestNoLoss = $current_noLoss;
                                $current_noLoss = 0;
                                                        
                                $current_loss++;
                                $current_noWin++;
                                $losses++;
                                break;
                            case "D":
                                if($current_win > $maxwin) $maxwin = $current_win;
                                $current_win = 0;
                                if($current_loss > $maxloss) $maxloss = $current_loss;
                            $current_los = 0;
                            
                                $current_draw++;
                                $current_noLoss++;
                                $current_noWin++;
                                $points++;
                                $draws++;
                                break;
                    }
                    if($current_loss > $maxloss) $maxloss = $current_loss;
                    if($current_draw > $maxdraw) $maxdraw = $current_draw;
                    if($current_noWin > $longestNoWin) $longestNoWin = $current_noWin;
                    if($current_win > $maxwin) $maxwin = $current_win;
                    if($current_noLoss > $longestNoLoss) $longestNoLoss = $current_noLoss;
            }
            $team["streaks"] = array("maxwin" => $maxwin, "maxloss" => $maxloss, "maxdraw" => $maxdraw, "noLoss" => $longestNoLoss, "noWin" => $longestNoWin);
            $team["points"] = $points;
            $team["W"] = $wins;
            $team["L"] = $losses;
            $team["D"] = $draws;
            $team["goalsmade"] = $goalsmade;
            $team["goalsagainst"] = $goalsagainst;
            $team["goalsaldo"] = $goalsmade - $goalsagainst;
        }
        usort($teams, array($this,"compare_teams"));
        return $teams;
    }

    public static function compare_teams($a, $b)
    {
        if ($a["points"] == $b["points"]) {
            if($a["goalsaldo"] == $b["goalsaldo"]) {
                if($a["goalsmade"] == $b["goalsmade"]) {
                        return 0;
                    }else{
                        return ($a["goalsmade"] < $b["goalsmade"]) ? 1 : -1;
                    }
            } else {
                return ($a["goalsaldo"] < $b["goalsaldo"]) ? 1 : -1;
            }
            }   
        return ($a["points"] < $b["points"]) ? 1 : -1;
    }

    public function facilitiesAction()
    {
        return new ViewModel();
    }

    public function getEntityManager()
    {
        if(null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
}
