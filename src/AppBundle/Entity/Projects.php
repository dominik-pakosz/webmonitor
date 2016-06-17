<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table(name="projects", indexes={@ORM\Index(name="idx_project_owner", columns={"project_owner"}), @ORM\Index(name="idx_sdate", columns={"project_start_date"}), @ORM\Index(name="idx_edate", columns={"project_end_date"}), @ORM\Index(name="project_short_name", columns={"project_short_name"}), @ORM\Index(name="idx_proj1", columns={"project_company"})})
 * @ORM\Entity
 */
class Projects
{
    /**
     * @var integer
     *
     * @ORM\Column(name="project_company", type="integer", nullable=false)
     */
    private $projectCompany;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_department", type="integer", nullable=false)
     */
    private $projectDepartment;

    /**
     * @var string
     *
     * @ORM\Column(name="project_name", type="string", length=255, nullable=true)
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="project_short_name", type="string", length=10, nullable=true)
     */
    private $projectShortName;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_owner", type="integer", nullable=true)
     */
    private $projectOwner;

    /**
     * @var string
     *
     * @ORM\Column(name="project_url", type="string", length=255, nullable=true)
     */
    private $projectUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="project_demo_url", type="string", length=255, nullable=true)
     */
    private $projectDemoUrl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_start_date", type="datetime", nullable=true)
     */
    private $projectStartDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_end_date", type="datetime", nullable=true)
     */
    private $projectEndDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_actual_end_date", type="datetime", nullable=true)
     */
    private $projectActualEndDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_status", type="integer", nullable=true)
     */
    private $projectStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="project_percent_complete", type="boolean", nullable=true)
     */
    private $projectPercentComplete;

    /**
     * @var string
     *
     * @ORM\Column(name="project_color_identifier", type="string", length=6, nullable=true)
     */
    private $projectColorIdentifier;

    /**
     * @var string
     *
     * @ORM\Column(name="project_description", type="text", length=65535, nullable=true)
     */
    private $projectDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="project_target_budget", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $projectTargetBudget;

    /**
     * @var string
     *
     * @ORM\Column(name="project_actual_budget", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $projectActualBudget;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_creator", type="integer", nullable=true)
     */
    private $projectCreator;

    /**
     * @var boolean
     *
     * @ORM\Column(name="project_private", type="boolean", nullable=true)
     */
    private $projectPrivate;

    /**
     * @var string
     *
     * @ORM\Column(name="project_departments", type="string", length=100, nullable=true)
     */
    private $projectDepartments;

    /**
     * @var string
     *
     * @ORM\Column(name="project_contacts", type="string", length=100, nullable=true)
     */
    private $projectContacts;

    /**
     * @var boolean
     *
     * @ORM\Column(name="project_priority", type="boolean", nullable=true)
     */
    private $projectPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_type", type="smallint", nullable=false)
     */
    private $projectType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="project_active", type="boolean", nullable=true)
     */
    private $projectActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectId;



    /**
     * Set projectCompany
     *
     * @param integer $projectCompany
     * @return Projects
     */
    public function setProjectCompany($projectCompany)
    {
        $this->projectCompany = $projectCompany;

        return $this;
    }

    /**
     * Get projectCompany
     *
     * @return integer 
     */
    public function getProjectCompany()
    {
        return $this->projectCompany;
    }

    /**
     * Set projectDepartment
     *
     * @param integer $projectDepartment
     * @return Projects
     */
    public function setProjectDepartment($projectDepartment)
    {
        $this->projectDepartment = $projectDepartment;

        return $this;
    }

    /**
     * Get projectDepartment
     *
     * @return integer 
     */
    public function getProjectDepartment()
    {
        return $this->projectDepartment;
    }

    /**
     * Set projectName
     *
     * @param string $projectName
     * @return Projects
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string 
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set projectShortName
     *
     * @param string $projectShortName
     * @return Projects
     */
    public function setProjectShortName($projectShortName)
    {
        $this->projectShortName = $projectShortName;

        return $this;
    }

    /**
     * Get projectShortName
     *
     * @return string 
     */
    public function getProjectShortName()
    {
        return $this->projectShortName;
    }

    /**
     * Set projectOwner
     *
     * @param integer $projectOwner
     * @return Projects
     */
    public function setProjectOwner($projectOwner)
    {
        $this->projectOwner = $projectOwner;

        return $this;
    }

    /**
     * Get projectOwner
     *
     * @return integer 
     */
    public function getProjectOwner()
    {
        return $this->projectOwner;
    }

    /**
     * Set projectUrl
     *
     * @param string $projectUrl
     * @return Projects
     */
    public function setProjectUrl($projectUrl)
    {
        $this->projectUrl = $projectUrl;

        return $this;
    }

    /**
     * Get projectUrl
     *
     * @return string 
     */
    public function getProjectUrl()
    {
        return $this->projectUrl;
    }

    /**
     * Set projectDemoUrl
     *
     * @param string $projectDemoUrl
     * @return Projects
     */
    public function setProjectDemoUrl($projectDemoUrl)
    {
        $this->projectDemoUrl = $projectDemoUrl;

        return $this;
    }

    /**
     * Get projectDemoUrl
     *
     * @return string 
     */
    public function getProjectDemoUrl()
    {
        return $this->projectDemoUrl;
    }

    /**
     * Set projectStartDate
     *
     * @param \DateTime $projectStartDate
     * @return Projects
     */
    public function setProjectStartDate($projectStartDate)
    {
        $this->projectStartDate = $projectStartDate;

        return $this;
    }

    /**
     * Get projectStartDate
     *
     * @return \DateTime 
     */
    public function getProjectStartDate()
    {
        return $this->projectStartDate;
    }

    /**
     * Set projectEndDate
     *
     * @param \DateTime $projectEndDate
     * @return Projects
     */
    public function setProjectEndDate($projectEndDate)
    {
        $this->projectEndDate = $projectEndDate;

        return $this;
    }

    /**
     * Get projectEndDate
     *
     * @return \DateTime 
     */
    public function getProjectEndDate()
    {
        return $this->projectEndDate;
    }

    /**
     * Set projectActualEndDate
     *
     * @param \DateTime $projectActualEndDate
     * @return Projects
     */
    public function setProjectActualEndDate($projectActualEndDate)
    {
        $this->projectActualEndDate = $projectActualEndDate;

        return $this;
    }

    /**
     * Get projectActualEndDate
     *
     * @return \DateTime 
     */
    public function getProjectActualEndDate()
    {
        return $this->projectActualEndDate;
    }

    /**
     * Set projectStatus
     *
     * @param integer $projectStatus
     * @return Projects
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

    /**
     * Set projectPercentComplete
     *
     * @param boolean $projectPercentComplete
     * @return Projects
     */
    public function setProjectPercentComplete($projectPercentComplete)
    {
        $this->projectPercentComplete = $projectPercentComplete;

        return $this;
    }

    /**
     * Get projectPercentComplete
     *
     * @return boolean 
     */
    public function getProjectPercentComplete()
    {
        return $this->projectPercentComplete;
    }

    /**
     * Set projectColorIdentifier
     *
     * @param string $projectColorIdentifier
     * @return Projects
     */
    public function setProjectColorIdentifier($projectColorIdentifier)
    {
        $this->projectColorIdentifier = $projectColorIdentifier;

        return $this;
    }

    /**
     * Get projectColorIdentifier
     *
     * @return string 
     */
    public function getProjectColorIdentifier()
    {
        return $this->projectColorIdentifier;
    }

    /**
     * Set projectDescription
     *
     * @param string $projectDescription
     * @return Projects
     */
    public function setProjectDescription($projectDescription)
    {
        $this->projectDescription = $projectDescription;

        return $this;
    }

    /**
     * Get projectDescription
     *
     * @return string 
     */
    public function getProjectDescription()
    {
        return $this->projectDescription;
    }

    /**
     * Set projectTargetBudget
     *
     * @param string $projectTargetBudget
     * @return Projects
     */
    public function setProjectTargetBudget($projectTargetBudget)
    {
        $this->projectTargetBudget = $projectTargetBudget;

        return $this;
    }

    /**
     * Get projectTargetBudget
     *
     * @return string 
     */
    public function getProjectTargetBudget()
    {
        return $this->projectTargetBudget;
    }

    /**
     * Set projectActualBudget
     *
     * @param string $projectActualBudget
     * @return Projects
     */
    public function setProjectActualBudget($projectActualBudget)
    {
        $this->projectActualBudget = $projectActualBudget;

        return $this;
    }

    /**
     * Get projectActualBudget
     *
     * @return string 
     */
    public function getProjectActualBudget()
    {
        return $this->projectActualBudget;
    }

    /**
     * Set projectCreator
     *
     * @param integer $projectCreator
     * @return Projects
     */
    public function setProjectCreator($projectCreator)
    {
        $this->projectCreator = $projectCreator;

        return $this;
    }

    /**
     * Get projectCreator
     *
     * @return integer 
     */
    public function getProjectCreator()
    {
        return $this->projectCreator;
    }

    /**
     * Set projectPrivate
     *
     * @param boolean $projectPrivate
     * @return Projects
     */
    public function setProjectPrivate($projectPrivate)
    {
        $this->projectPrivate = $projectPrivate;

        return $this;
    }

    /**
     * Get projectPrivate
     *
     * @return boolean 
     */
    public function getProjectPrivate()
    {
        return $this->projectPrivate;
    }

    /**
     * Set projectDepartments
     *
     * @param string $projectDepartments
     * @return Projects
     */
    public function setProjectDepartments($projectDepartments)
    {
        $this->projectDepartments = $projectDepartments;

        return $this;
    }

    /**
     * Get projectDepartments
     *
     * @return string 
     */
    public function getProjectDepartments()
    {
        return $this->projectDepartments;
    }

    /**
     * Set projectContacts
     *
     * @param string $projectContacts
     * @return Projects
     */
    public function setProjectContacts($projectContacts)
    {
        $this->projectContacts = $projectContacts;

        return $this;
    }

    /**
     * Get projectContacts
     *
     * @return string 
     */
    public function getProjectContacts()
    {
        return $this->projectContacts;
    }

    /**
     * Set projectPriority
     *
     * @param boolean $projectPriority
     * @return Projects
     */
    public function setProjectPriority($projectPriority)
    {
        $this->projectPriority = $projectPriority;

        return $this;
    }

    /**
     * Get projectPriority
     *
     * @return boolean 
     */
    public function getProjectPriority()
    {
        return $this->projectPriority;
    }

    /**
     * Set projectType
     *
     * @param integer $projectType
     * @return Projects
     */
    public function setProjectType($projectType)
    {
        $this->projectType = $projectType;

        return $this;
    }

    /**
     * Get projectType
     *
     * @return integer 
     */
    public function getProjectType()
    {
        return $this->projectType;
    }

    /**
     * Set projectActive
     *
     * @param boolean $projectActive
     * @return Projects
     */
    public function setProjectActive($projectActive)
    {
        $this->projectActive = $projectActive;

        return $this;
    }

    /**
     * Get projectActive
     *
     * @return boolean 
     */
    public function getProjectActive()
    {
        return $this->projectActive;
    }

    /**
     * Get projectId
     *
     * @return integer 
     */
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    public function toArray()
    {
        return array(
            $this->getProjectCompany(),$this->getProjectDepartment(),$this->getProjectName(),$this->getProjectShortName(),
            $this->getProjectOwner(), $this->getProjectUrl(), $this->getProjectDemoUrl(), $this->getProjectStartDate(), $this->getProjectEndDate(),
            $this->getProjectActualEndDate(), $this->getProjectstatus(), $this->getProjectPercentComplete(), $this->getProjectColorIdentifier(),
            $this->getProjectDescription(),$this->getProjectTargetBudget(), $this->getProjectActualBudget(), $this->getProjectCreator(), 
            $this->getProjectPrivate(),$this->getProjectDepartments(), $this->getProjectContacts(),$this->getProjectPriority(),$this->getProjectType(), 
            $this->getProjectActive(), $this->getProjectId()
                );
    }
}
