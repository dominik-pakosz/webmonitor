<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserTasksRepository extends EntityRepository 
{
        /**
         * @return Ids[]
         */
        public function getAllUsersId(array $ids)
        {
            $arrayOfIds = array();
            
            foreach ($ids as $id) {
                $arrayOfIds[] = $id['taskId'];
            }
            
            $tempUsers = $this->createQueryBuilder('u')
                    ->andWhere('u.taskId IN(:id)')
                    ->setParameter('id', $arrayOfIds)
                    ->select('u.userId, u.taskId')
                    ->getQuery()
                    ->execute();

            $usersIds = array();
            foreach ($tempUsers as $userId) {
                $usersIds[$userId['userId']] = $userId['userId'];
            }
            
            $usersToTasks = array();
            foreach ($tempUsers as $user) {
                $usersToTasks[$user['taskId']][] = $user['userId'];
            }

            return array($usersIds,$usersToTasks);
        }
}
