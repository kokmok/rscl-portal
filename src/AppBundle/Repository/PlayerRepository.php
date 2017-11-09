<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Roster;
use AppBundle\Entity\Saison;
use Doctrine\ORM\EntityRepository;

/**
 * PlayerRepository
 */
class PlayerRepository extends EntityRepository
{
    public function getQueryBuilderForPlayerAtSeason(Saison $season)
    {
        $qb = $this->createQueryBuilder('player');
        $qb->leftJoin('player.seasons', 'seasons')
            ->where($qb->expr()->in('seasons.id', [$season->getId()]));

        return $qb;
    }

    /**
     * @param Roster|Roster[]|null $rosters
     * @return array
     */
    public function findAllSorted($rosters = null)
    {
        $qb = $this->createQueryBuilder('player');

        if(!is_null($rosters)) {
            $qb = $qb
                ->where('player.roster in (:rosters)')
                ->setParameter('rosters', $rosters);
        }

        return $qb
            ->orderBy('player.type')
            ->addOrderBy('player.roster')
            ->addOrderBy('player.number')
            ->getQuery()
            ->getResult();
    }
}
