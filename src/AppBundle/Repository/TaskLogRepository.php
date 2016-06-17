<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TaskLogRepository extends EntityRepository 
{
        /**
         * @return Logs[]
         */
        public function findAllBetweenDatesAndById($searchDate, $id)
        {
            
            $fromDate = strtotime('-1 days', strtotime($searchDate));
            $fromDate = date('Y-m-d 23:59:59', $fromDate);
            $toDate = strtotime('+1 days', strtotime($searchDate));
            $toDate = date('Y-m-d 00:00:00', $toDate);
        
            return $this->createQueryBuilder('logs')
                ->andWhere('logs.taskLogDate BETWEEN :firstDate AND :lastDate')
                ->andWhere('logs.taskLogCreator = :userid')
                ->setParameter('firstDate', $fromDate)
                ->setParameter('lastDate', $toDate)
                ->setParameter('userid', $id)
                ->getQuery()
                ->execute();
        }
        
        public function findAllInMonth($date)
        {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, substr($date, 5, 2),substr($date, 0, 4));
        
            $fromDate = $date.'-'.'01';
            $toDate = $date.'-'.$daysInMonth;
        
            return $this->createQueryBuilder('logs')
                    ->andWhere('logs.taskLogDate BETWEEN :firstDate AND :lastDate')
                    ->setParameter('firstDate', $fromDate)
                    ->setParameter('lastDate', $toDate)
                    ->getQuery()
                    ->execute();
        }
        
        
        public function findAllInMonthById($date, $id)
        {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, substr($date, 5, 2),substr($date, 0, 4));
        
            $fromDate = $date.'-'.'01';
            $toDate = $date.'-'.$daysInMonth;
        
            return $this->createQueryBuilder('logs')
                    ->andWhere('logs.taskLogDate BETWEEN :firstDate AND :lastDate')
                    ->andWhere('logs.taskLogCreator = :userid')
                    ->setParameter('firstDate', $fromDate)
                    ->setParameter('lastDate', $toDate)
                    ->setParameter('userid', $id)
                    ->getQuery()
                    ->execute();
        }
        
        public function findAllLogsFromTasks(array $tasks) {
            
            $tempData = $this->createQueryBuilder('logs')
                    ->andWhere('logs.taskLogTask IN(:array)')
                    ->setParameter('array', $tasks)
                    ->getQuery()
                    ->execute();
            
            
            $notEmptyTasks = $this->createQueryBuilder('logs')
                    ->andWhere('logs.taskLogTask IN(:array)')
                    ->setParameter('array', $tasks)
                    ->select('logs.taskLogTask')
                    ->getQuery()
                    ->getArrayResult();
            
            $notEmptyTasksFinal = array();
            foreach ($notEmptyTasks as $val) {
                $notEmptyTasksFinal[$val['taskLogTask']] = $val['taskLogTask'];
            }
            
            $sortedByDate = array();
            foreach ($tempData as $val) {
                $date = $val->getTaskLogDate()->format('Y-m-d');
                if (isset($sortedByDate[$date])) {
                    $time = $sortedByDate[$date];
                    $time += $val->getTaskLogHours();
                    $sortedByDate[$date] = $time;
                } else {
                $sortedByDate[$date] = $val->getTaskLogHours();
                }
            }
            
            $start = array_keys($sortedByDate)[0];
            $end = array_keys($sortedByDate)[sizeof($sortedByDate)-1];
            $addEmptyDates = $this->checkDates($start, $end, $sortedByDate);
            
            $googleChartData = $this->changeTimeValues($addEmptyDates);

            return array($googleChartData, $notEmptyTasksFinal);
        }
        
        public function checkDates($from, $to, $filledDates) {
            
            $start = new \DateTime($from);
            $end = new \DateTime($to);
            $oneday = new \DateInterval("P1D");

            $days = array();
            $data = "0";

            /* Iterate from $start up to $end+1 day, one day in each iteration.
               We add one day to the $end date, because the DatePeriod only iterates up to,
               not including, the end date. */
            foreach(new \DatePeriod($start, $oneday, $end->add($oneday)) as $day) {
                if (isset($filledDates[$day->format("Y-m-d")])) {
                    $days[$day->format("Y-m-d")] = $filledDates[$day->format("Y-m-d")];
                } else {
                    $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
                    if($day_num < 6) { /* weekday */
                        $days[$day->format("Y-m-d")] = $data;
                    }
                }
            }
            return $days;
        }
        
        public function changeTimeValues(array $times) {
            
            foreach ($times as &$time) {
                $tempTime = explode('.', $time);

                
                if(sizeof($tempTime)>1) {
                    
                    if(strlen($tempTime[1]) == 1) {
                        $tempTime[1] = round($tempTime[1]*6);
                    } else {
                        $tempTime[1] = round($tempTime[1]*0.6);
                    }
                    
                    if (strlen($tempTime[1]) == 1) {
                        $tempTime[1] ='0'.$tempTime[1];
                    }
                
                    //$tempTime[1] = round($tempTime[1]*0.6);
                    $time = implode('.', $tempTime);
                } else {
                    $time = $tempTime[0];
                }
            }

            return $times;
        }
        
        public function getTotalTimeOfMonth($month, array $ids) {
            
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, substr($month, 5, 2),substr($month, 0, 4));
        
            $fromDate = $month.'-'.'01';
            $toDate = $month.'-'.$daysInMonth;
            
            $tempData =  $this->createQueryBuilder('logs')
                    ->andWhere('logs.taskLogCreator IN(:array)')
                    ->andWhere('logs.taskLogDate BETWEEN :firstDate AND :lastDate')
                    ->setParameter('array', $ids)
                    ->setParameter('firstDate', $fromDate)
                    ->setParameter('lastDate', $toDate)
                    ->getQuery()
                    ->execute();
            
            
            $time = 0;
            foreach($tempData as $val) {
                $time += $val->getTaskLogHours();
            }
            
            return $time;
        }
        
        public function getNamesAndTimes($names, $ids) {
            
             $logs = $this->createQueryBuilder('logs')
                    ->andWhere('logs.taskLogTask IN(:array)')
                    ->setParameter('array', $ids)
                    ->select('logs.taskLogCreator, logs.taskLogHours')
                    ->getQuery()
                    ->execute();
             
             $usersTime = array();
             foreach($logs as $log) {
                 if(!isset($names[$log['taskLogCreator']])) {
                     $names[$log['taskLogCreator']] = 'nieprzypisani';
                 }
                 if(isset($usersTime[$names[$log['taskLogCreator']]])) {
                    $time = $usersTime[$names[$log['taskLogCreator']]];
                    $time += $log['taskLogHours'];
                    $usersTime[$names[$log['taskLogCreator']]] = $time;
                 } else {
                    $usersTime[$names[$log['taskLogCreator']]] = $log['taskLogHours'];
                 }
             }
             
             $usersTime = $this->addHoursAndMinutesToTime($usersTime);

             return $usersTime;
        }
        
        //zmienia format tekstu na Xh Ym.
        public function addHoursAndMinutesToTime(array $times) {
            
            foreach ($times as &$time) {
                $tempTime = explode('.', $time);
            
                if(sizeof($tempTime)>1) {

                    $tempTime[1] = round($tempTime[1]*0.6);

                    if (strlen($tempTime[1]) == 1) {
                        $tempTime[1] ='0'.$tempTime[1];
                    }

                    $totalTime = $tempTime[0].'h '.$tempTime[1].'m';
                } else {
                    $totalTime = $tempTime[0].'h';
                }
                
                $time = $totalTime;
            }
            
            return $times;
        }
        
        public function getRealTime(array $ids) {
            
            return round($this->createQueryBuilder('logs')
                    ->andWhere('logs.taskLogTask IN(:array)')
                    ->setParameter('array', $ids)
                    ->select('SUM(logs.taskLogHours)')
                    ->getQuery()
                    ->getSingleScalarResult(), 2);
            
        }
}
