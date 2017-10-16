<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatchEvent
 *
 * @ORM\Table(name="match_event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchEventRepository")
 */
class MatchEvent
{
    
    const TYPE_YELLOW = 1;
    const TYPE_YELLOW_SECOND = 2;
    const TYPE_RED = 3;
    const TYPE_PLAYER_IN = 4;
    const TYPE_PLAYER_OUT = 5;
    const TYPE_GOAL = 6;
    const TYPE_PENO = 7;
    
    const TYPE_CHOICES = ['goal'=>self::TYPE_GOAL,'penalty'=>self::TYPE_PENO,'sortie'=>self::TYPE_PLAYER_OUT,'entrée'=>self::TYPE_PLAYER_IN,'jaune'=>self::TYPE_YELLOW,'deuxieme jaune'=>self::TYPE_YELLOW_SECOND,'rouge'=>self::TYPE_RED];
    
    use MigrableTrait;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="minute", type="integer")
     */
    private $minute;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @var MatchGame
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MatchGame",inversedBy="events")
     */
    private $match;
    /**
     * @var Player
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Player")
     */
    private $player;

    /**
     * @var string
     * @ORM\Column(type="string",length=128,nullable=true)
     */
    private $playerName;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team")
     */
    private $team;


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
     * Set minute
     *
     * @param integer $minute
     *
     * @return MatchEvent
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * Get minute
     *
     * @return int
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return MatchEvent
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    

    /**
     * Set match
     *
     * @param \AppBundle\Entity\MatchGame $match
     *
     * @return MatchEvent
     */
    public function setMatch(\AppBundle\Entity\MatchGame $match = null)
    {
        $this->match = $match;
        

        return $this;
    }

    /**
     * Get match
     *
     * @return \AppBundle\Entity\MatchGame
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set player
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return MatchEvent
     */
    public function setPlayer(\AppBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \AppBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set playerName
     *
     * @param string $playerName
     *
     * @return MatchEvent
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;

        return $this;
    }

    /**
     * Get playerName
     *
     * @return string
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * Set team
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return MatchEvent
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
