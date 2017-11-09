<?php

namespace AppBundle\Repository;

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
}
