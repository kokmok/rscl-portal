<?php
/**
 * Created by PhpStorm.
 * User: jona
 * Date: 22/10/17
 * Time: 10:41
 */

namespace AppBundle\Lister;


use Doctrine\ORM\EntityManager;

class EntityListMapper
{
    /**
     * @var array
     */
    private $adminList;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * EntityListMapper constructor.
     * @param array $adminList
     * @param EntityManager $em
     */
    public function __construct(array $adminList, EntityManager $em)
    {
        $this->adminList = $adminList;
        $this->em = $em;
    }

    
    public function getEntitiesForList($entityName){
        $repo = $this->em->getRepository($this->adminList[$entityName]['class']);
        
        return $repo->findAll();
    }
    
    public function getPropertiesForList($entityName){
        $properties = [];
        foreach ($this->adminList[$entityName]['propertyList'] as $propertyList){
            $property = new TypedProperty($propertyList['name']);
            if (isset($propertyList['type'])){
                $property->setType($propertyList['type']);
            }
            $properties[] = $property;
        }
        return $properties;
    }
    
    public function getEntity($entityName,$entityId){
        return $this->em->getRepository($this->adminList[$entityName]['class'])->find($entityId);
    }
    
    public function getNewEntity($entityName){
        $refl = new \ReflectionClass($this->adminList[$entityName]['class']);
        return $refl->newInstance() ;
    }
    
    public function getFormClass($entityName){
        return $this->adminList[$entityName]['form'];
    }

}