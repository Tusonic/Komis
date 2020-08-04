<?php

class information extends database

{

   

    public function WaitChange()
    {
        echo '
            </br>
            <div class="row">
            
                <div class="col-md-3">
                </div>
                
                <div class="col-md-6">
                    <div class="alert alert-warning text-center" role="alert">
                        <h4 class="alert-heading">Aktualizowanie</h4>
                             <p class="text-center">Aktualizowanie systemu analizowania w toku!</p>
                             <p><a class="btn btn-warning btn-lg btn-block" href="../index.php" role="button">OK &raquo;</a></p>
                     </div>
                </div>
                    
                <div class="col-md-3">
                    
                </div>
            
            </div>
            ';

    }

    public function WaitChange2()
    {
        echo '
    
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
               <strong>Analizator aktualizuje nowo wprowadzone dane! </strong></br>
               <hr>
                Wprowadzone nowe dane są aktualizowane <br>
                codziennie o godzinie: 8:00, 12:00, 16:00 oraz 20:00
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        
        
        ';
    }

    public function StartUserMenu()
    {
        echo '
    
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
               Witam w analizatorze ofert samochodowych, jest to twoje pierwsze wejście, aby analizator mógł </br>
               analizować rynek samochodowy nie zbędne są mu dane, które musisz wprowadzić. </br>
               <hr>
               <strong>Proszę kliknij w przycisk <a class="btn btn-warning btn-sm" href="../car/options.php" role="button">PARAMETRY &raquo;</a> i wprowadz dane.</strong>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        
        
        ';
    }

    public function AnalizatorStartUserMenu()
    {
        echo '
    
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
               Marka - jeżeli chcesz wszystko wpisz wszystko lub wpisz konkretną markę np. fiat </br>
               Model - jeżeli chcesz wszystko wpisz wszystko lub wpisz konkretny model np. 126p </br>
               Cena - podaj przedział lub zostaw puste jeżeli cena nie gra roli </br>
               Rok - podaj przedział lub zostaw puste jeżeli rocznik nie ma znaczenia </br>
               Lokalizacja - podaj nazwę miasta lub kod pocztowy </br>
               Promień - podaj w jakim promieniu od podanego miasta mamy analizować oferty </br>
               <hr>
                Wprowadzone nowe dane są aktualizowane <br>
                codziennie o godzinie: 8:00, 12:00, 16:00 oraz 20:00
               
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        
        
        ';
    }

   

    }


?>