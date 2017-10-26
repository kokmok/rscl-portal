<?php

namespace AppBundle\Search;

use AppBundle\Entity\Arbitre;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Player;
use AppBundle\Entity\Saison;
use AppBundle\Repository\SaisonRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchMatchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('saison',EntityType::class,['required'=>false,'class'=>Saison::class,'query_builder'=>
            function(SaisonRepository $repo){
                $qb = $repo->createQueryBuilder('s');
                return $qb->orderBy('s.name','DESC');
            }
            ])
            ->add('player',EntityType::class,['required'=>false,'class'=>Player::class])
            ->add('referee',EntityType::class,['required'=>false,'class'=>Arbitre::class])
            ->add('coach',EntityType::class,['required'=>false,'class'=>Coach::class])
            ->add('Filtrer',SubmitType::class,['attr'=>['class'=>'btn']]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Search\SearchMatchModel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_searchmatch';
    }


}
