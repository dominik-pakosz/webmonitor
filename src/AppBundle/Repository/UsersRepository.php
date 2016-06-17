<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository 
{
        /**
         * @return Ids[]
         */
        public function getNamesById(array $ids)
        {
            $tempUsers = $this->createQueryBuilder('u')
                    ->andWhere('u.userId IN(:id)')
                    ->setParameter('id', $ids)
                    ->select('u.userUsername, u.userId')
                    ->getQuery()
                    ->execute();

            $usersNames = array();
            foreach ($tempUsers as $user) {
                $usersNames[$user['userId']] = $user['userUsername'];
            }

            return $usersNames;
        }
}
