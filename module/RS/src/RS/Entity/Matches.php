<?php

namespace RS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matches
 *
 * @ORM\Table(name="matches", uniqueConstraints={@ORM\UniqueConstraint(name="matchid", columns={"matchid", "date", "hometeamid", "awayteamid"})})
 * @ORM\Entity
 */
class Matches
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
     * @ORM\Column(name="matchid", type="integer", nullable=true)
     */
    private $matchid;

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
     * @ORM\Column(name="hometeamid", type="integer", nullable=false)
     */
    private $hometeamid;

    /**
     * @var string
     *
     * @ORM\Column(name="hometeam", type="string", length=100, nullable=false)
     */
    private $hometeam;

    /**
     * @var integer
     *
     * @ORM\Column(name="awayteamid", type="integer", nullable=false)
     */
    private $awayteamid;

    /**
     * @var string
     *
     * @ORM\Column(name="awayteam", type="string", length=100, nullable=false)
     */
    private $awayteam;

    /**
     * @var integer
     *
     * @ORM\Column(name="goalshome", type="integer", nullable=false)
     */
    private $goalshome;

    /**
     * @var integer
     *
     * @ORM\Column(name="goalsaway", type="integer", nullable=false)
     */
    private $goalsaway;

    /**
     * @var string
     *
     * @ORM\Column(name="resulthome", type="string", length=1, nullable=false)
     */
    private $resulthome;

    /**
     * @var string
     *
     * @ORM\Column(name="resultaway", type="string", length=1, nullable=false)
     */
    private $resultaway;


    /**
     * Gets the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of matchid.
     *
     * @return integer
     */
    public function getMatchid()
    {
        return $this->matchid;
    }
    
    /**
     * Sets the value of matchid.
     *
     * @param integer $matchid the matchid
     *
     * @return self
     */
    public function setMatchid($matchid)
    {
        $this->matchid = $matchid;

        return $this;
    }

    /**
     * Gets the value of season.
     *
     * @return integer
     */
    public function getSeason()
    {
        return $this->season;
    }
    
    /**
     * Sets the value of season.
     *
     * @param integer $season the season
     *
     * @return self
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Gets the value of matchday.
     *
     * @return integer
     */
    public function getMatchday()
    {
        return $this->matchday;
    }
    
    /**
     * Sets the value of matchday.
     *
     * @param integer $matchday the matchday
     *
     * @return self
     */
    public function setMatchday($matchday)
    {
        $this->matchday = $matchday;

        return $this;
    }

    /**
     * Gets the value of date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Sets the value of date.
     *
     * @param \DateTime $date the date
     *
     * @return self
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Gets the value of hometeamid.
     *
     * @return integer
     */
    public function getHometeamid()
    {
        return $this->hometeamid;
    }
    
    /**
     * Sets the value of hometeamid.
     *
     * @param integer $hometeamid the hometeamid
     *
     * @return self
     */
    public function setHometeamid($hometeamid)
    {
        $this->hometeamid = $hometeamid;

        return $this;
    }

    /**
     * Gets the value of hometeam.
     *
     * @return string
     */
    public function getHometeam()
    {
        return $this->hometeam;
    }
    
    /**
     * Sets the value of hometeam.
     *
     * @param string $hometeam the hometeam
     *
     * @return self
     */
    public function setHometeam($hometeam)
    {
        $this->hometeam = $hometeam;

        return $this;
    }

    /**
     * Gets the value of awayteamid.
     *
     * @return integer
     */
    public function getAwayteamid()
    {
        return $this->awayteamid;
    }
    
    /**
     * Sets the value of awayteamid.
     *
     * @param integer $awayteamid the awayteamid
     *
     * @return self
     */
    public function setAwayteamid($awayteamid)
    {
        $this->awayteamid = $awayteamid;

        return $this;
    }

    /**
     * Gets the value of awayteam.
     *
     * @return string
     */
    public function getAwayteam()
    {
        return $this->awayteam;
    }
    
    /**
     * Sets the value of awayteam.
     *
     * @param string $awayteam the awayteam
     *
     * @return self
     */
    public function setAwayteam($awayteam)
    {
        $this->awayteam = $awayteam;

        return $this;
    }

    /**
     * Gets the value of goalshome.
     *
     * @return integer
     */
    public function getGoalshome()
    {
        return $this->goalshome;
    }
    
    /**
     * Sets the value of goalshome.
     *
     * @param integer $goalshome the goalshome
     *
     * @return self
     */
    public function setGoalshome($goalshome)
    {
        $this->goalshome = $goalshome;

        return $this;
    }

    /**
     * Gets the value of goalsaway.
     *
     * @return integer
     */
    public function getGoalsaway()
    {
        return $this->goalsaway;
    }
    
    /**
     * Sets the value of goalsaway.
     *
     * @param integer $goalsaway the goalsaway
     *
     * @return self
     */
    public function setGoalsaway($goalsaway)
    {
        $this->goalsaway = $goalsaway;

        return $this;
    }

    /**
     * Gets the value of resulthome.
     *
     * @return string
     */
    public function getResulthome()
    {
        return $this->resulthome;
    }
    
    /**
     * Sets the value of resulthome.
     *
     * @param string $resulthome the resulthome
     *
     * @return self
     */
    public function setResulthome($resulthome)
    {
        $this->resulthome = $resulthome;

        return $this;
    }

    /**
     * Gets the value of resultaway.
     *
     * @return string
     */
    public function getResultaway()
    {
        return $this->resultaway;
    }
    
    /**
     * Sets the value of resultaway.
     *
     * @param string $resultaway the resultaway
     *
     * @return self
     */
    public function setResultaway($resultaway)
    {
        $this->resultaway = $resultaway;

        return $this;
    }
}
