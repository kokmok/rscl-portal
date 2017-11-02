<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamCompetition
 *
 * @ORM\Table(name="team_competition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamCompetitionRepository")
 */
class TeamCompetition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Saison")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Competition")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TeamCompetition
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set team
     *
     * @param Team $team
     *
     * @return TeamCompetition
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set season
     *
     * @param Saison $season
     *
     * @return TeamCompetition
     */
    public function setSeason(Saison $season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return Saison
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set competition
     *
     * @param Competition $competition
     *
     * @return TeamCompetition
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }
}
