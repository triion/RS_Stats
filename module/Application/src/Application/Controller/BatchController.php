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

class BatchController extends AbstractActionController
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
