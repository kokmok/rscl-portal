<?php

namespace AppBundle\Form;

use AppBundle\Entity\Arbitre;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Competition;
use AppBundle\Entity\Player;
use AppBundle\Entity\Saison;
use AppBundle\Entity\Team;
use AppBundle\Repository\ArbitreRepository;
use AppBundle\Repository\CoachRepository;
use AppBundle\Repository\PlayerRepository;
use AppBundle\Repository\SaisonRepository;
use AppBundle\Repository\TeamCompetitionRepository;
use AppBundle\Repository\TeamRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchGameType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('name')
            ->add('date',DateTimeType::class,['attr'=>['class'=>'datepicker'],'widget' => 'single_text','format'=>'dd-MM-yyyy HH:mm'])
            ->add('description')
            ->add('competition', EntityType::class, ['class' => Competition::class])
            ->add('arbitre', EntityType::class, [
                'class' => Arbitre::class,
                'query_builder' => function (ArbitreRepository $ar) {
                    return $ar->getActiveFirstQueryBuilder();
                }
            ])
            ->add('saison', EntityType::class, [
                'class' => Saison::class,
                'query_builder' => function (SaisonRepository $sr) {
                    return $sr->getActiveFirstQueryBuilder();
                }
            ])
            ->add('homeTeam',EntityType::class, [
                'class' => Team::class,
                'preferred_choices' => function($val,$key) use ($options){
                    return in_array($val->getId(),$options['preferred_teams']);
                }
            ])
            ->add('awayTeam',EntityType::class, [
                'class' => Team::class,
                'preferred_choices' => function($val,$key) use ($options){
                    return in_array($val->getId(),$options['preferred_teams']);
                }
            ])
            ->add('coach',EntityType::class, [
                'class' => Coach::class,
                'query_builder' => function (CoachRepository $cr) {
                    return $cr->getActiveFirstQueryBuilder();
                }
            ]);
        if ($builder->getData()->getId()) {
            $builder->add('players', EntityType::class, ['class' => Player::class, 'multiple' => true, 'expanded' => true, 'query_builder' =>
                function (PlayerRepository $repo) use ($builder) {
                    return $repo->getQueryBuilderForPlayerAtSeason($builder->getData()->getSaison());
                }
            ])
                ->add('scoreHomeFinal', IntegerType::class, ['required' => false])
                ->add('scoreAwayFinal', IntegerType::class, ['required' => false])
                ->add('scoreHomeProlong', IntegerType::class, ['required' => false])
                ->add('scoreAwayProlong', IntegerType::class, ['required' => false])
                ->add('scoreHomePen', IntegerType::class, ['required' => false])
                ->add('scoreAwayPen', IntegerType::class, ['required' => false]);
        }

        $builder->add('Envoyer', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MatchGame',
            'preferred_teams' => [],
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_matchgame';
    }


}
