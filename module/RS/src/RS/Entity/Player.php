<?php
namespace RS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Players
 *
 * @ORM\Table(name="players")
 * @ORM\Entity
 */
class Player
{

    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $playerid;

    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
    */
    private $name;

    /**
     * @var string
     * 
     * @ORM\Column(name="country", type="string", length=3, nullable=true)
    */
    private $country;

    /**
     * @var string
     * 
     * @ORM\Column(name="language", type="string", length=100, nullable=true)
    */
    private $language;

    /**
     * @var decimal  
     * 
     * @ORM\Column(name="talent", type="decimal", precision=4, scale=2, nullable=false)
    */
    private $talent;
    
    /**
     * @param \Doctrine\Common\Collections\Collection $stats
     * @ORM\OneToMany(targetEntity="PlayerStats", mappedBy="player", cascade={"persist", "remove"})
     */
    private $stats;

    /**
     * @var team
     * @ORM\ManyToOne(targetEntity="Team",inversedBy="players", cascade={"persist"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     */
    private $team;


    public function __construct()
    {
        $this->stats = new ArrayCollection();
    }

    /**
     * Gets the value of playerid.
     *
     * @return integer
     */
    public function getPlayerid()
    {
        return $this->playerid;
    }
    
    /**
     * Sets the value of playerid.
     *
     * @param integer $playerid the playerid
     *
     * @return self
     */
    public function setPlayerid($playerid)
    {
        $this->playerid = $playerid;

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
     * Gets the value of language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    /**
     * Sets the value of language.
     *
     * @param string $language the language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Gets the value of talent.
     *
     * @return decimal
     */
    public function getTalent()
    {
        return $this->talent;
    }
    
    /**
     * Sets the value of talent.
     *
     * @param decimal $talent the talent
     *
     * @return self
     */
    public function setTalent($talent)
    {
        $this->talent = $talent;

        return $this;
    }

    /**
     * Gets the value of stats.
     *
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }
    
    /**
     * Sets the value of stats.
     *
     * @param mixed $stats the stats
     *
     * @return self
     */
    public function setStats($stats)
    {
        $this->stats = $stats;

        return $this;
    }

    /**
     * Gets the }).
     *
     * @return team
     */
    public function getTeam()
    {
        return $this->team;
    }
    
    /**
     * Sets the }).
     *
     * @param team $team the team
     *
     * @return self
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the value of name.
     *
     * @param string $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}