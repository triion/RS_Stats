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
use RS\Scraper\TeamTransfersScraper;

use RS\Loader\RSLoader;

class BatchController extends AbstractActionController
{

    /*
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    //protected $logger = $this->getServiceLocator()->get('logger'); 

    /*public function __construct()
    {
        $this->logger = $this->getServiceLocator()->get('logger'); 
    }*/

    public function indexAction()
    {
        set_time_limit(0);
        //$tps = new LeagueScraper("be");
        //$info = $tps->getScrapedInfo();
        //$logger->info('Running Batch/index'); 

        //$tts = new TeamTransfersScraper('897');
        //$transfers = $tts->getScrapedInfo();

        $loader = new RSLoader($this->getEntityManager());
        //$transfers = $loader->processTransfers('911');

        $country = 'be';
        $season = 14;
        $level = 1;
        $group = 1;
        $division = $loader->createNewDivision($country, $season, $level, $group);

        $info = $loader->loadLeagueTeams($division);

        //$info = $loader->loadLeagueTeams("be", 10);
        //$info = $loader->loadPlayers('897');

        //$loader->loadAllTeamDetails();
        /*$tfs = new TeamFacilitiesScraper("911");
        $facilities = $tfs->getScrapedInfo();



        $em = $this->getEntityManager();
        $teamRepo = $em->getRepository('RS\Entity\Team');
        $teams = $teamRepo->findAll();

        $team = $teams[0];*/        
        //\RS\Entity\Team::getTeamFromUpstream($this->getEntityManager(), 897);

        return new ViewModel(array("info"=>$info));
    }

    public function facilitiesAction()
    {
        return new ViewModel();
    }

    public function updatePlayers()
    {
        $loader = new RSLoader($this->getEntityManager());
        
    }

    public function getEntityManager()
    {
        if(null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
}
