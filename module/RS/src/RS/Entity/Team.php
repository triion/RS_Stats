<?php

namespace RS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity
 */
class Team
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $teamid;
    
    /**
     * @var string
     *
     * @ORM\Column(name="teamname", type="string", length=100, nullable=false)
     */
    private $teamname;

    /**
     * @var string
     *
     * @ORM\Column(name="manager", type="string", length=100, nullable=true)
     */
    private $manager;

    /**
     * @var string
     * 
     * @ORM\Column(name="country", type="string", length=2, nullable=true)
    */
    private $country;

    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @ORM\OneToMany(targetEntity="TeamDetail", mappedBy="team",cascade={"persist", "remove"})
     * @ORM\OrderBy({"date" = "DESC"})
     */
    private $details;

    /**
     * @param \Doctrine\Common\Collections\Collection $property
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team",cascade={"persist", "remove"})
     */
    private $players;

    /**
     *
     * @var division
     * @ORM\ManyToMany(targetEntity="Division", mappedBy="teams", cascade={"persist"})
     * @ORM\OrderBy({"season" = "DESC"})
     */
    private $divisions;


    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->divisions = new ArrayCollection();
    }

    /**
     * Gets the value of teamid.
     *
     * @return integer
     */
    public function getTeamid()
    {
        return $this->teamid;
    }
    
    /**
     * Sets the value of teamid.
     *
     * @param integer $teamid the teamid
     *
     * @return self
     */
    public function setTeamid($teamid)
    {
        $this->teamid = $teamid;

        return $this;
    }

    /**
     * Gets the value of teamname.
     *
     * @return string
     */
    public function getTeamname()
    {
        return $this->teamname;
    }
    
    /**
     * Sets the value of teamname.
     *
     * @param string $teamname the teamname
     *
     * @return self
     */
    public function setTeamname($teamname)
    {
        $this->teamname = $teamname;

        return $this;
    }

    /**
     * Gets the value of details.
     *
     * @return Collection
     */
    public function getDetails()
    {
        return $this->details;
    }
    
    /**
     * Sets the value of details.
     *
     * @param Collection $details the details
     *
     * @return self
     */
    public function setDetails(Collection $details)
    {
        $this->details = $details;

        return $this;
    }

    public function addDetail(TeamDetail $detail)
    {
        $this->details[] = $detail;

        return $this;
    }

     /**
     * Gets the value of country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Sets the value of country.
     *
     * @param string $country the country
     *
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Gets the value of players.
     *
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }
    
    /**
     * Sets the value of players.
     *
     * @param mixed $players the players
     *
     * @return self
     */
    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }

    /**
     * Gets the value of manager.
     *
     * @return string
     */
    public function getManager()
    {
        return $this->manager;
    }
    
    /**
     * Sets the value of manager.
     *
     * @param string $manager the manager
     *
     * @return self
     */
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }


    public static function getTeamFromUpstream(\Doctrine\ORM\EntityManager $em, $teamid)
    {
        $teamdetail = new TeamDetail();
        $tds = new \RS\Scraper\TeamDetailsScraper($teamid);
        $details = $tds->getScrapedInfo();

        $teamdetail->setDate();
        $teamdetail->setPopularity($details['popularity']);

        $tfs = new \RS\Scraper\TeamFacilitiesScraper($teamid);
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
        $team = $em->find('RS\Entity\Team', $teamid);

        //var_dump($team);
        
        if(is_null($team))
        {
            $team = new Team();
            $team->setTeamid($teamid);
            $team->setTeamname($details['name']);
            $team->setCountry($details['country']);
            $new = true;
        }

        $teamdetail->setTeam($team);
        $team->getDetails()->add($teamdetail);
        
        if($new) {
          $em->persist($team); 
        } 

        $em->flush(); 
    }
}