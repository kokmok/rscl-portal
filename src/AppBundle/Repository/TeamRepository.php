<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Team;
use Doctrine\ORM\EntityRepository;

/**
 * TeamRepository
 */
class TeamRepository extends EntityRepository
{
    /**
     * @param string $name
     * @return null|Team
     */
    public function findOneByName($name)
    {
        return $this->createQueryBuilder('team')
            ->where('team.name LIKE :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return null|Team[]
     */
    public function getProLeagueATeams()
    {
        $proLeagueA = $this->getEntityManager()->getRepository('AppBundle:Competition')->getProLeagueA();
        $activeSeason = $this->getEntityManager()->getRepository('AppBundle:Saison')->getActiveSeason();

        $qb = $this->createQueryBuilder('team');
        return $qb
            ->leftJoin('team.competitionsParticipations','team_competition')
            ->where('team_competition.competition = :competition')
            ->andWhere('team_competition.season = :season')
            ->setParameter('competition', $proLeagueA)
            ->setParameter('season', $activeSeason)
            ->getQuery()
            ->getResult();
    }

}
