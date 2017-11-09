<?php

namespace AppBundle\Repository;


/**
 * RosterRepository
 */
class RosterRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllActive()
    {
        $qb = $this->createQueryBuilder('roster');
        return $qb
            ->where('roster.label in (:active_rosters)')
            ->setParameter('active_rosters', ['A', 'B', 'C', 'L'])
            ->getQuery()
            ->getResult();
    }
}