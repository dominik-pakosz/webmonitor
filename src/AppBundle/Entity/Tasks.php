<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks", indexes={@ORM\Index(name="idx_task_parent", columns={"task_parent"}), @ORM\Index(name="idx_task_project", columns={"task_project"}), @ORM\Index(name="idx_task_owner", columns={"task_owner"}), @ORM\Index(name="idx_task_order", columns={"task_order"}), @ORM\Index(name="idx_task1", columns={"task_start_date"}), @ORM\Index(name="idx_task2", columns={"task_end_date"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TasksRepository")
 */
class Tasks
{
    /**
     * @var string
     *
     * @ORM\Column(name="task_name", type="string", nullable=true)
     */
    private $taskName;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Tasks", inversedBy="children")
     * @ORM\JoinColumn(name="task_parent", referencedColumnName="task_id")
     */
    private $taskParent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="task_milestone", type="boolean", nullable=true)
     */
    private $taskMilestone;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_project", type="integer", nullable=false)
     */
    private $taskProject;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_owner", type="integer", nullable=false)
     */
    private $taskOwner;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="task_start_date", type="datetime", nullable=true)
     */
    private $taskStartDate;

    /**
     * @var float
     *
     * @ORM\Column(name="task_duration", type="float", precision=10, scale=0, nullable=true)
     */
    private $taskDuration;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_duration_type", type="integer", nullable=false)
     */
    private $taskDurationType;

    /**
     * @var float
     *
     * @ORM\Column(name="task_hours_worked", type="float", precision=10, scale=0, nullable=true)
     */
    private $taskHoursWorked;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="task_end_date", type="datetime", nullable=true)
     */
    private $taskEndDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_status", type="integer", nullable=true)
     */
    private $taskStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="task_priority", type="boolean", nullable=true)
     */
    private $taskPriority;

    /**
     * @var boolean
     *
     * @ORM\Column(name="task_percent_complete", type="integer", nullable=true)
     */
    private $taskPercentComplete;

    /**
     * @var string
     *
     * @ORM\Column(name="task_description", type="text", length=65535, nullable=true)
     */
    private $taskDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="task_target_budget", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $taskTargetBudget;

    /**
     * @var string
     *
     * @ORM\Column(name="task_related_url", type="string", length=255, nullable=true)
     */
    private $taskRelatedUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_creator", type="integer", nullable=false)
     */
    private $taskCreator;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_order", type="integer", nullable=false)
     */
    private $taskOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="task_client_publish", type="boolean", nullable=false)
     */
    private $taskClientPublish;

    /**
     * @var boolean
     *
     * @ORM\Column(name="task_dynamic", type="boolean", nullable=false)
     */
    private $taskDynamic;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_access", type="integer", nullable=false)
     */
    private $taskAccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_notify", type="integer", nullable=false)
     */
    private $taskNotify;

    /**
     * @var string
     *
     * @ORM\Column(name="task_departments", type="string", length=100, nullable=true)
     */
    private $taskDepartments;

    /**
     * @var string
     *
     * @ORM\Column(name="task_contacts", type="string", length=100, nullable=true)
     */
    private $taskContacts;

    /**
     * @var string
     *
     * @ORM\Column(name="task_custom", type="text", nullable=true)
     */
    private $taskCustom;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_type", type="smallint", nullable=false)
     */
    private $taskType;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taskId;

    /**
     * Set taskName
     *
     * @param string $taskName
     * @return Tasks
     */
    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;

        return $this;
    }

    /**
     * Get taskName
     *
     * @return string 
     */
    public function getTaskName()
    {
        return $this->taskName;
    }

    /**
     * Set taskMilestone
     *
     * @param boolean $taskMilestone
     * @return Tasks
     */
    public function setTaskMilestone($taskMilestone)
    {
        $this->taskMilestone = $taskMilestone;

        return $this;
    }

    /**
     * Get taskMilestone
     *
     * @return boolean 
     */
    public function getTaskMilestone()
    {
        return $this->taskMilestone;
    }

    /**
     * Set taskProject
     *
     * @param integer $taskProject
     * @return Tasks
     */
    public function setTaskProject($taskProject)
    {
        $this->taskProject = $taskProject;

        return $this;
    }

    /**
     * Get taskProject
     *
     * @return integer 
     */
    public function getTaskProject()
    {
        return $this->taskProject;
    }

    /**
     * Set taskOwner
     *
     * @param integer $taskOwner
     * @return Tasks
     */
    public function setTaskOwner($taskOwner)
    {
        $this->taskOwner = $taskOwner;

        return $this;
    }

    /**
     * Get taskOwner
     *
     * @return integer 
     */
    public function getTaskOwner()
    {
        return $this->taskOwner;
    }

    /**
     * Set taskStartDate
     *
     * @param \DateTime $taskStartDate
     * @return Tasks
     */
    public function setTaskStartDate($taskStartDate)
    {
        $this->taskStartDate = $taskStartDate;

        return $this;
    }

    /**
     * Get taskStartDate
     *
     * @return \DateTime 
     */
    public function getTaskStartDate()
    {
        return $this->taskStartDate;
    }

    /**
     * Set taskDuration
     *
     * @param float $taskDuration
     * @return Tasks
     */
    public function setTaskDuration($taskDuration)
    {
        $this->taskDuration = $taskDuration;

        return $this;
    }

    /**
     * Get taskDuration
     *
     * @return float 
     */
    public function getTaskDuration()
    {
        return $this->taskDuration;
    }

    /**
     * Set taskDurationType
     *
     * @param integer $taskDurationType
     * @return Tasks
     */
    public function setTaskDurationType($taskDurationType)
    {
        $this->taskDurationType = $taskDurationType;

        return $this;
    }

    /**
     * Get taskDurationType
     *
     * @return integer 
     */
    public function getTaskDurationType()
    {
        return $this->taskDurationType;
    }

    /**
     * Set taskHoursWorked
     *
     * @param float $taskHoursWorked
     * @return Tasks
     */
    public function setTaskHoursWorked($taskHoursWorked)
    {
        $this->taskHoursWorked = $taskHoursWorked;

        return $this;
    }

    /**
     * Get taskHoursWorked
     *
     * @return float 
     */
    public function getTaskHoursWorked()
    {
        return $this->taskHoursWorked;
    }

    /**
     * Set taskEndDate
     *
     * @param \DateTime $taskEndDate
     * @return Tasks
     */
    public function setTaskEndDate($taskEndDate)
    {
        $this->taskEndDate = $taskEndDate;

        return $this;
    }

    /**
     * Get taskEndDate
     *
     * @return \DateTime 
     */
    public function getTaskEndDate()
    {
        return $this->taskEndDate;
    }

    /**
     * Set taskStatus
     *
     * @param integer $taskStatus
     * @return Tasks
     */
    public function setTaskStatus($taskStatus)
    {
        $this->taskStatus = $taskStatus;

        return $this;
    }

    /**
     * Get taskStatus
     *
     * @return integer 
     */
    public function getTaskStatus()
    {
        return $this->taskStatus;
    }

    /**
     * Set taskPriority
     *
     * @param boolean $taskPriority
     * @return Tasks
     */
    public function setTaskPriority($taskPriority)
    {
        $this->taskPriority = $taskPriority;

        return $this;
    }

    /**
     * Get taskPriority
     *
     * @return boolean 
     */
    public function getTaskPriority()
    {
        return $this->taskPriority;
    }

    /**
     * Set taskPercentComplete
     *
     * @param integer $taskPercentComplete
     * @return Tasks
     */
    public function setTaskPercentComplete($taskPercentComplete)
    {
        $this->taskPercentComplete = $taskPercentComplete;

        return $this;
    }

    /**
     * Get taskPercentComplete
     *
     * @return integer 
     */
    public function getTaskPercentComplete()
    {
        return $this->taskPercentComplete;
    }

    /**
     * Set taskDescription
     *
     * @param string $taskDescription
     * @return Tasks
     */
    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;

        return $this;
    }

    /**
     * Get taskDescription
     *
     * @return string 
     */
    public function getTaskDescription()
    {
        return $this->taskDescription;
    }

    /**
     * Set taskTargetBudget
     *
     * @param string $taskTargetBudget
     * @return Tasks
     */
    public function setTaskTargetBudget($taskTargetBudget)
    {
        $this->taskTargetBudget = $taskTargetBudget;

        return $this;
    }

    /**
     * Get taskTargetBudget
     *
     * @return string 
     */
    public function getTaskTargetBudget()
    {
        return $this->taskTargetBudget;
    }

    /**
     * Set taskRelatedUrl
     *
     * @param string $taskRelatedUrl
     * @return Tasks
     */
    public function setTaskRelatedUrl($taskRelatedUrl)
    {
        $this->taskRelatedUrl = $taskRelatedUrl;

        return $this;
    }

    /**
     * Get taskRelatedUrl
     *
     * @return string 
     */
    public function getTaskRelatedUrl()
    {
        return $this->taskRelatedUrl;
    }

    /**
     * Set taskCreator
     *
     * @param integer $taskCreator
     * @return Tasks
     */
    public function setTaskCreator($taskCreator)
    {
        $this->taskCreator = $taskCreator;

        return $this;
    }

    /**
     * Get taskCreator
     *
     * @return integer 
     */
    public function getTaskCreator()
    {
        return $this->taskCreator;
    }

    /**
     * Set taskOrder
     *
     * @param integer $taskOrder
     * @return Tasks
     */
    public function setTaskOrder($taskOrder)
    {
        $this->taskOrder = $taskOrder;

        return $this;
    }

    /**
     * Get taskOrder
     *
     * @return integer 
     */
    public function getTaskOrder()
    {
        return $this->taskOrder;
    }

    /**
     * Set taskClientPublish
     *
     * @param boolean $taskClientPublish
     * @return Tasks
     */
    public function setTaskClientPublish($taskClientPublish)
    {
        $this->taskClientPublish = $taskClientPublish;

        return $this;
    }

    /**
     * Get taskClientPublish
     *
     * @return boolean 
     */
    public function getTaskClientPublish()
    {
        return $this->taskClientPublish;
    }

    /**
     * Set taskDynamic
     *
     * @param boolean $taskDynamic
     * @return Tasks
     */
    public function setTaskDynamic($taskDynamic)
    {
        $this->taskDynamic = $taskDynamic;

        return $this;
    }

    /**
     * Get taskDynamic
     *
     * @return boolean 
     */
    public function getTaskDynamic()
    {
        return $this->taskDynamic;
    }

    /**
     * Set taskAccess
     *
     * @param integer $taskAccess
     * @return Tasks
     */
    public function setTaskAccess($taskAccess)
    {
        $this->taskAccess = $taskAccess;

        return $this;
    }

    /**
     * Get taskAccess
     *
     * @return integer 
     */
    public function getTaskAccess()
    {
        return $this->taskAccess;
    }

    /**
     * Set taskNotify
     *
     * @param integer $taskNotify
     * @return Tasks
     */
    public function setTaskNotify($taskNotify)
    {
        $this->taskNotify = $taskNotify;

        return $this;
    }

    /**
     * Get taskNotify
     *
     * @return integer 
     */
    public function getTaskNotify()
    {
        return $this->taskNotify;
    }

    /**
     * Set taskDepartments
     *
     * @param string $taskDepartments
     * @return Tasks
     */
    public function setTaskDepartments($taskDepartments)
    {
        $this->taskDepartments = $taskDepartments;

        return $this;
    }

    /**
     * Get taskDepartments
     *
     * @return string 
     */
    public function getTaskDepartments()
    {
        return $this->taskDepartments;
    }

    /**
     * Set taskContacts
     *
     * @param string $taskContacts
     * @return Tasks
     */
    public function setTaskContacts($taskContacts)
    {
        $this->taskContacts = $taskContacts;

        return $this;
    }

    /**
     * Get taskContacts
     *
     * @return string 
     */
    public function getTaskContacts()
    {
        return $this->taskContacts;
    }

    /**
     * Set taskCustom
     *
     * @param string $taskCustom
     * @return Tasks
     */
    public function setTaskCustom($taskCustom)
    {
        $this->taskCustom = $taskCustom;

        return $this;
    }

    /**
     * Get taskCustom
     *
     * @return string 
     */
    public function getTaskCustom()
    {
        return $this->taskCustom;
    }

    /**
     * Set taskType
     *
     * @param integer $taskType
     * @return Tasks
     */
    public function setTaskType($taskType)
    {
        $this->taskType = $taskType;

        return $this;
    }

    /**
     * Get taskType
     *
     * @return integer 
     */
    public function getTaskType()
    {
        return $this->taskType;
    }

    /**
     * Get taskId
     *
     * @return integer 
     */
    public function getTaskId()
    {
        return $this->taskId;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Tasks", mappedBy="taskParent")
     */
    private $children;
    
    
    
    public function hasChildren()
    {
        return $this->children->count() > 0;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get taskParent
     *
     * @return \AppBundle\Entity\Tasks 
     */
    public function getTaskParent()
    {
        return $this->taskParent;
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }
}
