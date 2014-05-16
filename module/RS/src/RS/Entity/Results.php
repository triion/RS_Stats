<?php

namespace RS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Results
 *
 * @ORM\Table(name="results", uniqueConstraints={@ORM\UniqueConstraint(name="matchid", columns={"matchid", "date", "teamid", "home"})}, indexes={@ORM\Index(name="teamid", columns={"teamid", "teamname"})})
 * @ORM\Entity
 */
class Results
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     */
    private $teamid;

    /**
     * @var string
     *
     * @ORM\Column(name="teamname", type="string", length=100, nullable=false)
     */
    private $teamname;

    /**
     * @var integer
     *
     * @ORM\Column(name="season", type="integer", nullable=false)
     */
    private $season;

    /**
     * @var integer
     *
     * @ORM\Column(name="matchday", type="integer", nullable=false)
     */
    private $matchday;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="matchid", type="integer", nullable=false)
     */
    private $matchid;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", length=1, nullable=false)
     */
    private $result;

    /**
     * @var boolean
     *
     * @ORM\Column(name="home", type="boolean", nullable=false)
     */
    private $home;

    /**
     * @var integer
     *
     * @ORM\Column(name="goalsmade", type="integer", nullable=false)
     */
    private $goalsmade;

    /**
     * @var integer
     *
     * @ORM\Column(name="goalsagainst", type="integer", nullable=false)
     */
    private $goalsagainst;


    // Getter and setter for $this->id
    public function getId()
    {
        return $this->id;
    }
    
    // Getter and setter for $this->teamid
    public function getTeamid()
    {
        return $this->teamid;
    }
    
    public function setTeamid($teamid)
    {
        $this->teamid = $teamid;
        return $this;
    }
    

    // Getter and setter for $this->teamname
    public function getTeamname()
    {
        return $this->teamname;
    }
    
    public function setTeamname($teamname)
    {
        $this->teamname = $teamname;
        return $this;
    }
    

    // Getter and setter for $this->season
    public function getSeason()
    {
        return $this->season;
    }
    
    public function setSeason($season)
    {
        $this->season = $season;
        return $this;
    }
    

    // Getter and setter for $this->matchday
    public function getMatchday()
    {
        return $this->matchday;
    }
    
    public function setMatchday($matchday)
    {
        $this->matchday = $matchday;
        return $this;
    }
    

    // Getter and setter for $this->date
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    

    // Getter and setter for $this->matchid
    public function getMatchid()
    {
        return $this->matchid;
    }
    
    public function setMatchid($matchid)
    {
        $this->matchid = $matchid;
        return $this;
    }
    

    // Getter and setter for $this->result
    public function getResult()
    {
        return $this->result;
    }
    
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }
    

    // Getter and setter for $this->home
    public function getHome()
    {
        return $this->home;
    }
    
    public function setHome($home)
    {
        $this->home = $home;
        return $this;
    }
     
    // Getter and setter for $this->goalsmade
    public function getGoalsmade()
    {
        return $this->goalsmade;
    }
    
    public function setGoalsmade($goalsmade)
    {
        $this->goalsmade = $goalsmade;
        return $this;
    }
    
    // Getter and setter for $this->goalsagainst
    public function getGoalsagainst()
    {
        return $this->goalsagainst;
    }
    
    public function setGoalsagainst($goalsagainst)
    {
        $this->goalsagainst = $goalsagainst;
        return $this;
    }
    
}
