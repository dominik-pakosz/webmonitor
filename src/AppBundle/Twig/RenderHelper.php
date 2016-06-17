<?php

namespace AppBundle\Twig;

class RenderHelper extends \Twig_Extension
{
    private $text = '';
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderAll', array($this, 'renderAll'))
        );
    }

    public function renderAll($main, $children, $ids, $names, $kwota)
    {
        $this->renderChildren($main, $children, $ids, $names, $kwota);
        return $this->text;
    }
    
    public function renderChildren($main, $children, $ids, $names, $kwota, $iteration = 1)
    {
        
        foreach ($main as $key=>$val) {
            
            if ($this->checkDanger($val['task_percent_complete'], $val['task_target_budget'], $val['task_duration'], $kwota)) {
                $this->text .= '<tr class="warning">';
            } else {
                $this->text .= '<tr>';
            }
            
            if ($iteration > 10) {
                $this->text .= '<td style="padding-left:'.$iteration.'px"><img src="http://projekty.int.kompan.pl/images/corner-dots.gif" /><a target="_blank" href="http://projekty.int.kompan.pl/index.php?m=tasks&a=view&task_id='.$val['task_id'].'&tab=0">'.$val['task_name'].'</a></td>';
            } else {
                $this->text .= '<td><a target="_blank" href="http://projekty.int.kompan.pl/index.php?m=tasks&a=view&task_id='.$val['task_id'].'&tab=0">'.$val['task_name'].'</a></td>';
            }
            
            $this->text .= '<td>'.$names[$val['task_creator']].'</td><td>';
            
            if(isset($ids[$val['task_id']])) {
                foreach($ids[$val['task_id']] as $task) {
                    $this->text .= $names[$task].'<br />';
                }
            }
            
            $this->text .= '</td><td><span class="label label-default">'.$val['task_target_budget']." zł</span></td>";
            
            if ($val['task_duration']*$kwota > $val['task_target_budget']) {
                $this->text .= '<td><span class="label label-danger">'.$val['task_duration']*$kwota.' zł</span></td>';
            } else {
                $this->text .= '<td><span class="label label-success">'.$val['task_duration']*$kwota.' zł</span></td>';   
            }
            
            $this->text .= '<td>'.$this->changeHoursDisplay($val['task_duration']).'</td>';
            
            if ($val['task_percent_complete'] == 100) {
                $this->text .= '<td><div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'.
                $val['task_percent_complete'].'%;">'.$val['task_percent_complete'].'%</div>'
                .'</div></td>';
            } else {
                $this->text .= '<td><div class="progress">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'.
                $val['task_percent_complete'].'%;">'.$val['task_percent_complete'].'%</div>'
                .'</div></td>';
            }
            $this->text .= '</tr>';
            if (isset($children[$key])) {
               $this->renderChildren($children[$key], $children, $ids, $names, $kwota, $iteration + 10);
            }
        }
    }

    public function getName()
    {
        return 'render_extension';
    }
    
    public function changeHoursDisplay($time) {
        $tempTime = explode('.', $time);
        if(sizeof($tempTime)>1) {
            
            if(strlen($tempTime[1]) == 1) {
                $tempTime[1] = round($tempTime[1]*6);
            } else {
                $tempTime[1] = round($tempTime[1]*0.6);
            }

            if(strlen($tempTime[1]) == 1) {
                $tempTime[1] = '0'.$tempTime[1];
            }
            
            $totalTime = $tempTime[0].'h '.$tempTime[1].'m';
        } else {
            $totalTime = $tempTime[0].'h';
        }
        
        return $totalTime;
    }
    
    public function checkDanger($percent, $budget, $time, $kwota) {
        if (($budget*$percent)/100 >= $time*$kwota) {
            return 0;
        } else {
            return 1;
        }
    }
}