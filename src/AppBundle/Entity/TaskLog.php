<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskLog
 *
 * @ORM\Table(name="task_log", indexes={@ORM\Index(name="idx_log_task", columns={"task_log_task"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskLogRepository")
 */
class TaskLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="task_log_task", type="integer", nullable=false)
     */
    private $taskLogTask;

    /**
     * @var string
     *
     * @ORM\Column(name="task_log_name", type="string", length=255, nullable=true)
     */
    private $taskLogName;

    /**
     * @var string
     *
     * @ORM\Column(name="task_log_description", type="text", length=65535, nullable=true)
     */
    private $taskLogDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_log_creator", type="integer", nullable=false)
     */
    private $taskLogCreator;

    /**
     * @var float
     *
     * @ORM\Column(name="task_log_hours", type="float", precision=10, scale=0, nullable=false)
     */
    private $taskLogHours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="task_log_date", type="datetime", nullable=true)
     */
    private $taskLogDate;

    /**
     * @var string
     *
     * @ORM\Column(name="task_log_costcode", type="string", length=8, nullable=false)
     */
    private $taskLogCostcode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="task_log_problem", type="boolean", nullable=true)
     */
    private $taskLogProblem;

    /**
     * @var boolean
     *
     * @ORM\Column(name="task_log_reference", type="boolean", nullable=true)
     */
    private $taskLogReference;

    /**
     * @var string
     *
     * @ORM\Column(name="task_log_related_url", type="string", length=255, nullable=true)
     */
    private $taskLogRelatedUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_log_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taskLogId;



    /**
     * Set taskLogTask
     *
     * @param integer $taskLogTask
     * @return TaskLog
     */
    public function setTaskLogTask($taskLogTask)
    {
        $this->taskLogTask = $taskLogTask;

        return $this;
    }

    /**
     * Get taskLogTask
     *
     * @return integer 
     */
    public function getTaskLogTask()
    {
        return $this->taskLogTask;
    }

    /**
     * Set taskLogName
     *
     * @param string $taskLogName
     * @return TaskLog
     */
    public function setTaskLogName($taskLogName)
    {
        $this->taskLogName = $taskLogName;

        return $this;
    }

    /**
     * Get taskLogName
     *
     * @return string 
     */
    public function getTaskLogName()
    {
        return $this->taskLogName;
    }

    /**
     * Set taskLogDescription
     *
     * @param string $taskLogDescription
     * @return TaskLog
     */
    public function setTaskLogDescription($taskLogDescription)
    {
        $this->taskLogDescription = $taskLogDescription;

        return $this;
    }

    /**
     * Get taskLogDescription
     *
     * @return string 
     */
    public function getTaskLogDescription()
    {
        return $this->taskLogDescription;
    }

    /**
     * Set taskLogCreator
     *
     * @param integer $taskLogCreator
     * @return TaskLog
     */
    public function setTaskLogCreator($taskLogCreator)
    {
        $this->taskLogCreator = $taskLogCreator;

        return $this;
    }

    /**
     * Get taskLogCreator
     *
     * @return integer 
     */
    public function getTaskLogCreator()
    {
        return $this->taskLogCreator;
    }

    /**
     * Set taskLogHours
     *
     * @param float $taskLogHours
     * @return TaskLog
     */
    public function setTaskLogHours($taskLogHours)
    {
        $this->taskLogHours = $taskLogHours;

        return $this;
    }

    /**
     * Get taskLogHours
     *
     * @return float 
     */
    public function getTaskLogHours()
    {
        return $this->taskLogHours;
    }

    /**
     * Set taskLogDate
     *
     * @param \DateTime $taskLogDate
     * @return TaskLog
     */
    public function setTaskLogDate($taskLogDate)
    {
        $this->taskLogDate = $taskLogDate;

        return $this;
    }

    /**
     * Get taskLogDate
     *
     * @return \DateTime 
     */
    public function getTaskLogDate()
    {
        return $this->taskLogDate;
    }

    /**
     * Set taskLogCostcode
     *
     * @param string $taskLogCostcode
     * @return TaskLog
     */
    public function setTaskLogCostcode($taskLogCostcode)
    {
        $this->taskLogCostcode = $taskLogCostcode;

        return $this;
    }

    /**
     * Get taskLogCostcode
     *
     * @return string 
     */
    public function getTaskLogCostcode()
    {
        return $this->taskLogCostcode;
    }

    /**
     * Set taskLogProblem
     *
     * @param boolean $taskLogProblem
     * @return TaskLog
     */
    public function setTaskLogProblem($taskLogProblem)
    {
        $this->taskLogProblem = $taskLogProblem;

        return $this;
    }

    /**
     * Get taskLogProblem
     *
     * @return boolean 
     */
    public function getTaskLogProblem()
    {
        return $this->taskLogProblem;
    }

    /**
     * Set taskLogReference
     *
     * @param boolean $taskLogReference
     * @return TaskLog
     */
    public function setTaskLogReference($taskLogReference)
    {
        $this->taskLogReference = $taskLogReference;

        return $this;
    }

    /**
     * Get taskLogReference
     *
     * @return boolean 
     */
    public function getTaskLogReference()
    {
        return $this->taskLogReference;
    }

    /**
     * Set taskLogRelatedUrl
     *
     * @param string $taskLogRelatedUrl
     * @return TaskLog
     */
    public function setTaskLogRelatedUrl($taskLogRelatedUrl)
    {
        $this->taskLogRelatedUrl = $taskLogRelatedUrl;

        return $this;
    }

    /**
     * Get taskLogRelatedUrl
     *
     * @return string 
     */
    public function getTaskLogRelatedUrl()
    {
        return $this->taskLogRelatedUrl;
    }

    /**
     * Get taskLogId
     *
     * @return integer 
     */
    public function getTaskLogId()
    {
        return $this->taskLogId;
    }
}
