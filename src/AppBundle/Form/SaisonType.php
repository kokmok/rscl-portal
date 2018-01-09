<?php

namespace AppBundle\Form;

use AppBundle\Repository\PlayerRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaisonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('running')
            ->add('players',null,["expanded"=>true,"query_builder"=>function(PlayerRepository $repo){
                return $repo->createQueryBuilder('p')->where('p.active=1')
                    ->leftJoin('p.roster','roster')
                    ->andWhere('roster.label in (:active_rosters)')
                    ->setParameter('active_rosters', ['A', 'B', 'C', 'L'])
                    ;
                
                
            }])
            ->add('Envoyer',SubmitType::class)
        
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Saison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_saison';
    }


}
