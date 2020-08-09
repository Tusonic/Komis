<?php

class cron extends database
{

    public function CronOtomoto($id,$tablecar)
    {

        echo '</br> CronOtomoto </br>';
             
        error_reporting(E_ALL); //DOM error
        include_once('../engine/simple_html_dom.php'); //DOM

        $cron = $this->pdo->prepare("SELECT * FROM user WHERE id = $id");
        $cron->execute();
        $row = $cron->fetch(PDO::FETCH_ASSOC);
        $html = file_get_html($row['linkotomoto']);
        foreach ($html->find('a[class="offer-title__link"]') as $element) {
            echo $element->href . '<br>';

            $link = $element->href;
            $carload = $this->pdo->prepare("SELECT link FROM $tablecar WHERE link = '$link' ");
            $carload->execute();
            $row = $carload->rowCount();


            if ($row > 0) {
                echo " Link - - - " . $link . " </br>";
            } else {

                $stmt = $this->pdo->prepare("INSERT INTO $tablecar (link) VALUE (:link) ");
                $stmt->bindValue(':link', $element->href, PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            }
        }
        echo 'test start wykonywalny </br>';
        if (isset($element))
        {
            echo 'ok';
            $change = $this->pdo->prepare("UPDATE user SET statuslink = '4'  WHERE id = :id ");
            $change->bindValue(':id', $id, PDO::PARAM_STR);
            $change->execute();
        }
        else
        {
            echo 'error';
            $change = $this->pdo->prepare("UPDATE user SET statuslink = '1'  WHERE id = :id ");
            $change->bindValue(':id', $id, PDO::PARAM_STR);
            $change->execute();
        }
        echo '</br>test end111 </br>';



    }


    public function CronOlx($id,$tablecar)
    {
        echo '</br> CronOlx </br>';
       
        error_reporting(E_ALL); //DOM error
        include_once('../engine/simple_html_dom.php'); //DOM

        $cron = $this->pdo->prepare("SELECT * FROM user WHERE id = $id");
        $cron->execute();
        $row = $cron->fetch(PDO::FETCH_ASSOC);
        $html = file_get_html($row['linkolx']);
        foreach ($html->find('a[class="marginright5 link linkWithHash detailsLink"]') as $element) {
            echo $element->href . '<br>';

            $link = $element->href;
            $carload = $this->pdo->prepare("SELECT link FROM $tablecar WHERE link = '$link' ");
            $carload->execute();
            $row = $carload->rowCount();


            if ($row > 0) {
                echo " Link - - - " . $link . " </br>";
            } else {

                $stmt = $this->pdo->prepare("INSERT INTO $tablecar (link) VALUE (:link) ");
                $stmt->bindValue(':link', $element->href, PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            }

        }



    }
  
   public function CronOlxPremium($id,$tablecar)
    {
        echo '</br> CronOlxPremium </br>';
       
        error_reporting(E_ALL); //DOM error
        include_once('../engine/simple_html_dom.php'); //DOM

        $cron = $this->pdo->prepare("SELECT * FROM user WHERE id = $id");
        $cron->execute();
        $row = $cron->fetch(PDO::FETCH_ASSOC);
        $html = file_get_html($row['linkolx']);
        foreach ($html->find('a[class="marginright5 link linkWithHash detailsLinkPromoted"]') as $element) {
            echo $element->href . '<br>';

            $link = $element->href;
            $carload = $this->pdo->prepare("SELECT link FROM $tablecar WHERE link = '$link' ");
            $carload->execute();
            $row = $carload->rowCount();


            if ($row > 0) {
                echo " Link - - - " . $link . " </br>";
            } else {

                $stmt = $this->pdo->prepare("INSERT INTO $tablecar (link) VALUE (:link) ");
                $stmt->bindValue(':link', $element->href, PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            }

        }
    }

}