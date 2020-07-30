<?php

class cron extends database
{

    public function cron1otomoto($id,$tablecar)
    {
        echo '</br> cronotomoto </br>';
             
        error_reporting(E_ALL); //DOM error
        include_once('../engine/simple_html_dom.php'); //DOM

        $cron = $this->pdo->prepare("SELECT * FROM user WHERE id = $id");
        $cron->execute();
        $row = $cron->fetch(PDO::FETCH_ASSOC);
        // echo $row['linkotomoto'];

        // $html = file_get_html('https://www.otomoto.pl/osobowe/od-2005/pyrzowice/?search%5Bfilter_float_price%3Afrom%5D=3000&search%5Bfilter_float_price%3Ato%5D=5000&search%5Bfilter_float_year%3Ato%5D=2020&search%5Bfilter_enum_fuel_type%5D%5B0%5D=diesel&search%5Bfilter_enum_gearbox%5D%5B0%5D=manual&search%5Bfilter_enum_gearbox%5D%5B1%5D=manual-sequential&search%5Bfilter_enum_damaged%5D=0&search%5Bfilter_enum_no_accident%5D=1&search%5Border%5D=created_at%3Adesc&search%5Bbrand_program_id%5D%5B0%5D=&search%5Bdist%5D=50&search%5Bcountry%5D=');
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
    }


    public function cron1olx($id,$tablecar)
    {
        echo '</br> cron1olx </br>';
       
        error_reporting(E_ALL); //DOM error
        include_once('../engine/simple_html_dom.php'); //DOM

        $cron = $this->pdo->prepare("SELECT * FROM user WHERE id = $id");
        $cron->execute();
        $row = $cron->fetch(PDO::FETCH_ASSOC);
        // $html = file_get_html('https://www.otomoto.pl/osobowe/od-2005/pyrzowice/?search%5Bfilter_float_price%3Afrom%5D=3000&search%5Bfilter_float_price%3Ato%5D=5000&search%5Bfilter_float_year%3Ato%5D=2020&search%5Bfilter_enum_fuel_type%5D%5B0%5D=diesel&search%5Bfilter_enum_gearbox%5D%5B0%5D=manual&search%5Bfilter_enum_gearbox%5D%5B1%5D=manual-sequential&search%5Bfilter_enum_damaged%5D=0&search%5Bfilter_enum_no_accident%5D=1&search%5Border%5D=created_at%3Adesc&search%5Bbrand_program_id%5D%5B0%5D=&search%5Bdist%5D=50&search%5Bcountry%5D=');
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
  
   public function cron1olxpremium($id,$tablecar)
    {
        echo '</br> cron1olxpremium </br>';
       
        error_reporting(E_ALL); //DOM error
        include_once('../engine/simple_html_dom.php'); //DOM

        $cron = $this->pdo->prepare("SELECT * FROM user WHERE id = $id");
        $cron->execute();
        $row = $cron->fetch(PDO::FETCH_ASSOC);
        // $html = file_get_html('https://www.otomoto.pl/osobowe/od-2005/pyrzowice/?search%5Bfilter_float_price%3Afrom%5D=3000&search%5Bfilter_float_price%3Ato%5D=5000&search%5Bfilter_float_year%3Ato%5D=2020&search%5Bfilter_enum_fuel_type%5D%5B0%5D=diesel&search%5Bfilter_enum_gearbox%5D%5B0%5D=manual&search%5Bfilter_enum_gearbox%5D%5B1%5D=manual-sequential&search%5Bfilter_enum_damaged%5D=0&search%5Bfilter_enum_no_accident%5D=1&search%5Border%5D=created_at%3Adesc&search%5Bbrand_program_id%5D%5B0%5D=&search%5Bdist%5D=50&search%5Bcountry%5D=');
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