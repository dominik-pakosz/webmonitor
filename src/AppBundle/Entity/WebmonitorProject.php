<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table(name="webmonitor_project")
 * @ORM\Entity
 */
class WebmonitorProject
{
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer")
     */
    private $projectId;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="project_status", type="integer", nullable=true)
     */
    private $projectStatus;
    
    /**
     * Get projectId
     *
     * @return integer 
     */
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set projectStatus
     *
     * @param integer $projectStatus
     * @return WebmonitorProject
     */
    public function setProjectStatus($projectStatus)
    {
        $this->projectStatus = $projectStatus;

        return $this;
    }

    /**
     * Get projectStatus
     *
     * @return integer 
     */
    public function getProjectStatus()
    {
        return $this->projectStatus;
    }
}
