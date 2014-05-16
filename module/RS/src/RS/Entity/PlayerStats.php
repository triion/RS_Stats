<?php
namespace RS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PlayerStats
 *
 * @ORM\Table(name="playerStats")
 * @ORM\Entity
 */
class PlayerStats
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     *
     * @var player
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="stats", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string (years#weeks#percentage)
     * 
     * @ORM\Column(name="age", type="string", length=10, nullable=false)
    */
    private $age;

    /**
     * @var string  
     * 
     * @ORM\Column(name="position", type="string", length=10, nullable=false)
    */
    private $position;

    /**
     * @var string (/ as separator)  
     * 
     * @ORM\Column(name="flank", type="string", length=10, nullable=false)
    */
    private $flank;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="stars", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $stars;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="stars_max", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $starsMax;

    /**
     * @var string  
     * 
     * @ORM\Column(name="specials", type="string", length=255, nullable=true)
    */
    private $specials;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="fitness", type="decimal", precision=5, scale=2, nullable=false)
    */
    private $fitness;

    //STATS
    /**
     * @var decimal  
     * 
     * @ORM\Column(name="speed", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $speed;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="power", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $power;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="endurance", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $endurance;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="blocking", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $blocking;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="dueling", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $dueling;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="passing", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $passing;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="scoring", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $scoring;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="tactics", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $tactics;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="goalkeeping", type="integer", nullable=false)
    */
    private $goalkeeping;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="defending", type="integer", nullable=false)
    */
    private $defending;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="midfield", type="integer", nullable=false)
    */
    private $midfield;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="attacking", type="integer", nullable=false)
    */
    private $attacking;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="matches", type="integer", nullable=true)
    */
    private $matches;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="goals", type="integer", nullable=true)
    */
    private $goals;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="assists", type="integer", nullable=true)
    */
    private $assists;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="cleansheets", type="integer", nullable=true)
    */
    private $cleansheets;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="yellowCards", type="integer", nullable=true)
    */
    private $yellowCards;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="redCards", type="integer", nullable=true)
    */
    private $redCards;

    /**
     * @var integer  
     * 
     * @ORM\Column(name="suspended", type="integer", nullable=true)
    */
    private $suspended;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="NT", type="boolean", nullable=true)
     */
    private $NT;

    public function __construct()
    {

    }

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
     * Gets the }).
     *
     * @return player
     */
    public function getPlayer()
    {
        return $this->player;
    }
    
    /**
     * Sets the }).
     *
     * @param player $player the player
     *
     * @return self
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;

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
     * Gets the value of age.
     *
     * @return string (years#weeks#percentage)
     */
    public function getAge()
    {
        return $this->age;
    }
    
    /**
     * Sets the value of age.
     *
     * @param string (years#weeks#percentage) $age the age
     *
     * @return self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Gets the value of position.
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
    
    /**
     * Sets the value of position.
     *
     * @param string $position the position
     *
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Gets the value of flank.
     *
     * @return string (/ as separator)
     */
    public function getFlank()
    {
        return $this->flank;
    }
    
    /**
     * Sets the value of flank.
     *
     * @param string (/ as separator) $flank the flank
     *
     * @return self
     */
    public function setFlank($flank)
    {
        $this->flank = $flank;

        return $this;
    }

    /**
     * Gets the value of stars.
     *
     * @return decimal
     */
    public function getStars()
    {
        return $this->stars;
    }
    
    /**
     * Sets the value of stars.
     *
     * @param decimal $stars the stars
     *
     * @return self
     */
    public function setStars($stars)
    {
        if(empty($stars)) $stars = 0;
        $this->stars = $stars;

        return $this;
    }

    /**
     * Gets the value of specials.
     *
     * @return string
     */
    public function getSpecials()
    {
        return $this->specials;
    }
    
    /**
     * Sets the value of specials.
     *
     * @param string $specials the specials
     *
     * @return self
     */
    public function setSpecials($specials)
    {
        $this->specials = $specials;

        return $this;
    }

    /**
     * Gets the value of fitness.
     *
     * @return decimal
     */
    public function getFitness()
    {
        return $this->fitness;
    }
    
    /**
     * Sets the value of fitness.
     *
     * @param decimal $fitness the fitness
     *
     * @return self
     */
    public function setFitness($fitness)
    {
        if(empty($fitness)) $fitness = 0;
        $this->fitness = $fitness;

        return $this;
    }

    /**
     * Gets the value of speed.
     *
     * @return decimal
     */
    public function getSpeed()
    {
        return $this->speed;
    }
    
    /**
     * Sets the value of speed.
     *
     * @param decimal $speed the speed
     *
     * @return self
     */
    public function setSpeed($speed)
    {
        if(empty($speed)) $speed = 0;
        $this->speed = $speed;

        return $this;
    }

    /**
     * Gets the value of power.
     *
     * @return decimal
     */
    public function getPower()
    {
        return $this->power;
    }
    
    /**
     * Sets the value of power.
     *
     * @param decimal $power the power
     *
     * @return self
     */
    public function setPower($power)
    {
        if(empty($power)) $power = 0;
        $this->power = $power;

        return $this;
    }

    /**
     * Gets the value of endurance.
     *
     * @return decimal
     */
    public function getEndurance()
    {
        return $this->endurance;
    }
    
    /**
     * Sets the value of endurance.
     *
     * @param decimal $endurance the endurance
     *
     * @return self
     */
    public function setEndurance($endurance)
    {
        if(empty($endurance)) $endurance = 0;
        $this->endurance = $endurance;

        return $this;
    }

    /**
     * Gets the value of blocking.
     *
     * @return decimal
     */
    public function getBlocking()
    {
        return $this->blocking;
    }
    
    /**
     * Sets the value of blocking.
     *
     * @param decimal $blocking the blocking
     *
     * @return self
     */
    public function setBlocking($blocking)
    {
        if(empty($blocking)) $blocking = 0;
        $this->blocking = $blocking;

        return $this;
    }

    /**
     * Gets the value of dueling.
     *
     * @return decimal
     */
    public function getDueling()
    {
        return $this->dueling;
    }
    
    /**
     * Sets the value of dueling.
     *
     * @param decimal $dueling the dueling
     *
     * @return self
     */
    public function setDueling($dueling)
    {
        if(empty($dueling)) $dueling = 0;
        $this->dueling = $dueling;

        return $this;
    }

    /**
     * Gets the value of passing.
     *
     * @return decimal
     */
    public function getPassing()
    {
        return $this->passing;
    }
    
    /**
     * Sets the value of passing.
     *
     * @param decimal $passing the passing
     *
     * @return self
     */
    public function setPassing($passing)
    {
        if(empty($passing)) $passing = 0;
        $this->passing = $passing;

        return $this;
    }

    /**
     * Gets the value of scoring.
     *
     * @return decimal
     */
    public function getScoring()
    {
        return $this->scoring;
    }
    
    /**
     * Sets the value of scoring.
     *
     * @param decimal $scoring the scoring
     *
     * @return self
     */
    public function setScoring($scoring)
    {
        if(empty($scoring)) $scoring = 0;
        $this->scoring = $scoring;

        return $this;
    }

    /**
     * Gets the value of tactics.
     *
     * @return decimal
     */
    public function getTactics()
    {
        return $this->tactics;
    }
    
    /**
     * Sets the value of tactics.
     *
     * @param decimal $tactics the tactics
     *
     * @return self
     */
    public function setTactics($tactics)
    {
        if(empty($tactics)) $tactics = 0;
        $this->tactics = $tactics;

        return $this;
    }

    /**
     * Gets the value of goalkeeping.
     *
     * @return integer
     */
    public function getGoalkeeping()
    {
        return $this->goalkeeping;
    }
    
    /**
     * Sets the value of goalkeeping.
     *
     * @param integer $goalkeeping the goalkeeping
     *
     * @return self
     */
    public function setGoalkeeping($goalkeeping)
    {
        if(empty($goalkeeping)) $goalkeeping = 0;
        $this->goalkeeping = $goalkeeping;

        return $this;
    }

    /**
     * Gets the value of defending.
     *
     * @return integer
     */
    public function getDefending()
    {
        return $this->defending;
    }
    
    /**
     * Sets the value of defending.
     *
     * @param integer $defending the defending
     *
     * @return self
     */
    public function setDefending($defending)
    {
        if(empty($defending)) $defending = 0;
        $this->defending = $defending;

        return $this;
    }

    /**
     * Gets the value of midfield.
     *
     * @return integer
     */
    public function getMidfield()
    {
        return $this->midfield;
    }
    
    /**
     * Sets the value of midfield.
     *
     * @param integer $midfield the midfield
     *
     * @return self
     */
    public function setMidfield($midfield)
    {
        if(empty($midfield)) $midfield = 0;
        $this->midfield = $midfield;

        return $this;
    }

    /**
     * Gets the value of attacking.
     *
     * @return integer
     */
    public function getAttacking()
    {
        return $this->attacking;
    }
    
    /**
     * Sets the value of attacking.
     *
     * @param integer $attacking the attacking
     *
     * @return self
     */
    public function setAttacking($attacking)
    {
        if(empty($attacking)) $attacking = 0;
        $this->attacking = $attacking;

        return $this;
    }

    /**
     * Gets the value of matches.
     *
     * @return integer
     */
    public function getMatches()
    {
        return $this->matches;
    }
    
    /**
     * Sets the value of matches.
     *
     * @param integer $matches the matches
     *
     * @return self
     */
    public function setMatches($matches)
    {
        if(empty($matches)) $matches = 0;
        $this->matches = $matches;

        return $this;
    }

    /**
     * Gets the value of goals.
     *
     * @return integer
     */
    public function getGoals()
    {
        return $this->goals;
    }
    
    /**
     * Sets the value of goals.
     *
     * @param integer $goals the goals
     *
     * @return self
     */
    public function setGoals($goals)
    {
        if(empty($goals)) $goals = 0;
        $this->goals = $goals;

        return $this;
    }

    /**
     * Gets the value of assists.
     *
     * @return integer
     */
    public function getAssists()
    {
        return $this->assists;
    }
    
    /**
     * Sets the value of assists.
     *
     * @param integer $assists the assists
     *
     * @return self
     */
    public function setAssists($assists)
    {
        if(empty($assists)) $assists = 0;
        $this->assists = $assists;

        return $this;
    }

    /**
     * Gets the value of yellowCards.
     *
     * @return integer
     */
    public function getYellowCards()
    {
        return $this->yellowCards;
    }
    
    /**
     * Sets the value of yellowCards.
     *
     * @param integer $yellowCards the yellow cards
     *
     * @return self
     */
    public function setYellowCards($yellowCards)
    {
        if(empty($yellowCards)) $yellowCards = 0;
        $this->yellowCards = $yellowCards;

        return $this;
    }

    /**
     * Gets the value of redCards.
     *
     * @return integer
     */
    public function getRedCards()
    {
        return $this->redCards;
    }
    
    /**
     * Sets the value of redCards.
     *
     * @param integer $redCards the red cards
     *
     * @return self
     */
    public function setRedCards($redCards)
    {
        if(empty($redCards)) $redCards = 0;
        $this->redCards = $redCards;

        return $this;
    }

    /**
     * Gets the value of suspended.
     *
     * @return integer
     */
    public function getSuspended()
    {
        return $this->suspended;
    }
    
    /**
     * Sets the value of suspended.
     *
     * @param integer $suspended the suspended
     *
     * @return self
     */
    public function setSuspended($suspended)
    {
        if(empty($suspended)) $suspended = 0;
        $this->suspended = $suspended;

        return $this;
    }

    /**
     * Gets the value of cleansheets.
     *
     * @return integer
     */
    public function getCleansheets()
    {
        return $this->cleansheets;
    }
    
    /**
     * Sets the value of cleansheets.
     *
     * @param integer $cleansheets the cleansheets
     *
     * @return self
     */
    public function setCleansheets($cleansheets)
    {
        if(empty($cleansheets)) $cleansheets = 0;
        $this->cleansheets = $cleansheets;

        return $this;
    }

    /**
     * Gets the value of NT.
     *
     * @return boolean
     */
    public function isNT()
    {
        return $this->NT;
    }
    
    /**
     * Sets the value of NT.
     *
     * @param boolean $NT the n t
     *
     * @return self
     */
    public function setNT($NT)
    {
        $this->NT = $NT;
        return $this;
    }

    /**
     * Gets the value of starsMax.
     *
     * @return decimal
     */
    public function getStarsMax()
    {
        return $this->starsMax;
    }
    
    /**
     * Sets the value of starsMax.
     *
     * @param decimal $starsMax the stars max
     *
     * @return self
     */
    public function setStarsMax($starsMax)
    {
        if(empty($starsMax)) $starsMax = 0;
        $this->starsMax = $starsMax;

        return $this;
    }

    /**
     * Gets the value of NT.
     *
     * @return boolean
     */
    public function getNT()
    {
        return $this->NT;
    }
    }