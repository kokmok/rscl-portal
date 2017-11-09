<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 * @UniqueEntity(fields="name", message="A team already exists with this name.")
 */
class Team
{
    use MigrableTrait;
    use HasPicture;
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
     * @ORM\Column(name="name", type="string", length=64, unique=true)
     */
    private $name;

    /**
     * @var TeamCompetition
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamCompetition",mappedBy="team")
     */
    private $competitionsParticipations;
    
    public function __toString()
    {
        return $this->name;
    }


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
     * @return Team
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
     * Constructor
     */
    public function __construct()
    {
        $this->competitionsParticipations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add competitionsParticipation
     *
     * @param \AppBundle\Entity\TeamCompetition $competitionsParticipation
     *
     * @return Team
     */
    public function addCompetitionsParticipation(\AppBundle\Entity\TeamCompetition $competitionsParticipation)
    {
        $this->competitionsParticipations[] = $competitionsParticipation;

        return $this;
    }

    /**
     * Remove competitionsParticipation
     *
     * @param \AppBundle\Entity\TeamCompetition $competitionsParticipation
     */
    public function removeCompetitionsParticipation(\AppBundle\Entity\TeamCompetition $competitionsParticipation)
    {
        $this->competitionsParticipations->removeElement($competitionsParticipation);
    }

    /**
     * Get competitionsParticipations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitionsParticipations()
    {
        return $this->competitionsParticipations;
    }
}
