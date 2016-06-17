<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\WebmonitorProject;
use AppBundle\Entity\WebmonitorLog;

class DefaultController extends Controller
{
    const GODZINA = 80; //cena netto za godzinę prac - zmiana tylko tutaj
    
    /**
     * @Route("/", name="list")
     */
    public function indexAction(Request $request)
    {
        $idToFind = $request->get('findId');
        $status = $request->get('webmonitorStatus');
        $search = $request->get('webmonitorSearch');
        
        if ($status) {
            $em = $this->getDoctrine()->getManager();
            $rowToEdit = $em->getRepository('AppBundle:WebmonitorProject')->findOneBy(array('projectId' => $status[0]));
            $rowToEdit->setProjectStatus($status[1]);
            $em->flush();
        }
        
        if ($idToFind) {
            
            $projectData = $this->getDoctrine()->getRepository('AppBundle:Projects', 'customer')->findOneBy(array('projectId' => $idToFind));
            
            if ($projectData){
                $projectId = $projectData->getProjectId();
                $base = new WebmonitorProject();
                $base->setProjectId($projectId);
                $em2 = $this->getDoctrine()->getManager();
                $em2->persist($base);
                $em2->flush();
            }
            return $this->redirectToRoute('list');
        }
        
        $dataInDatabase = $this->getDoctrine()->getRepository('AppBundle:WebmonitorProject')->findAll();
        
        $allStatus = $this->getDoctrine()->getRepository('AppBundle:WebmonitorStatus')->findAll();

        $viewArray = [];
        $companyNames = [];
        $projectStatus = [];
        $taskNumber = [];
        $hourWorked = [];
        $percentComplete = [];
        $targetBudget = [];
        $usedBudget = [];
        $danger = [];
        
        foreach ($dataInDatabase as $v) {
                $projectData = $this->getDoctrine()->getRepository('AppBundle:Projects', 'customer')->findOneBy(array('projectId' => $v->getProjectId()));
                $viewArray[] = $projectData;
                $tempCompanyId = $projectData->getProjectCompany();
                $companyNames[$tempCompanyId] = $this->getDoctrine()->getRepository('AppBundle:Companies', 'customer')->findOneBy(array('companyId' => $tempCompanyId))->getCompanyName();
                
                $tempProjectStatus = $this->getDoctrine()->getRepository('AppBundle:WebmonitorStatus')->findOneBy(array('id' => $v->getProjectStatus()));
                
                if ($tempProjectStatus) {
                    $projectStatus[$v->getProjectId()] = $tempProjectStatus->getName();
                }
                
                $tasks = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->findBy(array('taskProject' => $v->getProjectId()));
                
                $taskNumber[$v->getProjectId()] = sizeof($tasks);
                
                $tempHours = 0;
                $budget = 0;
                $donePercentage = 0;
                
                foreach ($tasks as $val) {
                    $tempHours += $val->getTaskDuration();
                    $budget += $val->getTaskTargetBudget();
                    $donePercentage += $val->getTaskPercentComplete();
                }
                
                $percentComplete[$v->getProjectId()] = round(($donePercentage/$taskNumber[$v->getProjectId()]), 2);
                $targetBudget[$v->getProjectId()] = $budget;
                $usedBudget[$v->getProjectId()] = $tempHours*self::GODZINA;
                $danger[$v->getProjectId()] = $this->checkDanger($donePercentage, $budget, $tempHours);
                
                $taskForLogs = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->getTaskForLogs($v->getProjectId());
                $realTotalTime = $this->getDoctrine()->getRepository('AppBundle:TaskLog', 'customer')->getRealTime($taskForLogs);
                $hourWorked[$v->getProjectId()] = $this->changeHoursDisplay($realTotalTime);
            }
            
            
            
        return $this->render('/webmonitor/index.html.twig', array(
            'allData' => $viewArray,
            'companies'=> $companyNames,
            'projStatus' => $projectStatus,
            'allStatus' => $allStatus,
            'searchBy' => $search,
            'taskNumber' => $taskNumber,
            'hourWorked' => $hourWorked,
            'percentComplete' => $percentComplete,
            'targetBudget' => $targetBudget,
            'usedBudget' => $usedBudget,
            'danger' => $danger
        ));
    }
    
    /**
     * @Route("/more/{projectId}/{companyId}", name="more", defaults={"projectId" = null, "companyId" = null})
     */
    public function moreAction($projectId, $companyId)
    {
        
        if ($projectId && $companyId) {
            $taskForLogs = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->getTaskForLogs($projectId);
            list($googlechart, $notEmptyTasks) = $this->getdoctrine()->getRepository('AppBundle:TaskLog', 'customer')->findAllLogsFromTasks($taskForLogs);
            $projectTargetBudget = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->getTargetBudget($projectId);
            list($projectMainTasks, $projectChildrenTasks, $projectTasksIds) = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->findAllTasksById($projectId, $notEmptyTasks);
            list($usersId,$usersToTasks) = $this->getDoctrine()->getRepository('AppBundle:UserTasks', 'customer')->getAllUsersId($projectTasksIds);
            $usersNames = $this->getDoctrine()->getRepository('AppBundle:Users', 'customer')->getNamesById($usersId);
            $usersTime = $this->getDoctrine()->getRepository('AppBundle:TaskLog', 'customer')->getNamesAndTimes($usersNames, $taskForLogs);
            $companyName = $this->getDoctrine()->getRepository('AppBundle:Companies', 'customer')->findOneBy(array('companyId' => $companyId))->getCompanyName();
            $projectName = $this->getDoctrine()->getRepository('AppBundle:Projects', 'customer')->findOneBy(array('projectId' => $projectId))->getProjectName();
            $usedBudget = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->getUsedBudget(self::GODZINA, $projectId);
            $progress = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->getProgress($projectId);
            
            
            return $this->render('/webmonitor/more.html.twig', array(
                'mainTasks' => $projectMainTasks,
                'childrenTasks' => $projectChildrenTasks,
                'usersToTasks' => $usersToTasks,
                'userNames' => $usersNames,
                'usersTime' => $usersTime,
                'companyName' => $companyName,
                'projectName'=> $projectName,
                'projectBudget'  => $projectTargetBudget,
                'usedBudget' => $usedBudget,
                'progress' => $progress,
                'chart' => $googlechart,
                'KWOTA' => self::GODZINA
                ));  
        } else {
            return $this->redirectToRoute('list');
        }
    }
    
    /**
     * @Route("/logs/", name="logs")
     */
    public function logAction(Request $request)
    {
        $searchDate = $request->get('dateToSearch');
        $logsToSave = $request->get('webmonitorLogs');
        $typeToSave = $request->get('typeToSave');
        
        if ($searchDate == null) {
            $searchDate = date('Y-m-d 00:00:00');
        }
        
        if ($typeToSave) {
            $base = new \AppBundle\Entity\WebmonitorLogTypes();
            $base->setName($typeToSave);
            $em = $this->getDoctrine()->getManager();
            $em->persist($base);
            $em->flush();
        }
        
        if ($logsToSave) {
            $isSetInDatabase = $this->getDoctrine()->getRepository('AppBundle:WebmonitorLog')->findOneBy(array('logId' => $logsToSave[0]));
            if ($isSetInDatabase) {
                $em = $this->getDoctrine()->getManager();
                $rowToEdit = $em->getRepository('AppBundle:WebmonitorLog')->findOneBy(array('logId' => $logsToSave[0]));
                $rowToEdit->setTypeId($this->getDoctrine()->getRepository('AppBundle:WebmonitorLogTypes')->findOneBy(array('name' => $logsToSave[1]))->getId());
                $em->flush();
            } else {
                $base = new WebmonitorLog();
                $base->setLogId($logsToSave[0]);
                $base->setTypeId($this->getDoctrine()->getRepository('AppBundle:WebmonitorLogTypes')->findOneBy(array('name' => $logsToSave[1]))->getId());
                $em = $this->getDoctrine()->getManager();
                $em->persist($base);
                $em->flush();
            }
        }
        
        $arrayOfIds = [26, 86, 164, 172, 173, 187, 210, 212];
        $arrayOfUsers = [];
        foreach ($arrayOfIds as $userId) {
            ${'logsUser'.$userId} = $this->getDoctrine()->getRepository('AppBundle:TaskLog', 'customer')->findAllBetweenDatesAndById($searchDate, $userId);
            
            if (${'logsUser'.$userId}) {
                $arrayOfUsers[] = ${'logsUser'.$userId};
            }
        }
        
        $outputArray = [];
        $selectedCategory = [];
        
        foreach ($arrayOfUsers as $user) {
            $arrSize = sizeof($user);
            $creator = $user[0]->getTaskLogCreator();

            for ($i=0; $i<$arrSize; $i++) {
                $taskId = $user[$i]->getTaskLogTask();
                
                $taskForUser = $this->getDoctrine()->getRepository('AppBundle:Tasks', 'customer')->findOneBy(array('taskId' => $taskId));
                
                $usersForUser = $this->getDoctrine()->getRepository('AppBundle:Users', 'customer')->findOneBy(array('userId' => $creator));
                $projectId = $taskForUser->getTaskProject();
                
                $projectForUser = $this->getDoctrine()->getRepository('AppBundle:Projects', 'customer')->findOneBy(array('projectId' => $projectId));
                $companyForUser = $this->getDoctrine()->getRepository('AppBundle:Companies', 'customer')->findOneBy(array('companyId' => $projectForUser->getProjectCompany()));
                
                $outputArray[$usersForUser->getUserUsername()][$taskId][$i]['project'] = $projectForUser->getProjectName();    
                $outputArray[$usersForUser->getUserUsername()][$taskId][$i]['company'] = $companyForUser->getCompanyName();  
                
                $outputArray[$usersForUser->getUserUsername()][$taskId][$i]['id'] = $user[$i]->getTaskLogId();                
                $outputArray[$usersForUser->getUserUsername()][$taskId][$i]['name'] = $user[$i]->getTaskLogName();
                $outputArray[$usersForUser->getUserUsername()][$taskId][$i]['description'] = $user[$i]->getTaskLogDescription();

                $isLog = $this->getDoctrine()->getRepository('AppBundle:WebmonitorLog')->findOneBy(array('logId' => $taskId));

                if ($isLog) {
                    $tempSelect = $this->getDoctrine()->getRepository('AppBundle:WebmonitorLogTypes')->findOneBy(array('id' => $isLog->getTypeId()));
                    
                    if ($tempSelect) {
                        $selectedCategory[$user[$i]->getTaskLogId()] = $tempSelect->getName();
                    }
                }
            }
        }
        
        $categories = $this->getDoctrine()->getRepository('AppBundle:WebmonitorLogTypes')->findAll();
        
        
        return $this->render('/webmonitor/logs.html.twig', array(
            'output' => $outputArray,
            'selCategory' => $selectedCategory,
            'categories' => $categories
        ));
    }
    
    /**
     * 
     * @Route("/stats", name="stats")
     */
    public function statsAction(Request $request)
    {
        $month = $request->get('monthToSearch');
        $arrayOfIds = [26, 86, 164, 172, 173, 187, 210, 212];

        if (!$month) {
            $month = date('Y-m');
        }
        
        $dataFromAllMonth =  $this->getDoctrine()->getRepository('AppBundle:TaskLog', 'customer')->findAllInMonth($month);
        
        $totalTimeInMonth = $this->getDoctrine()->getRepository('AppBundle:TaskLog', 'customer')->getTotalTimeOfMonth($month, $arrayOfIds);
       
        $allLogs = $this->getDoctrine()->getRepository('AppBundle:WebmonitorLog')->findAll();
        
        $allTypesAndTime=[];
        foreach ($dataFromAllMonth as $v) {
            foreach ($allLogs as $val) {
                if ($v->getTaskLogId() == $val->getLogId()) {

                    $typeName = $this->getDoctrine()->getRepository('AppBundle:WebmonitorLogTypes')->findOneBy(array('id' => $val->getTypeId()))->getName();
                    if (isset($allTypesAndTime[$typeName])) {
                        $time = $allTypesAndTime[$typeName];
                        $time += $v->getTaskLogHours();
                        $allTypesAndTime[$typeName] = $time;
                    } else {
                        $allTypesAndTime[$typeName] = $v->getTaskLogHours();
                    }

                }
            }
        }

        $allUsers = $this->getDoctrine()->getRepository('AppBundle:Users', 'customer')->findAll();
        $userArray = [];
 
//określenie poszczególnych czasów dla poszczegolnych userów
        foreach ($arrayOfIds as $id) {
            $oneUserData = $this->getDoctrine()->getRepository('AppBundle:TaskLog', 'customer')->findAllInMonthById($month, $id);
            $totalTime = 0;
            $totalTimeOfAllDefiniedTypes = 0;
            //nazwa usera
            foreach ($allUsers as $value) {
                if ($id == $value->getUserId()) {
                    $userName = $value->getUserUsername();
                    
                    foreach ($oneUserData as $val) {
                        $totalTime += $val->getTaskLogHours();
                        foreach ($allLogs as $webmonitorLogs) {
                            if ($val->getTaskLogId() == $webmonitorLogs->getLogId()) {
                                $typeName = $this->getDoctrine()->getRepository('AppBundle:WebmonitorLogTypes')->findOneBy(array('id' => $webmonitorLogs->getTypeId()))->getName();
                                
                                if (isset($userArray[$userName]['types'][$typeName])) {
                                    $tempTime = $userArray[$userName]['types'][$typeName];
                                    $tempTime += $val->getTaskLogHours();
                                    $totalTimeOfAllDefiniedTypes += $val->getTaskLogHours();
        
                                    $userArray[$userName]['types'][$typeName] = $tempTime;
                                } else {
                                    $totalTimeOfAllDefiniedTypes += $val->getTaskLogHours();
                                    $userArray[$userName]['types'][$typeName] = $val->getTaskLogHours(); 
                                }
                                
                            }
                        }
                        $userArray[$userName]['totaltime'] = $totalTime;
                        $userArray[$userName]['notdefinied'] = $totalTime - $totalTimeOfAllDefiniedTypes;
                    }
                }
            }
        }
        
        $withoutTypes = $totalTimeInMonth;   
                
//zmiana na format: xh ym      -> u poszczególnych userów;  
        foreach ($userArray as $k=>&$v) {
            foreach ($v as &$value) {
                if (is_array($value)) {
                    foreach ($value as &$time) {
                        $withoutTypes -= $time;
                        $time = $this->changeHoursDisplay($time);
                    }
                } else {
                    $value = $this->changeHoursDisplay($value);
                }
            }
        }

//zmiana na format: xh ym      -> cały czas w miesiącu;          
        $totalTimeInMonth = $this->changeHoursDisplay($totalTimeInMonth);
        
//zmiana na format: xh ym      -> wszystkie niewybrane;   
        $withoutTypes = $this->changeHoursDisplay($withoutTypes);
         
//zmiana na format: xh ym        -> całkowity czas poszczegolnych typów 
        foreach ($allTypesAndTime as &$value) {
            $value = $this->changeHoursDisplay($value);
        }
        
        return $this->render('webmonitor/stats.html.twig', array(
            'month' => $month,
            'totalTimeInMonth' => $totalTimeInMonth,
            'withoutTypes' => $withoutTypes,
            'allTypesAndTime' => $allTypesAndTime,
            'userArray' => $userArray
        ));
    }
    
    public function changeHoursDisplay($time) {
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
            
            $totalTime = $tempTime[0].'h '.$tempTime[1].'m';
        } else {
            $totalTime = $tempTime[0].'h';
        }
        
        return $totalTime;
    }
    
    public function checkDanger($percent, $budget, $time) {
        if (($budget*$percent)/100 < $time*self::GODZINA) {
            return 0;
        } else {
            return 1;
        }
    }
}