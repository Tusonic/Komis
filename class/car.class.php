<?php

class car extends database

{

    public function EXPORT_DATABASE($host, $user, $pass, $name, $tables = false, $backup_name = false)
    {
        set_time_limit(3000);
        $mysqli = new mysqli($host, $user, $pass, $name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");
        $queryTables = $mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $name . "`\r\n--\r\n\r\n\r\n";
        foreach ($target_tables as $table) {
            if (empty($table)) {
                continue;
            }
            $result = $mysqli->query('SELECT * FROM `' . $table . '`');
            $fields_amount = $result->field_count;
            $rows_num = $mysqli->affected_rows;
            $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine = $res->fetch_row();
            $content .= "\n\n" . $TableMLine[1] . ";\n\n";
            $TableMLine[1] = str_ireplace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $TableMLine[1]);
            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter % 100 == 0 || $st_counter == 0) {
                        $content .= "\nINSERT INTO " . $table . " VALUES";
                    }
                    $content .= "\n(";
                    for ($j = 0; $j < $fields_amount; $j++) {
                        $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                        if (isset($row[$j])) {
                            $content .= '"' . $row[$j] . '"';
                        } else {
                            $content .= '""';
                        }
                        if ($j < ($fields_amount - 1)) {
                            $content .= ',';
                        }
                    }
                    $content .= ")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                        $content .= ";";
                    } else {
                        $content .= ",";
                    }
                    $st_counter = $st_counter + 1;
                }
            }
            $content .= "\n\n\n";
        }
        $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
        $backup_name = $backup_name ? $backup_name : $name . '___(' . date('H-i-s') . '_' . date('d-m-Y') . ').sql';
        ob_get_clean();
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header('Content-Length: ' . (function_exists('mb_strlen') ? mb_strlen($content, '8bit') : strlen($content)));
        header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
        echo $content;
        exit;
    }


    public function DeleteData()
    {
        $tablecar = $_SESSION['tablecar'];
        $sta = $this->pdo->prepare("TRUNCATE TABLE $tablecar ");
        //    $sta->bindValue(':tablecar', $_SESSION['tablecar'], PDO::PARAM_STR);
        $sta->execute();

        echo '
            </br>
            <div class="row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <h4 class="alert-heading">System OK!</h4>
                             <p class="text-center">Baza analizatora została wyczyszczona!</p>
                             <p><a class="btn btn-success btn-lg btn-block" href="../index.php" role="button">OK &raquo;</a></p>
                     </div>
                </div>

                <div class="col-md-3">

                </div>

            </div>
           
            ';

    }

    public function Info()
    {
        echo '</br>
            <div class="row">

                <div class="col-md-4">
                  <p><a class="btn btn-success btn-lg btn-block" href="downloaddata.php" role="button">Pobierz bazę &raquo;</a></p>
                  <p><a class="btn btn-success btn-lg btn-block" href="deletedata.php" role="button">Usuń bazę &raquo;</a></p>
                </div>
                
                <div class="col-md-4">
                  <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button">Powiadomienia S M S &raquo;</a></p>
                  <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button">Powiadomienia EMAIL &raquo;</a></p>
                </div>
                
                <div class="col-md-4">
                  <p><a class="btn btn-success btn-lg btn-block" href="options.php" role="button">Zmiana parametrów &raquo;</a></p>
                  <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button">Ulubione oferty &raquo;</a></p>
                </div>
              
             </div>
          
          
          ';

    }


    public function CarChange()
    {

        $change = $this->pdo->prepare("UPDATE user SET flag = '1', model = :model, marka = :marka, cenaod = :cenaod, cenado = :cenado, rokod = :rokod, rokdo = :rokdo, stantechniczny = :stantechniczny, skrzynia = :skrzynia, paliwo = :paliwo, lokalizacja = :lokalizacja, dystans = :dystans  WHERE login = :login ");
        $change->bindValue(':login', $_SESSION['login'], PDO::PARAM_STR);

        if ($_POST['marka'] == null) {
            $change->bindValue(':marka', $_SESSION['marka'], PDO::PARAM_STR);
        } else {
            $change->bindValue(':marka', $_POST['marka'], PDO::PARAM_STR);
        }

        if ($_POST['model'] == null) {
            $change->bindValue(':model', $_SESSION['model'], PDO::PARAM_STR);
        } else {
            $change->bindValue(':model', $_POST['model'], PDO::PARAM_STR);
        }

        $change->bindValue(':marka', $_POST['marka'], PDO::PARAM_STR);
        $change->bindValue(':model', $_POST['model'], PDO::PARAM_STR);
        $change->bindValue(':cenaod', $_POST['cenaod'], PDO::PARAM_STR);
        $change->bindValue(':cenado', $_POST['cenado'], PDO::PARAM_STR);
        $change->bindValue(':rokod', $_POST['rokod'], PDO::PARAM_STR);
        $change->bindValue(':rokdo', $_POST['rokdo'], PDO::PARAM_STR);
        $change->bindValue(':stantechniczny', $_POST['stantechniczny'], PDO::PARAM_STR);
        $change->bindValue(':skrzynia', $_POST['skrzynia'], PDO::PARAM_STR);
        $change->bindValue(':paliwo', $_POST['paliwo'], PDO::PARAM_STR);
        $change->bindValue(':lokalizacja', $_POST['lokalizacja'], PDO::PARAM_STR);
        $change->bindValue(':dystans', $_POST['dystans'], PDO::PARAM_STR);
        $change->execute();

        echo '
            </br>
            <div class="row">
            
                <div class="col-md-3">
                </div>
                
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <h4 class="alert-heading">System OK!</h4>
                             <p class="text-center">Dane poprawnie wprowadzone do analizatora!</p>
                             <p><a class="btn btn-success btn-lg btn-block" href="../index.php" role="button">OK &raquo;</a></p>
                     </div>
                </div>
                    
                <div class="col-md-3">
                    
                </div>
            
            </div>
            ';

        // odswiezenie statystyk
        $loadinguser = $this->pdo->prepare("select * from user WHERE login = '{$_SESSION['login']}' ");
        $loadinguser->execute();
        $row = $loadinguser->fetch(PDO::FETCH_ASSOC);

        $_SESSION['flag'] = $row['flag'];
        $_SESSION['tablecar'] = $row['tablecar'];
        $_SESSION['lokalizacja'] = $row['lokalizacja'];
        $_SESSION['dystans'] = $row['dystans'];
        $_SESSION['marka'] = $row['marka'];
        $_SESSION['model'] = $row['model'];
        $_SESSION['cenaod'] = $row['cenaod'];
        $_SESSION['cenado'] = $row['cenado'];
        $_SESSION['rokod'] = $row['rokod'];
        $_SESSION['rokdo'] = $row['rokdo'];
        $_SESSION['paliwo'] = $row['paliwo'];
        $_SESSION['stantechniczny'] = $row['stantechniczny'];
        $_SESSION['skrzynia'] = $row['skrzynia'];
        $_SESSION['linkotomoto'] = $row['linkotomoto'];
        $_SESSION['linkolx'] = $row['linkolx'];
        $_SESSION['waznosc'] = $row['waznosc'];
        // odswiezenie statystyk koniec
    }

    public function ChangeOptions()
    {
        echo '

<div class="row"> 
         <div class="col-md-3"> </div>   
         
         <div class="col-md-6">
         
         <h2><p class="text-center">USTAWIENIA</p></h2>
         
         
        <table id="table" class="table table-striped table-bordered"  width="100%" cellspacing="0"> 
                 <thead>
                       <tr> 
                             <th scope="col">Nazwa</th>
                             <th scope="col">Parametr</th>
                        </tr>
                   </thead>
                <tbody>     
                
                 <form method="POST" action="carchange.php">

                  <tr>
                  <td>Użytkownik:</td>
                  <td>' . $_SESSION['login'] . '</td>
                  <input type="hidden" value="' . $_SESSION['login'] . '" name="login"/>
                  </tr>
                  
                  <tr>
                  <td>Marka:</td>
                  <td><input  name="marka" class="form-control" type="text"  value="' . $_SESSION['marka'] . '" placeholder=" ' . $_SESSION['marka'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Model:</td>
                  <td><input  name="model" class="form-control" type="text"  value="" placeholder=" ' . $_SESSION['model'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Cena od:</td>
                  <td><input  name="cenaod" class="form-control" type="text"  value="' . $_SESSION['cenaod'] . '" placeholder=" ' . $_SESSION['cenaod'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Cena do:</td>
                  <td><input  name="cenado" class="form-control" type="text"  value="' . $_SESSION['cenado'] . '" placeholder=" ' . $_SESSION['cenado'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Rok od:</td>
                  <td><input  name="rokod" class="form-control" type="text"  value="' . $_SESSION['rokod'] . '" placeholder=" ' . $_SESSION['rokod'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Rok do:</td>
                  <td><input  name="rokdo" class="form-control" type="text"  value="' . $_SESSION['rokdo'] . '" placeholder=" ' . $_SESSION['rokdo'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Lokalizacja:</td>
                  <td><input  name="lokalizacja" class="form-control" type="text"  value="' . $_SESSION['lokalizacja'] . '" placeholder=" ' . $_SESSION['lokalizacja'] . ' "> </td>
                  </tr>
                  
                  <tr>
                  <td>W promieniu (kilometry):</td>
                  <td><input  name="dystans" class="form-control" type="text"  value="' . $_SESSION['dystans'] . '" placeholder=" ' . $_SESSION['dystans'] . ' "></td>
                  </tr>
                  
                  ';


        // START blok sprawdzajacy status stantechniczny

        if ($_SESSION['stantechniczny'] == 'Wszystkie') {
            echo '

                     <tr>
                  <td>Stan techniczny:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Wszystkie" checked >
                      <label class="form-check-label" for="stantechniczny">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Nieuszkodzony" >
                      <label class="form-check-label" for="stantechniczny">
                        Nieuszkodzony
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Uszkodzony">
                      <label class="form-check-label" for="stantechniczny">
                        Uszkodzony
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';
        } elseif ($_SESSION['stantechniczny'] == 'Nieuszkodzony') {
            echo '

                     <tr>
                  <td>Stan techniczny:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Wszystkie"  >
                      <label class="form-check-label" for="stantechniczny">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Nieuszkodzony" checked >
                      <label class="form-check-label" for="stantechniczny">
                        Nieuszkodzony
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Uszkodzony">
                      <label class="form-check-label" for="stantechniczny">
                        Uszkodzony
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';
        } elseif ($_SESSION['stantechniczny'] == 'Uszkodzony') {
            echo '

                     <tr>
                  <td>Stan techniczny:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Wszystkie"  >
                      <label class="form-check-label" for="stantechniczny">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Nieuszkodzony"  >
                      <label class="form-check-label" for="stantechniczny">
                        Nieuszkodzony
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Uszkodzony" checked>
                      <label class="form-check-label" for="stantechniczny">
                        Uszkodzony
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';
        } else {
            echo '

                     <tr>
                  <td>Stan techniczny:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Wszystkie"  >
                      <label class="form-check-label" for="stantechniczny">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Nieuszkodzony" >
                      <label class="form-check-label" for="stantechniczny">
                        Nieuszkodzony
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="stantechniczny" value="Uszkodzony">
                      <label class="form-check-label" for="stantechniczny">
                        Uszkodzony
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';

        }

        // KONIEC blok sprawdzajacy status stantechniczny


        // START blok sprawdzajacy status stantechniczny

        if ($_SESSION['skrzynia'] == 'Wszystkie') {
            echo '

                     <tr>
                  <td>Skrzyniay:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Wszystkie" checked >
                      <label class="form-check-label" for="skrzynia">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Manualna" >
                      <label class="form-check-label" for="skrzynia">
                        Manualna
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Automatyczna">
                      <label class="form-check-label" for="skrzynia">
                        Automatyczna
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';
        } elseif ($_SESSION['skrzynia'] == 'Manualna') {
            echo '

                     <tr>
                  <td>Skrzyniay:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Wszystkie"  >
                      <label class="form-check-label" for="skrzynia">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Manualna" checked >
                      <label class="form-check-label" for="skrzynia">
                        Manualna
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Automatyczna">
                      <label class="form-check-label" for="skrzynia">
                        Automatyczna
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';
        } elseif ($_SESSION['skrzynia'] == 'Automatyczna') {
            echo '

                     <tr>
                  <td>Skrzyniay:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Wszystkie" >
                      <label class="form-check-label" for="skrzynia">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Manualna" >
                      <label class="form-check-label" for="skrzynia">
                        Manualna
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Automatyczna" checked>
                      <label class="form-check-label" for="skrzynia">
                        Automatyczna
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';
        } else {
            echo '

                      <tr>
                  <td>Skrzyniay:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Wszystkie">
                      <label class="form-check-label" for="skrzynia">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Manualna">
                      <label class="form-check-label" for="skrzynia">
                        Manualna
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="skrzynia" value="Automatyczna">
                      <label class="form-check-label" for="skrzynia">
                        Automatyczna
                      </label>
                     </div>
                  </td>
                  </tr>

                     ';

        }


        // KONIEC blok sprawdzajacy status stantechniczny

        if ($_SESSION['paliwo'] == 'Wszystkie') {
            echo '

                    <tr>
                  <td>Paliwo:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Wszystkie" checked>
                      <label class="form-check-label" for="paliwo">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Benzyna">
                      <label class="form-check-label" for="paliwo">
                        Benzyna
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="LPG">
                      <label class="form-check-label" for="paliwo">
                        Benzyna + LPG
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Diesel">
                      <label class="form-check-label" for="paliwo">
                        Diesel
                      </label>
                      </div>
                      
                      ';
        } elseif ($_SESSION['paliwo'] == 'Benzyna') {
            echo '

                    <tr>
                  <td>Paliwo:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Wszystkie" >
                      <label class="form-check-label" for="paliwo">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Benzyna" checked>
                      <label class="form-check-label" for="paliwo">
                        Benzyna
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="LPG">
                      <label class="form-check-label" for="paliwo">
                        Benzyna + LPG
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Diesel">
                      <label class="form-check-label" for="paliwo">
                        Diesel
                      </label>
                      </div>
                      
                      ';
        } elseif ($_SESSION['paliwo'] == 'LPG') {
            echo '

                    <tr>
                  <td>Paliwo:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Wszystkie" >
                      <label class="form-check-label" for="paliwo">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Benzyna">
                      <label class="form-check-label" for="paliwo">
                        Benzyna
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="LPG" checked>
                      <label class="form-check-label" for="paliwo">
                        Benzyna + LPG
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Diesel">
                      <label class="form-check-label" for="paliwo">
                        Diesel
                      </label>
                      </div>
                      
                      ';
        } elseif ($_SESSION['paliwo'] == 'Diesel') {
            echo '

                    <tr>
                  <td>Paliwo:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Wszystkie" >
                      <label class="form-check-label" for="paliwo">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Benzyna">
                      <label class="form-check-label" for="paliwo">
                        Benzyna
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="LPG">
                      <label class="form-check-label" for="paliwo">
                        Benzyna + LPG
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Diesel" checked>
                      <label class="form-check-label" for="paliwo">
                        Diesel
                      </label>
                      </div>
                      
                      ';
        } else {
            echo '

                     <tr>
                  <td>Paliwo:</td>
                  <td>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Wszystkie" >
                      <label class="form-check-label" for="paliwo">
                        Wszystkie
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Benzyna">
                      <label class="form-check-label" for="paliwo">
                        Benzyna
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="LPG">
                      <label class="form-check-label" for="paliwo">
                        Benzyna + LPG
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Diesel">
                      <label class="form-check-label" for="paliwo">
                        Diesel
                      </label>
                      </div>
                 
                      
                      ';
        }


        echo '

                  </td>
                  </tr>

                </tbody>
                </table>
                
                 <div class="text-center">
                <a class="btn btn-info " href="../index.php" role="button"><<< Anuluj</a> 
                
             
               <input class="btn btn-lg btn-success" type="submit" value="Dalej >>>">
                </div>
                
                 </form>  
                 </div>
                 <div class="col-md-3"></div>
                  ';

    }

    public function ViewOptions()
    {

        echo '


        
        <h5><p class="text-center">AKTUALNE USTAWIENIA ANALIZATORA</p></h5></br>
        
        <div class="row"> 
             <div class="col-md-4"> 
                 <p class="text-center"><b>Marka:</b> ' . $_SESSION['marka'] . '</p>
                 <p class="text-center"><b>Model:</b> ' . $_SESSION['model'] . '</p>
                 <p class="text-center"><b>Lokalizacja:</b> ' . $_SESSION['lokalizacja'] . '</p>
                 <p class="text-center"><b>Promień poszukiwań:</b> ' . $_SESSION['dystans'] . ' <b>km</b></p>
             </div> 
             <div class="col-md-4"> 
                 <p class="text-center"><b>Cena od:</b> ' . $_SESSION['cenaod'] . '</p>
                 <p class="text-center"><b>Cena do:</b> ' . $_SESSION['cenado'] . '</p>
                 <p class="text-center"><b>Rok od:</b> ' . $_SESSION['rokod'] . '</p>
                 <p class="text-center"><b>Rok do:</b> ' . $_SESSION['rokdo'] . '</p>
             </div> 
             <div class="col-md-4"> 
                 <p class="text-center"><b>Paliwo:</b> ' . $_SESSION['paliwo'] . '</p>
                 <p class="text-center"><b>Stan techniczny:</b> ' . $_SESSION['stantechniczny'] . '</p>
                 <p class="text-center"><b>Rodzaj skrzyni biegów:</b> ' . $_SESSION['skrzynia'] . '</p>
                  <p class="text-center"><b>Analizator:</b> Automat (5min)</p>
             </div> 
         </div>

        
        ';
    }


    public function View($tablecar)

    {

        if (isset($_POST['id'])) {
            $updateflagcar = $this->pdo->prepare("UPDATE $tablecar SET flag = '1' WHERE id = :id");
            $updateflagcar->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
            $updateflagcar->execute();
        } else {

        }

        $viewCar = $this->pdo->prepare('select * from ' . $tablecar . ' ORDER BY id DESC');
        $viewCar->bindValue(':link', $tablecar);
        $viewCar->execute();


        echo ' 
 <h2><p class="text-center">OFERTY</p></h2>
 
 <script>
 $.extend( true, $.fn.dataTable.defaults, {
    "searching": false,
    "ordering": false
    
} );
 
 
$(document).ready(function() {
    $(\'#viewtablenosort\').DataTable();
} );
</script>
 
           
            <table id="viewtablenosort" class="table table-striped table-bordered" width="100%" cellspacing="0"> 
                 <thead>
                       <tr> 
                             <th scope="col">#</th>
                             <th >Data</th>
                             <th >Adres WWW</th>
                             <th >Link</th>
                             <th> </th>
                        </tr>
                   </thead>
                <tbody>               
         ';

        while ($row = $viewCar->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $time = $row['time'];
            $link = $row['link'];
            $flag = $row['flag'];


            echo '
                <tr>
                            <th scope="row">' . $id . '</th>
                            <td>' . $time . '</td>
                            <td>' . $link . '</td>
                            <td> <a target="_blank" href="' . $link . '" class="btn btn-primary btn-sm" role="button" aria-pressed="true">LINK</a> </td>
                            <td> 
                            ';
            if ($row['flag'] == '1') {
                echo '<button type="button" class="btn btn-sm btn-success" disabled>Zaznacz</button> ';
            } else {
                echo '
                                    <form method="POST" action="view.php">
                                    <input type="hidden" value="' . $row['id'] . '" name="id"/>
                                    <input type="submit" class="btn btn-primary btn-sm" value="Zaznacz"/>
                                    </form>
                                ';
            }


            //CHECK AVALIBLE BELT
            /*    if ($available == 0) {

                    echo '<span class="badge badge-pill badge-success">YES</span>';

                }

                if ($available == 1) {
                    echo '<span class="badge badge-pill badge-danger">NO</span>';
                } */


            echo '</td>
                </tr>
                            ';

        }

        echo '
        
                  </tbody>
        
               </table>

         ';


    }

    public function ViewFav($tablecar)

    {

        if (isset($_POST['id'])) {
            $updateflagcar = $this->pdo->prepare("UPDATE $tablecar SET flag = '0' WHERE id = :id");
            $updateflagcar->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
            $updateflagcar->execute();
        } else {

        }

        $viewCar = $this->pdo->prepare('select * from ' . $tablecar . ' WHERE flag = 1 ORDER BY id DESC');
        $viewCar->bindValue(':link', $tablecar);
        $viewCar->execute();


        echo ' 
 <h2><p class="text-center">ULUBIONE OFERTY</p></h2>
 
 <script>
 $.extend( true, $.fn.dataTable.defaults, {
    "searching": false,
    "ordering": false
    
} );
 
 
$(document).ready(function() {
    $(\'#viewtablenosort\').DataTable();
} );
</script>
 
           
            <table id="viewtablenosort" class="table table-striped table-bordered" width="100%" cellspacing="0"> 
                 <thead>
                       <tr> 
                             <th scope="col">#</th>
                             <th >Data</th>
                             <th >Adres WWW</th>
                             <th >Link</th>
                             <th> </th>
                        </tr>
                   </thead>
                <tbody>               
         ';

        while ($row = $viewCar->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $time = $row['time'];
            $link = $row['link'];
            $flag = $row['flag'];


            echo '
                <tr>
                            <th scope="row">' . $id . '</th>
                            <td>' . $time . '</td>
                            <td>' . $link . '</td>
                            <td> <a target="_blank" href="' . $link . '" class="btn btn-primary btn-sm" role="button" aria-pressed="true">LINK</a> </td>
                            <td> 
                           
                                    <form method="POST" action="viewfav.php">
                                    <input type="hidden" value="' . $row['id'] . '" name="id"/>
                                    <input type="submit" class="btn btn-warning btn-sm" value="Odznacz"/>
                                    </form></td>
                </tr> 
                                ';

        }
        echo '</tbody>
        
               </table>';


    }






}

?>