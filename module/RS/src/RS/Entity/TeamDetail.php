<?php

namespace RS\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * TeamDetail
 *
 * @ORM\Table(name="team_details", uniqueConstraints={@ORM\UniqueConstraint(name="teamid", columns={"team_id", "date"})})
 * @ORM\Entity
 */
class TeamDetail
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
     *
     * @var team
     * @ORM\ManyToOne(targetEntity="Team",inversedBy="details", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     */
    private $team;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="season", type="integer", nullable=true)
     */
    private $season;

    /**
     * @var integer
     *
     * @ORM\Column(name="matchday", type="integer", nullable=true)
     */
    private $matchday;

    /**
     * @var integer
     *
     * @ORM\Column(name="popularity", type="integer", nullable=false)
     */
    private $popularity;

    /**
     * @var integer
     *
     * @ORM\Column(name="training", type="integer", nullable=false)
     */
    private $training;

    /**
     * @var integer
     *
     * @ORM\Column(name="scout", type="integer", nullable=false)
     */
    private $scout;

    /**
     * @var integer
     *
     * @ORM\Column(name="health", type="integer", nullable=false)
     */
    private $health;

    /**
     * @var integer
     *
     * @ORM\Column(name="youth", type="integer", nullable=false)
     */
    private $youth;

    /**
     * @var integer
     *
     * @ORM\Column(name="stadium", type="integer", nullable=false)
     */
    private $stadium;

    /**
     * @var integer
     *
     * @ORM\Column(name="fanshop", type="integer", nullable=false)
     */
    private $fanshop;

    /**
     * @var integer
     *
     * @ORM\Column(name="catering", type="integer", nullable=false)
     */
    private $catering;
    
    
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
     * Gets the value of team.
     *
     * @return Object Team
     */
    public function getTeam()
    {
        return $this->team;
    }
    
    /**
     * Sets the value of team.
     *
     * @param Object Team $team the team
     *
     * @return self
     */
    public function setTeam($team)
    {
        $this->team = $team;

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
    public function setDate()
    {
        $this->date = new \DateTime("now");

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
     * Gets the value of popularity.
     *
     * @return integer
     */
    public function getPopularity()
    {
        return $this->popularity;
    }
    
    /**
     * Sets the value of popularity.
     *
     * @param integer $popularity the popularity
     *
     * @return self
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * Gets the value of training.
     *
     * @return integer
     */
    public function getTraining()
    {
        return $this->training;
    }
    
    /**
     * Sets the value of training.
     *
     * @param integer $training the training
     *
     * @return self
     */
    public function setTraining($training)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Gets the value of scout.
     *
     * @return integer
     */
    public function getScout()
    {
        return $this->scout;
    }
    
    /**
     * Sets the value of scout.
     *
     * @param integer $scout the scout
     *
     * @return self
     */
    public function setScout($scout)
    {
        $this->scout = $scout;

        return $this;
    }

    /**
     * Gets the value of health.
     *
     * @return integer
     */
    public function getHealth()
    {
        return $this->health;
    }
    
    /**
     * Sets the value of health.
     *
     * @param integer $health the health
     *
     * @return self
     */
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Gets the value of youth.
     *
     * @return integer
     */
    public function getYouth()
    {
        return $this->youth;
    }
    
    /**
     * Sets the value of youth.
     *
     * @param integer $youth the youth
     *
     * @return self
     */
    public function setYouth($youth)
    {
        $this->youth = $youth;

        return $this;
    }

    /**
     * Gets the value of stadium.
     *
     * @return integer
     */
    public function getStadium()
    {
        return $this->stadium;
    }
    
    /**
     * Sets the value of stadium.
     *
     * @param integer $stadium the stadium
     *
     * @return self
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Gets the value of fanshop.
     *
     * @return integer
     */
    public function getFanshop()
    {
        return $this->fanshop;
    }
    
    /**
     * Sets the value of fanshop.
     *
     * @param integer $fanshop the fanshop
     *
     * @return self
     */
    public function setFanshop($fanshop)
    {
        $this->fanshop = $fanshop;

        return $this;
    }

    /**
     * Gets the value of catering.
     *
     * @return integer
     */
    public function getCatering()
    {
        return $this->catering;
    }
    
    /**
     * Sets the value of catering.
     *
     * @param integer $catering the catering
     *
     * @return self
     */
    public function setCatering($catering)
    {
        $this->catering = $catering;

        return $this;
    }

    public static function GetDetailsFromTeam(Team $team)
    {

    }
}