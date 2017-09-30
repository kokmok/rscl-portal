<?php

namespace AppBundle\Form;

use AppBundle\Entity\MatchEvent;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use AppBundle\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchEventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minute',NumberType::class,['scale'=>0,'attr'=>['max'=>120,"min"=>0]])
            ->add('type',ChoiceType::class,['choices'=>MatchEvent::TYPE_CHOICES])
            ->add('playerName',null,['required'=>false,'attr'=>['placeholder'=>"Ne mettre le nom que si c'est un joueur de l'autre équipe"]])
            ->add('player',EntityType::class,['required'=>false,'class'=>Player::class,
                'query_builder' => function (PlayerRepository $er) use ($builder) {
                    return $er->getQueryBuilderForPlayerAtSeason($builder->getData()->getMatch()->getSaison());
                }])
            ->add('team',EntityType::class,['class'=>Team::class,'choices'=>[$builder->getData()->getMatch()->getAwayTeam(),$builder->getData()->getMatch()->getHomeTeam()]])
            ->add('Envoyer',SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MatchEvent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_matchevent';
    }


}
