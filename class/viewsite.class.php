<?php

class viewsite extends database  {

    public $_login = null;
    public $_user = 1;
    public $_moderator = 2;
    public $_adminstrator = 3;


    public function StartHead()
    {
        echo'
                <!doctype html>
                <html lang="en">
                    <head>
                        <title>komis.info.pl</title>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                                                
                         <!-- Bootstrap CSS -->
                        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
                        <link rel="stylesheet" type="text/css" href="/css/datatables.css"/>
                          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                        <script type="text/javascript" src="/js/jquery-3.2.1.slim.min.js"></script>
                        <script type="text/javascript" src="/js/popper.min.js"></script>
                        <script type="text/javascript" src="/js/bootstrap.js"></script>
                        <script type="text/javascript" src="/js/datatables.js"></script>
                 
                    </head>
                <body>
                <div class="container">
                ';

    }

    public function Login()
    {


        if (isset($_POST['login'])) {


            $_SESSION['login'] = ($_POST['login']);
            $_SESSION['password'] = ($_POST['password']);

            $systemlogin = $this->pdo->prepare("SELECT COUNT(*) from user WHERE login = '{$_SESSION['login']}' AND pass = '{$_SESSION['password']}' AND blocked = 0");
            $systemlogin->execute();

            $num_rows = $systemlogin->fetchColumn();

            $systemloginblock = $this->pdo->prepare("SELECT COUNT(*) from user WHERE login = '{$_SESSION['login']}' AND pass = '{$_SESSION['password']}' AND blocked = 1");
            $systemloginblock->execute();

            $num_rows_block = $systemloginblock->fetchColumn();

            $_SESSION['login_in'] = $num_rows;
            $this->_login = $num_rows;

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


        }

        else

        {
            //COULD START
            //echo 'EMPTY LOGIN';
        }

        if (isset($_SESSION['login_in']))
        {
            if ($_SESSION['login_in'] == 0) {
                echo '
                         <!-- CODE LOGIN START-->
                           
<form action="index.php" method="POST">
                    </br>
                    
    <div class="row"> 
         <div class="col-md-3"> </div>                
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">komis.info.pl</h3>
                    </div>
                    
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form">
                        <fieldset>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        
                        ';
                // echo $num_rows_block;
                if ($num_rows_block == 0)
                {
                    echo  '<strong>Error </strong>Login or password incorrect!';
                }
                if ($num_rows_block == 1)
                {
                    echo '<strong>Error </strong>Account BLOCK!';
                }

                echo '
                              
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            </br>
                        
                            <div class="form-group">
                                <input class="form-control" placeholder="Login" name="login" type="text">
                            </div>
                            
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                           
                                                      
                        </fieldset>
                        </form>
                        
                          <hr/>
                   
                    </div>
                </div>
            </div>
		<div class="col-md-3"> </div> 
    </div> 
            
   
                        ';

            } else {

                // ==============PANEL ACCESS =========== //

                $systemaccess = $this->pdo->prepare("SELECT access from user WHERE login = '{$_SESSION['login']}' AND pass = '{$_SESSION['password']}'");
                $systemaccess->execute();
                $num_access = $systemaccess->fetchColumn();
                $_SESSION['access'] = $num_access;

                if ($num_access == $this->_user) {

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

                    echo '
       
       <p></p>
        <p class="text-center">komis.info.pl</p>
        <p></p>
        
        <!-- START MENU -->
    <div class="row">
    
        <div class="col-md-4">
            <h2><p class="text-center">KOMIS</p></h2>
            <p></p>
            <p><a class="btn btn-success btn-lg btn-block" href="car/view.php" role="button">Oferty &raquo;</a></p><br>
            
            ';
             if ($_SESSION['flag'] == 0)
             {
                 echo '
            <p><a class="btn btn-success btn-lg btn-block" href="car/options.php" role="button">Parametry &raquo;</a></p>
                ';
             }
             else
             {
                 echo '
            <p><a class="btn btn-warning btn-lg btn-block" href="car/options.php" role="button">Parametry &raquo;</a></p>
                ';
             }

            echo '
            <p><a class="btn btn-success btn-lg btn-block" href="car/info.php" role="button" aria-disabled="true">Analizator &raquo;</a></p>
        </div>
        
    
        <div class="col-md-4">
            <h2><p class="text-center">INFORMACJA</p></h2></br>
            <p class="text-center">LOGIN: <b>'. $_SESSION['login'] .'</b></p>
            <p class="text-center">KONTO WAŻNE DO: <b>'. $_SESSION['waznosc'] .'</b></p>
            <p class="text-center">PRAWA DOSTĘPU: <b>TESTER</b></p>
            <p class="text-center">KONTO: <b>DARMOWE</b></p>
        </div>
            
        <div class="col-md-4">
            <h2><p class="text-center">KONTO</p></h2>
            <p><a class="btn btn-info btn-lg btn-block" href="logout.php" role="button">Wyloguj &raquo;</a></p>
            <br>
            <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button" aria-disabled="true">Ustawienia &raquo;</a></p>
            <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button" aria-disabled="true">Płatności &raquo;</a></p>
        </div>
        
        </div>
        
        
        ';

                    if ($_SESSION['flag'] == 2) {

                        echo '
                
                        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
               Witam w analizatorze ofert samochodowych, jest to twoje pierwsze wejście, aby analizator mógł </br>
               analizować rynek samochodowy nie zbędne są mu dane, które musisz wprowadzić. </br>
               <hr>
               <strong>Proszę kliknij w przycisk PARAMETRY i wprowadz dane.</strong>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div> ';
                    }
                    else
                    {

                    }


          echo'       
       
    </div>

       ';

                } // IF USER

                // ---------- END ACCESS USER


                // START ACCESS MODERATOR
                if ($num_access == $this->_moderator) {
                  
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
                    // odswiezenie statystyk koniec


                    echo '
       
       <p></p>
        <p class="text-center">komis.info.pl</p>
        <p></p>
        
         <!-- START MENU -->
    <div class="row">
    
        <div class="col-md-4">
            <h2><p class="text-center">KOMIS</p></h2>
            <p></p>
            <p><a class="btn btn-success btn-lg btn-block" href="car/view.php" role="button">Oferty &raquo;</a></p><br>
            
            ';
                    if ($_SESSION['flag'] == 0)
                    {
                        echo '
            <p><a class="btn btn-success btn-lg btn-block" href="car/options.php" role="button">Parametry &raquo;</a></p>
                ';
                    }
                    else
                    {
                        echo '
            <p><a class="btn btn-warning btn-lg btn-block" href="car/options.php" role="button">Parametry &raquo;</a></p>
                ';
                    }

                    echo '
            <p><a class="btn btn-success btn-lg btn-block" href="car/info.php" role="button" aria-disabled="true">Analizator &raquo;</a></p>
        </div>
        
    
        <div class="col-md-4">
            <h2><p class="text-center">INFORMACJA</p></h2></br>
            <p class="text-center">LOGIN: <b>'. $_SESSION['login'] .'</b></p>
            <p class="text-center">KONTO WAŻNE DO: <b>'. $_SESSION['waznosc'] .'</b></p>
            <p class="text-center">PRAWA DOSTĘPU: <b>UŻYTKOWNIK</b></p>
            <p class="text-center">KONTO: <b>PŁATNE</b></p>
        </div>
            
        <div class="col-md-4">
            <h2><p class="text-center">KONTO</p></h2>
            <p><a class="btn btn-info btn-lg btn-block" href="logout.php" role="button">Wyloguj &raquo;</a></p>
            <br>
            <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button" aria-disabled="true">Ustawienia &raquo;</a></p>
            <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button" aria-disabled="true">Płatności &raquo;</a></p>
        </div>
        
    </div>
       ';

                } // IF USER

                // ---------- END ACCESS ADMINISTRATOR


                // START ACCESS USER
                if ($num_access == $this->_adminstrator) {
                  
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


                    echo '
       
       <p></p>
        <p class="text-center">komis.info.pl</p>
        <p></p>
        
          <!-- START MENU -->
   <div class="row">
    <div class="col-md-4">
        <h2><p class="text-center">ANALIZATOR</p></h2>
        <p></p>
        <p><a class="btn btn-success btn-lg btn-block" href="admin\view.php" role="button">Widok &raquo;</a></p>
        <br>
        <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button">Ustawienia&raquo;</a></p>
        <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button" aria-disabled="true">Zgłoszenia &raquo;</a></p>

    </div>
    
    <div class="col-md-4">
        <h2><p class="text-center">INFORMACJA</p></h2></br>
        <p class="text-center">LOGIN: <b>'. $_SESSION['login'] .'</b></p>
        <p class="text-center">PRAWA DOSTĘPU: <b>ADMINISTRATOR</b></p>
    </div>
        
    <div class="col-md-4">
        <h2><p class="text-center">KONTO</p></h2>
        <p><a class="btn btn-info btn-lg btn-block" href="logout.php" role="button">Wyloguj &raquo;</a></p>
        <br>
        <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button" aria-disabled="true">Statystki &raquo;</a></p>
        <p><a class="btn btn-secondary btn-lg btn-block disabled" href="#" role="button" aria-disabled="true">Faktury &raquo;</a></p>
      </div>
</div>


        <!-- EDN MENU -->
       ';

                } // IF USER

                // ---------- END ACCESS USER

            } // ELSE

        }

        else

        {
            echo '
                           <!-- CODE LOGIN START-->
                           
<form action="index.php" method="POST">
                    </br>
                    
    <div class="row"> 
         <div class="col-md-3"> </div>                
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">komis.info.pl</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form">
                        <fieldset>
                        
                            <div class="form-group">
                                <input class="form-control" placeholder="Login" name="login" type="text">
                            </div>
                            
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                            
                        </fieldset>
                        </form>
                        
                          <hr/>
                   
                    </div>
                </div>
            </div>
		<div class="col-md-3"> </div> 
    </div> 
            

            
              <!-- CODE LOGIN END -->      
                        ';
        }

    } //end function

    public function EndHead()
    {

        echo'
              </div> <!-- /container -->  
              
               <footer class="container">
               <hr/>
                     <p align="right">&copy; analizator - komis.info.pl 2020</p>
               </footer>
               
        <!-- JAVA SCRIPT START  -->
              
               <script>
                 $(document).ready(function() {
            $(\'#table-full\').DataTable( {
                "pagingType": "full_numbers"
                       } );
                          } );
                </script>
        <!-- JAVA SCRIPT END  -->
 
                   
                     
                </body>
                </html>
                
            ';



    }


    public function BackMenu()
    {

        echo '</br>
        
        <div class="row">
        
    <div class="col-md-4">
        <p class="text-center"> LOGIN: <b> '. $_SESSION['login'] .'</b></p> 
       
    </div>
    
    <div class="col-md-4">
        <p class="text-center">komis.info.pl</p>
      
    </div>
    <div class="col-md-4">
        <p class="text-center"></p>
        <p><a class="btn btn-info btn-lg btn-block" href="../index.php" role="button">Back &raquo;</a></p>
    </div>
        </div> 
               </br>
        ';


    }

    public function Error()
    {
        echo'
                <!doctype html>
                <html lang="en">
                    <head>
                        <title>komis.info.pl</title>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                                                
                         <!-- Bootstrap CSS -->
                        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
                        <link rel="stylesheet" type="text/css" href="/css/datatables.css"/>
                          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                        <script type="text/javascript" src="/js/jquery-3.2.1.slim.min.js"></script>
                        <script type="text/javascript" src="/js/popper.min.js"></script>
                        <script type="text/javascript" src="/js/bootstrap.js"></script>
                        <script type="text/javascript" src="/js/datatables.js"></script>
                 
                    </head>
                <body>
    <div class="container">
                
                 </br></br>
         <div class="row">
            
                <div class="col-md-3">
                </div>
                
                <div class="col-md-6">
                    <div class="alert alert-danger text-center" role="alert">
                        <h4 class="alert-heading">ACCESS DENIED!</h4>
                             <p class="text-center">ACCESS DENIED! PLEASE CONTACT TO ADMIN!</p>
                             <p><a class="btn btn-danger btn-lg btn-block" href="../index.php" role="button">BACK TO MENU &raquo;</a></p>
                     </div>
                </div>
                    
                <div class="col-md-3">
                </div>
                
         </div>
    </div>
         
         <footer class="container">
               <hr/>
                     <p align="right">© analizator - komis.info.pl 2020</p>
               </footer>
               </body>
               </html>
               
                ';

    }


}

?>