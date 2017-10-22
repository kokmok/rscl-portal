<?php
namespace AppBundle\Lister;

/**
 * Created by PhpStorm.
 * User: jona
 * Date: 22/10/17
 * Time: 10:29
 */
class TypedProperty
{
    
    const TYPE_NORMAL = 'TYPE_NORMAL';
    const TYPE_DATE = 'TYPE_DATE';
    const TYPE_DATETIME = 'TYPE_DATETIME';
    
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * TypedProperty constructor.
     * @param string $name
     * @param string $type
     */
    public function __construct($name, $type = self::TYPE_NORMAL)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }
    
    


}