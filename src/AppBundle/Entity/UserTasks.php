<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTasks
 *
 * @ORM\Table(name="user_tasks", indexes={@ORM\Index(name="user_type", columns={"user_type"}), @ORM\Index(name="task_id", columns={"task_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserTasksRepository")
 */
class UserTasks
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="user_type", type="boolean", nullable=false)
     */
    private $userType;

    /**
     * @var integer
     *
     * @ORM\Column(name="perc_assignment", type="integer", nullable=false)
     */
    private $percAssignment;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_task_priority", type="boolean", nullable=true)
     */
    private $userTaskPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $taskId;



    /**
     * Set userType
     *
     * @param boolean $userType
     * @return UserTasks
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return boolean 
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set percAssignment
     *
     * @param integer $percAssignment
     * @return UserTasks
     */
    public function setPercAssignment($percAssignment)
    {
        $this->percAssignment = $percAssignment;

        return $this;
    }

    /**
     * Get percAssignment
     *
     * @return integer 
     */
    public function getPercAssignment()
    {
        return $this->percAssignment;
    }

    /**
     * Set userTaskPriority
     *
     * @param boolean $userTaskPriority
     * @return UserTasks
     */
    public function setUserTaskPriority($userTaskPriority)
    {
        $this->userTaskPriority = $userTaskPriority;

        return $this;
    }

    /**
     * Get userTaskPriority
     *
     * @return boolean 
     */
    public function getUserTaskPriority()
    {
        return $this->userTaskPriority;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return UserTasks
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set taskId
     *
     * @param integer $taskId
     * @return UserTasks
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;

        return $this;
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
}
