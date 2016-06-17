<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="webmonitor_log_types")
 * @ORM\Entity
 */
class WebmonitorLogTypes 
{
    
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     *
     * @ORM\Column(name="type_name", type="string")
     */
    private $name;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param integer $name
     * @return WebmonitorLogTypes
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return integer 
     */
    public function getName()
    {
        return $this->name;
    }
}
