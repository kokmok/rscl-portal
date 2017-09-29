<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 29/09/17
 * Time: 14:54
 */
namespace AppBundle\Twig;

use AppBundle\Entity\MatchEvent;

class TwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('matchEventIcon', array($this, 'matchEventIcon')),
        );
    }

    public function matchEventIcon($matchEventType)
    {
        $class = '';
        switch ($matchEventType){
            case MatchEvent::TYPE_GOAL :
                $class = 'fa fa-soccer-ball-o';
            break;
            case MatchEvent::TYPE_INJURY :
                $class = 'fa fa-ambulance';
            break;
            case MatchEvent::TYPE_PLAYER_IN :
                $class = 'fa  fa-arrow-up';
            break;
            case MatchEvent::TYPE_PLAYER_OUT :
                $class = 'fa  fa-arrow-down';
            break;
            case MatchEvent::TYPE_RED :
                $class = 'fa fa-square red-text';
            break;
            case MatchEvent::TYPE_YELLOW :
            case MatchEvent::TYPE_YELLOW_SECOND :
                $class = 'fa fa-square yellow-text';
            break;
        }
        
        $icon = '<i class="'.$class.'"></i>';
        if (MatchEvent::TYPE_YELLOW_SECOND == $matchEventType){
            $icon.=$icon;
        }
        
        return $icon;
    }
    

}