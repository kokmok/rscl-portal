<?php

namespace AppBundle\Search;

use AppBundle\Entity\Arbitre;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Player;
use AppBundle\Entity\Roster;
use AppBundle\Entity\Saison;
use AppBundle\Entity\Team;
use AppBundle\Repository\RosterRepository;
use AppBundle\Repository\SaisonRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rosters',EntityType::class,['required'=>true,'class'=>Roster::class,'multiple'=>true,"expanded"=>true,
                'query_builder'=>
                    function(RosterRepository $repo){
                        return $repo->filterActiveQb();
                    },'label'=>"Noyeau"])
            ->add('Filtrer',SubmitType::class,['attr'=>['class'=>'btn']]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Search\TeamFilterModel',
            'method'=>'GET',
            'csrf_protection'=>false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }


}
