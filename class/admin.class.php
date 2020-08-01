<?php

class admin extends database
{

    public function CarUserChange()
    {
                
                $change = $this->pdo->prepare("UPDATE user SET flag = '0', model = :model, marka = :marka, cenaod = :cenaod, cenado = :cenado, rokod = :rokod, rokdo = :rokdo, stantechniczny = :stantechniczny, skrzynia = :skrzynia, paliwo = :paliwo, lokalizacja = :lokalizacja, dystans = :dystans, linkotomoto = :linkotomoto, linkolx = :linkolx  WHERE id = :id ");
                $change->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
                $change->bindValue(':model', $_POST['model'], PDO::PARAM_STR);
                $change->bindValue(':marka', $_POST['marka'], PDO::PARAM_STR);
                $change->bindValue(':cenaod', $_POST['cenaod'], PDO::PARAM_STR);
                $change->bindValue(':cenado', $_POST['cenado'], PDO::PARAM_STR);
                $change->bindValue(':rokod', $_POST['rokod'], PDO::PARAM_STR);
                $change->bindValue(':rokdo', $_POST['rokdo'], PDO::PARAM_STR);
                $change->bindValue(':stantechniczny', $_POST['stantechniczny'], PDO::PARAM_STR);
                $change->bindValue(':skrzynia', $_POST['skrzynia'], PDO::PARAM_STR);
                $change->bindValue(':paliwo', $_POST['paliwo'], PDO::PARAM_STR);
                $change->bindValue(':lokalizacja', $_POST['lokalizacja'], PDO::PARAM_STR);
                $change->bindValue(':dystans', $_POST['dystans'], PDO::PARAM_STR);
                $change->bindValue(':linkotomoto', $_POST['linkotomoto'], PDO::PARAM_STR);
                $change->bindValue(':linkolx', $_POST['linkolx'], PDO::PARAM_STR);
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
    }

    public function ViewUser()
    {
        $ViewUser = $this->pdo->prepare('select * from user ORDER BY id DESC');
        $ViewUser->execute();

        echo ' 
 
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
                             <th >Login</th>
                             <th >Hasło</th>
                             <th >Ważność</th>
                             <th >Konto</th>
                             <th >Flag</th>
                             
                           
                        </tr>
                   </thead>
                <tbody>               
         ';

        while ($row = $ViewUser->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $login = $row['login'];
            $pass = $row['pass'];
            $flag = $row['flag'];
            $marka = $row['marka'];
            $model = $row['model'];
            $cenaod = $row['cenaod'];
            $cenado = $row['cenado'];
            $rokod = $row['rokod'];
            $rokdo = $row['rokdo'];
            $paliwo = $row['paliwo'];
            $stantechniczny = $row['stantechniczny'];
            $skrzynia = $row['skrzynia'];

            echo '
                <tr>
                            <th scope="row">' . $row['id'] . '</th>
                            <td>' . $row['login'] . '</td>
                            <td>' . $row['pass'] . '</td>
                            <td>' . $row['waznosc'] . '</td>
                            <td>
                            ';
                                    if ($row['flag'] == 3) {
                                        echo '
                                   <button type="button" class="btn btn-sm btn-warning" disabled>Waiting</button>
                                        ';
                                    }
                                    elseif ($row['blocked'] == 1)
                                    {
                                        echo '
                                   <button type="button" class="btn btn-sm btn-primary" disabled>Zablokowane</button>
                                        ';

                                    } else {
                                        echo '
                                   <button type="button" class="btn btn-sm btn-success" disabled>Aktywne</button>
                                        ';

                                    }

                                  echo '
                            </td>
                            <td>
                            ';
                                    if ($row['flag'] == 0) {
                                        echo '
                                    <form method="POST" action="change.php">
                                    <input type="hidden" value="' . $row['id'] . '" name="id"/>
                                    <input type="submit" class="btn btn-success btn-sm" value="OK"/>
                                    </form>
                                        ';
                                    }
                                    else
                                    {
                                        echo '
                                    <form method="POST" action="change.php">
                                    <input type="hidden" value="' . $row['id'] . '" name="id"/>
                                    <input type="submit" class="btn btn-danger btn-sm" value="CHANGE"/>
                                    </form>
                                        ';

                                    }

                                  echo '
                            </td>

                                ';


        }
            echo '</td>
                </tr>  
                </tbody>
                </table>
                            ';

        }


    public function ChangeUser()
    {
        $ChangeUser = $this->pdo->prepare('select * from user WHERE id = :id');
        $ChangeUser->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
        $ChangeUser->execute();


        echo ' 
 
 <script>
 $.extend( true, $.fn.dataTable.defaults, {
    "searching": false,
    "ordering": false
} );
 
 
$(document).ready(function() {
    $(\'#viewtablenosort\').DataTable();
} );
</script>
 
           
             <table id="table" class="table table-striped table-bordered"  width="100%" cellspacing="0"> 
                 <thead>
                       <tr> 
                             <th scope="col">#</th>
                             <th >@</th>
                        
                             
                           
                        </tr>
                   </thead>
                <tbody>               
         ';

        while ($row = $ChangeUser->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $login = $row['login'];
            $pass = $row['pass'];
            $flag = $row['flag'];

            $lokalizacja = $row['lokalizacja'];
            $dystans = $row['dystans'];
            $marka = $row['marka'];
            $model = $row['model'];
            $cenaod = $row['cenaod'];
            $cenado = $row['cenado'];
            $rokod = $row['rokod'];
            $rokdo = $row['rokdo'];
            $paliwo = $row['paliwo'];
            $stantechniczny = $row['stantechniczny'];
            $skrzynia = $row['skrzynia'];
            $linkotomoto = $row['linkotomoto'];
            $linkolx = $row['linkolx'];

            echo '
            
            <form method="POST" action="caruserchange.php">
            
            <input type="hidden" value="' . $row['flag'] . '" name="flag"/>
            <input type="hidden" value="' . $row['id'] . '" name="id"/>
            
                <tr>
                    <th scope="row">#</th>
                    <th scope="row">' . $row['id'] . '</th>
                </tr>
                
                <tr>
                    <th scope="row">Login</th>
                    <th scope="row">' . $row['login'] . '</th>
                </tr>
                
                 <tr>
                    <th scope="row">Hasło</th>
                    <th scope="row">' . $row['pass'] . '</th>
                 </tr>
                 
                  <tr>
                    <th scope="row">Flaga</th>
                    <th scope="row">' . $row['flag'] . '</th>
                  </tr>
                  
                  <tr>
                  <td>Marka:</td>
                  <td><input  name="marka" class="form-control" type="text"  value="' . $row['marka'] . '" placeholder=" ' . $row['marka'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Model:</td>
                  <td><input  name="model" class="form-control" type="text"  value="' . $row['model'] . '" placeholder=" ' . $row['model'] . ' "></td>
                  </tr>
                                                     
                  <tr>
                  <td>Cena od:</td>
                  <td><input  name="cenaod" class="form-control" type="text"  value="' . $row['cenaod'] . '" placeholder=" ' . $row['cenaod'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Cena do:</td>
                  <td><input  name="cenado" class="form-control" type="text"  value="' . $row['cenado'] . '" placeholder=" ' . $row['cenado'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Rok od:</td>
                  <td><input  name="rokod" class="form-control" type="text"  value="' . $row['rokod'] . '" placeholder=" ' . $row['rokod'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Rok do:</td>
                  <td><input  name="rokdo" class="form-control" type="text"  value="' . $row['rokdo'] . '" placeholder=" ' . $row['rokdo'] . ' "></td>
                  </tr>
                  
                  <tr>
                  <td>Lokalizacja:</td>
                  <td><input  name="lokalizacja" class="form-control" type="text"  value="' . $row['lokalizacja'] . '" placeholder=" ' . $row['lokalizacja'] . ' ">
                 
                  </td>
                  </tr>
                  
                  <tr>
                  <td>W promieniu (kilometry):</td>
                  <td>
                  <input  name="dystans" class="form-control" type="text"  value="' . $row['dystans'] . '" placeholder=" ' . $row['dystans'] . ' ">
                  
                  </td>
                  </tr>
                  
                  ';
      
                
                  // START blok sprawdzajacy status stantechniczny 
      
                  if ($row['stantechniczny'] == 'Wszystkie')
                  {
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
                  }
      
                 elseif ($row['stantechniczny'] == 'Nieuszkodzony')
                  {
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
                  }
      
                 elseif ($row['stantechniczny'] == 'Uszkodzony')
                  {
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
                  }
                  
                  else
                  {
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
      
                  if ($row['skrzynia'] == 'Wszystkie')
                  {
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
                  }
      
                 elseif ($row['skrzynia'] == 'Manualna')
                  {
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
                  }
      
                 elseif ($row['skrzynia'] == 'Automatyczna')
                  {
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
                  }
                  
                  else
                  {
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
      
              if ($row['paliwo'] == 'Wszystkie')
                
              {                       
                  echo'

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
                        Benzyna+LPG
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
      
              elseif ($row['paliwo'] == 'Benzyna')
                
              {                       
                  echo'

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
                        Benzyna+LPG
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
      
               elseif ($row['paliwo'] == 'LPG')
                
              {                       
                  echo'

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
                        Benzyna+LPG
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
      
              elseif ($row['paliwo'] == 'Diesel')
                
              {                       
                  echo'

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
                        Benzyna+LPG
                      </label>
                      </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="Diesel" checked>
                      <label class="form-check-label" for="paliwo">
                        Diesel
                      </label>
                      </div>
                      
                      ';
              }
      
              else
                
                {                       
                  echo'

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
                      <label class="form-check-label" for="paliwo>
                        Benzyna
                      </label>
                      </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paliwo" value="LPG">
                      <label class="form-check-label" for="paliwo">
                        Benzyna+LPG
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
                  
                  <tr>
                  <td>Link otomoto:</td>
                  <td><input  name="linkotomoto" class="form-control" type="text"  value="' . $row['linkotomoto'] . '" placeholder=" ' . $row['linkotomoto']. ' ">
                 
                  </td>
                  </tr>
                  
                  <tr>
                  <td>Link olx:</td>
                  <td>
                  <input  name="linkolx" class="form-control" type="text"  value="' . $row['linkolx'] . '" placeholder=" ' . $row['linkolx'] . ' ">
                  
                  </td>
                  </tr>

                                
          
           </tbody>
                </table>
                
                 <div class="text-center">
                <a class="btn btn-info " href="../index.php" role="button"><<< Anuluj</a> 
                
             
               <input class="btn btn-lg btn-success" type="submit" value="Dalej >>>">
                </div>
                
                 </form>  
                 
                 ';

        }


     

    } // changeuser - zamkniecie



    } // główna class - zamkniecie

