<?php

namespace RS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Division
 *
 * @ORM\Table(name="divisions", uniqueConstraints={@ORM\UniqueConstraint(name="PerSeason", columns={"country", "season", "level", "group"})})
 * @ORM\Entity
 */
class Division
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
     * @var string
     * 
     * @ORM\Column(name="country", type="string", length=3, nullable=false)
    */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="season", type="integer", nullable=false)
     */
    private $season;

    /**
     * @var integer
     * 
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @var integer
     * 
     * @ORM\Column(name="group", type="integer", nullable=false)
     */
    private $group;

    /**
     * @param \Doctrine\Common\Collections\Collection $teams
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="divisions", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="teams_divisions")
     */
    private $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
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
     * Gets the value of level.
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }
    
    /**
     * Sets the value of level.
     *
     * @param integer $level the level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Gets the value of group.
     *
     * @return integer
     */
    public function getGroup()
    {
        return $this->group;
    }
    
    /**
     * Sets the value of group.
     *
     * @param integer $group the group
     *
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Gets the value of teams.
     *
     * @return mixed
     */
    public function getTeams()
    {
        return $this->teams;
    }
    
    /**
     * Sets the value of teams.
     *
     * @param mixed $teams the teams
     *
     * @return self
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;

        return $this;
    }
}