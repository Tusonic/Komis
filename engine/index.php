<?php

// do przekonfigurowania
//
//

ob_start();
header('Content-Type: text/html; charset=utf8_polish_ci');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

define('DSN','mysql:host=127.0.0.1;dbname=komis');
define('DB_USERNAME', 'komis');
define('DB_PW', 'komis');

set_include_path(get_include_path(). PATH_SEPARATOR . "CLASS");

try
{
       $options = array
       (
           PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF'",
           PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
       );

       $pdo = new PDO(DSN, DB_USERNAME, DB_PW, $options);
}

catch (PDOException $error)
{
       echo "Connection Error: " . $error->getMessage();
}


//
//
// do przekonfigurowania






error_reporting(E_ALL); //DOM error
include_once('simple_html_dom.php'); //DOM
echo '<br>- Analizator ofert w czasie rzeczywistym - właściciel: PW/TK  - <br><br>';

echo '<br>otomoto, slask, cena: od 0 do 3000, bezwypadkowy <br><br>';

// Create DOM from URL or file
$html = file_get_html('https://www.otomoto.pl/osobowe/slaskie/?search%5Bfilter_float_price%3Ato%5D=3000&search%5Bfilter_enum_no_accident%5D=1&search%5Border%5D=created_at_first%3Adesc&search%5Bbrand_program_id%5D%5B0%5D=&search%5Bcountry%5D=');

// Find all links
foreach($html->find('a[class="offer-title__link"]') as $element)
       echo $element->href . '<br>'; 
	   
//
//
//

	   
echo '<br>olx, zwykle, slask, cena: od 0 do 3000, bezwypadkowy <br><br>';
	   
	   // Create DOM from URL or file
$html2 = file_get_html('https://www.olx.pl/motoryzacja/samochody/slaskie/?search%5Bfilter_float_price%3Ato%5D=3000&search%5Bfilter_enum_condition%5D%5B0%5D=notdamaged&search%5Border%5D=created_at%3Adesc');

// Find all links
foreach($html2->find('a[class="marginright5 link linkWithHash detailsLink"]') as $element)
       echo $element->href . '<br>'; 
	      
//	   
//
//
	   
echo '<br>olx, premium, slask, cena: od 0 do 3000, bezwypadkowy <br><br>';

	   // Create DOM from URL or file
$html3 = file_get_html('https://www.olx.pl/motoryzacja/samochody/slaskie/?search%5Bfilter_float_price%3Ato%5D=3000&search%5Bfilter_enum_condition%5D%5B0%5D=notdamaged&search%5Border%5D=created_at%3Adesc');

// Find all links
foreach($html3->find('a[class="marginright5 link linkWithHash detailsLinkPromoted"]') as $element)
{
      // echo $element->href . '<br>';
       $link = $element->href;
       // echo $element . '<br><br>';


       $query = $pdo->query("SELECT link FROM car WHERE link = '$link' ");
       $row = $query->rowCount();

       if ($row>0) {
              echo" Link - - - ". $link . " </br>";
       }
       else
       {
              $stmt = $pdo->prepare('INSERT INTO car (link) VALUE (:link) ');
              $stmt->bindValue(':link', $element->href, PDO::PARAM_STR);
              $stmt->execute();
              $stmt->closeCursor();
       }

}


?>


