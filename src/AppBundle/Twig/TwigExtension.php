<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 29/09/17
 * Time: 14:54
 */
namespace AppBundle\Twig;

use AppBundle\Entity\MatchEvent;
use AppBundle\Lister\TypedProperty;
use Doctrine\DBAL\Types\Type;

class TwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('matchEventIcon', array($this, 'matchEventIcon')),
            new \Twig_SimpleFilter('typedProperty', array($this, 'typedProperty')),
        );
    }
    
    public function typedProperty($entity,TypedProperty $property){
        if (method_exists($entity,'get'.ucfirst($property->getName()))){
            $value = call_user_func([$entity,'get'.ucfirst($property->getName())]);
            switch ($property->getType()){
                case TypedProperty::TYPE_DATE:
                    return $value->format('Y-m-d');
                break;
                case TypedProperty::TYPE_DATETIME:
                    return $value->format('Y-m-d H:i:s');
                break;
                case TypedProperty::TYPE_NORMAL:
                default:
                    return $value;
                    break;
            }
        }
    }

    public function matchEventIcon($matchEventType)
    {
        $class = '';
        switch ($matchEventType){
            case MatchEvent::TYPE_GOAL :
                $class = 'fa fa-soccer-ball-o';
                break;
            case MatchEvent::TYPE_PENO :
                $class = 'fa fa-soccer-ball-o';
//                $class = 'fa fa-ambulance';
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