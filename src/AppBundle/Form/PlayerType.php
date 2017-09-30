<?php

namespace AppBundle\Form;

use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('number')
//            ->add('active')
//            ->add('birthDate')
            ->add('contract')
            ->add('weight',null,['required'=>false])
            ->add('height',null,['required'=>false])
            ->add('position',null,['required'=>false])
            ->add('description',null,['required'=>false])
            ->add('type',ChoiceType::class,['choices'=>Player::TYPE_CHOICES])
            ->add('team',EntityType::class,['class'=>Team::class])
            ->add('Envoyer',SubmitType::class)
//            ->add('picture')
//            ->add('nationality')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Player'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_player';
    }


}
