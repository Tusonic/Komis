<?php

class cpu extends database
{

    public function cpulogic()
    {
        $CPU = $this->pdo->prepare("SELECT 
( SELECT COUNT(*) FROM car7 ) 
+ ( SELECT COUNT(*) FROM car8 ) 
+ ( SELECT COUNT(*) FROM car9 )
+ ( SELECT COUNT(*) FROM car10 )
+ ( SELECT COUNT(*) FROM car11 )
+ ( SELECT COUNT(*) FROM car12 )
+ ( SELECT COUNT(*) FROM car13 )
+ ( SELECT COUNT(*) FROM car14 )
+ ( SELECT COUNT(*) FROM car15 )
+ ( SELECT COUNT(*) FROM car16 )
+ ( SELECT COUNT(*) FROM car17 )
+ ( SELECT COUNT(*) FROM car18 )
+ ( SELECT COUNT(*) FROM car19 )
+ ( SELECT COUNT(*) FROM car20 )
+ ( SELECT COUNT(*) FROM car21 )
+ ( SELECT COUNT(*) FROM car22 )
+ ( SELECT COUNT(*) FROM car23 )
+ ( SELECT COUNT(*) FROM car24 )
+ ( SELECT COUNT(*) FROM car25 )
+ ( SELECT COUNT(*) FROM car26 )
+ ( SELECT COUNT(*) FROM car27 )
+ ( SELECT COUNT(*) FROM car28 )
+ ( SELECT COUNT(*) FROM car29 )
+ ( SELECT COUNT(*) FROM car30 )
+ ( SELECT COUNT(*) FROM car31 )
+ ( SELECT COUNT(*) FROM car32 )
+ ( SELECT COUNT(*) FROM car33 )
+ ( SELECT COUNT(*) FROM car34 )
+ ( SELECT COUNT(*) FROM car35 )
+ ( SELECT COUNT(*) FROM car36 )
+ ( SELECT COUNT(*) FROM car37 )
+ ( SELECT COUNT(*) FROM car38 )
+ ( SELECT COUNT(*) FROM car39 )
 ");
        $CPU->execute();
        $CPUinfo = $CPU->fetchColumn();
        echo 'Obciążenie serwera ';
        $CPUkomis = $CPUinfo * 0.008;
       // echo $CPUkomis;
     //   echo '%';

      
      if (($CPUkomis > 70) && ($CPUkomis < 100)) 
      {
        echo '
        <div class="progress" style="height: 30px;">
        <div class="progress-bar bg-warning" role="progressbar" style="width: '.$CPUkomis.'%;" aria-valuenow="'.$CPUkomis.'" aria-valuemin="0" aria-valuemax="100">'.$CPUkomis.'%</div>
        </div></br> </br>
         ';
      }
      elseif ($CPUkomis > 100)
      {
         echo '
        <div class="progress" style="height: 30px;">
        <div class="progress-bar bg-danger" role="progressbar" style="width: '.$CPUkomis.'%;" aria-valuenow="'.$CPUkomis.'" aria-valuemin="0" aria-valuemax="100">'.$CPUkomis.'%</div>
        </div></br> </br>
         ';
      }
      else
      {
         echo '
        <div class="progress" style="height: 30px;">
        <div class="progress-bar bg-info" role="progressbar" style="width: '.$CPUkomis.'%;" aria-valuenow="'.$CPUkomis.'" aria-valuemin="0" aria-valuemax="100">'.$CPUkomis.'%</div>
        </div></br> </br>
         ';
      }


    }
}