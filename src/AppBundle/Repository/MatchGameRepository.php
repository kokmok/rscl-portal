<?php

namespace AppBundle\Repository;

use Doctrine\DBAL\Types\DateTimeType;

/**
 * MatchGameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatchGameRepository extends \Doctrine\ORM\EntityRepository
{
    public function findLast($limit = 5){
        $qb = $this->createQueryBuilder('match_game');
        $yesterday = new \DateTime();
        $yesterday->modify('-1day');
        $qb->where('match_game.date<:yesterday')
            ->setParameter('yesterday',$yesterday,DateTimeType::DATETIME)
            ->setMaxResults($limit)
            ->orderBy('match_game.date','DESC')
        
        ;
        
        return $qb->getQuery()->getResult(); 
        
    }
    public function findNext(){
        $qb = $this->createQueryBuilder('match_game');
        $now = new \DateTime();
        $now->modify('-105minutes');
        
        $qb->where('match_game.date>:now')
            ->setParameter('now',$now,DateTimeType::DATETIME)
            ->orderBy('match_game.date','ASC')

        ;

        return $qb->getQuery()->getOneOrNullResult();

    }
}
