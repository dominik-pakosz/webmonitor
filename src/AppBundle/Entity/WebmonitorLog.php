<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="webmonitor_log")
 * @ORM\Entity
 */
class WebmonitorLog
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
     * @ORM\Column(name="log_id", type="integer")
     */
    private $logId;
    
    /**
     *
     * @ORM\Column(name="type_id", type="integer")
     */
    private $typeId;

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
     * Set logId
     *
     * @param integer $logId
     * @return WebmonitorLog
     */
    public function setLogId($logId)
    {
        $this->logId = $logId;

        return $this;
    }

    /**
     * Get logId
     *
     * @return integer 
     */
    public function getLogId()
    {
        return $this->logId;
    }

    /**
     * Set typeId
     *
     * @param integer $typeId
     * @return WebmonitorLog
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->typeId;
    }
}
