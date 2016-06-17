<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TasksRepository extends EntityRepository 
{
        /**
         * @return Tasks[]
         */
        public function findAllTasksById($id, $notEmptyTasks)
        {
            $sql = 'select
                    task_id, task_parent, task_name, task_start_date, task_end_date, task_duration, task_percent_complete, task_target_budget, task_creator 
                    from tasks t 
                    where t.task_project = ?';
            
            $em = $this->getEntityManager();
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $dataArray = $stmt->fetchAll();

            $arrayOfIds = array();
            $main = array();
            $children = array();
            
            foreach ($dataArray as &$task) {
                $arrayOfIds[] = $task['task_id'];
                if (!isset($notEmptyTasks[$task['task_id']])) {
                    $task['task_duration'] = 0;
                }
            }
            
            foreach ($dataArray as $task) {
                if ($task['task_id'] != $task['task_parent']) {
                    $children[$task['task_parent']][$task['task_id']] = $task;
                } else {
                    $main[$task['task_id']] = $task; 
                }
            }
            
            $userToTasks = $this->createQueryBuilder('t')
                    ->andWhere('t.taskId IN(:id)')
                    ->setParameter('id', $arrayOfIds)
                    ->select('t.taskId')
                    ->getQuery()
                    ->execute();

            return array($main, $children, $userToTasks);
        }
        
        public function getTargetBudget($id) {
            
            return $this->createQueryBuilder('t')
                    ->andWhere('t.taskProject = :id')
                    ->setParameter('id', $id)
                    ->select('SUM(t.taskTargetBudget)')
                    ->getQuery()
                    ->getSingleScalarResult();
        }
        
        public function getUsedBudget($kwota, $id) {
            
            $time = $this->createQueryBuilder('t')
                    ->andWhere('t.taskProject = :id')
                    ->setParameter('id', $id)
                    ->select('SUM(t.taskDuration)')
                    ->getQuery()
                    ->getSingleScalarResult();
            
            return $time*$kwota;
        }
        
        public function getProgress($id) {
            
            $count = $this->createQueryBuilder('t')
                    ->andWhere('t.taskProject = :id')
                    ->setParameter('id', $id)
                    ->select('COUNT(t.taskId)')
                    ->getQuery()
                    ->getSingleScalarResult();
            
            $percent = $this->createQueryBuilder('t')
                    ->andWhere('t.taskProject = :id')
                    ->setParameter('id', $id)
                    ->select('SUM(t.taskPercentComplete)')
                    ->getQuery()
                    ->getSingleScalarResult();
            
            return ($percent/$count);
        }
        
        public function getTaskForLogs($id) {
            $tempData = $this->createQueryBuilder('t')
                    ->andWhere('t.taskProject = :id')
                    ->setParameter('id', $id)
                    ->select('t.taskId')
                    ->getQuery()
                    ->execute();
            
            $exitData = array();
            
            foreach ($tempData as $val) {
                $exitData[] = $val['taskId'];
            }
            
            return $exitData;
        }
        
}
