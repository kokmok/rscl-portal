<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 3/02/18
 * Time: 14:25
 */

namespace AppBundle\Listener;

use AppBundle\Entity\Saison;
use Doctrine\ORM\EntityManager;

class EntityCustomListener{

    //JE suis pas completement con. J'ai du faire ça parce que un event traditionnel n'est pas firé si on ne fait qu'ajouter un joueur  la saison.
    public function preUpdate(EntityManager $em, $entity){
        
        if ($entity instanceof Saison){
            foreach ($entity->getPlayers() as $player){
                if (!$player->getSeasons()->contains($entity)){
                    $player->addSeason($entity);
                    $em->persist($player);
                }
            }
        }
    }
    

}