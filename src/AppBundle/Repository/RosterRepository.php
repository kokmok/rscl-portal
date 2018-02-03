<?php
namespace AppBundle\Repository;

use Doctrine\ORM\QueryBuilder;


/**
 * RosterRepository
 */
class RosterRepository extends \Doctrine\ORM\EntityRepository
{
    
    const DEFAULT_ALIAS = 'roaster';
    
    public function findAllActive()
    {
        $qb = $this->filterActiveQb();
        $this->filterActiveQb($qb);
        return $qb
            ->getQuery()
            ->getResult();
    }
    
    public function filterActiveQb(){
        $qb = $this->createQueryBuilder(self::DEFAULT_ALIAS);
        $qb->where(self::DEFAULT_ALIAS.'.label in (:active_rosters)')
            ->setParameter('active_rosters', ['A', 'B', 'C', 'L']);
        
        return $qb;
    }
}