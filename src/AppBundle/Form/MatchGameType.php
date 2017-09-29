<?php

namespace AppBundle\Form;

use AppBundle\Entity\Arbitre;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Competition;
use AppBundle\Entity\Saison;
use AppBundle\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('date',TextType::class,['attr'=>['class'=>'datepicker','widget' => 'single_text',]])
            ->add('description')
            ->add('competition',EntityType::class,['class'=>Competition::class])
            ->add('arbitre',EntityType::class,['class'=>Arbitre::class])
            ->add('saison',EntityType::class,['class'=>Saison::class])
            ->add('homeTeam',EntityType::class,['class'=>Team::class])
            ->add('awayTeam',EntityType::class,['class'=>Team::class])
            ->add('coach',EntityType::class,['class'=>Coach::class])
            ->add('Envoyer',SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MatchGame'
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
