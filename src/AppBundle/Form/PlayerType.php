<?php

namespace AppBundle\Form;

use AppBundle\Entity\Player;
use AppBundle\Entity\Roster;
use AppBundle\Entity\Team;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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
            ->add('nickName', null, ['required'=>false])
            // TODO selectbox with active numbers removed on creation
            ->add('number', NumberType::class, ['required'=>false])
            ->add('active', CheckboxType::class)
            // TODO birthdate from 1850 till (today-8years)
            ->add('birthDate', BirthdayType::class)
            ->add('contract')
            ->add('weight',null,['required'=>false])
            ->add('height',null,['required'=>false])
            ->add('position',null,['required'=>false])
            ->add('description',null,['required'=>false])
            ->add('type',ChoiceType::class,['choices'=>Player::TYPE_CHOICES])
            ->add('roster', EntityType::class, ['class' => Roster::class])
            ->add('team',EntityType::class,['class'=>Team::class])
            ->add('on_loan', CheckboxType::class, ['required'=>false])
            ->add('topic', UrlType::class)
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
