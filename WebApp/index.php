
<?php require('components/head.inc.php'); ?>

<?php
//odświeżenie strony co 7sek.
 header("Refresh:7");  ?>


    <h1 class="text-center"><strong> Jakość powietrza w pomieszczeniu</strong></h1>


    <?php

//pobranie danych z serwera www

$file = file_get_contents('file:///C:/xampp/htdocs/bsphp/temp.html');

$a = explode(',',$file);

$tvoc =  $a['0'];
$co2 = $a['1'];
$temperatura =  $a['2'];
$wilgotnosc = $a['3'];

$intTVOC = intval($tvoc);
$intCO2 = intval($co2);

//jeśli TVOC i CO2 przekroczą normy, wyswietli się alert ostrzegawczy
if($intTVOC>400 || $intCO2 > 800)
{echo '  
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</symbol>
</svg>

  <div class="alert alert-danger d-flex align-items-center" role="alert">
 
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
   <div>
     <strong> UWAGA!   </strong>
    
     Stężenie zanieczyszczeń powietrza w tym pomieszczeniu jest bardzo wysokie!!! Może być niebezpieczne dla Twojego zdrowia! 
     

     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     </div>  ';
}

?>
<!--wyświetlenie pomiarów z czujnika------------------------------------>
    <div class="container-lg my-5">
      
    
      <div class="row g-5">

        <div class="col-md-6"> <h2 class="text-center"> CO2 </h2>
          <div class="row"> .</div>
          <div class="row">. </div>
          <div class="row"> <h3><?php echo $co2 ?> ppm </h3> </div>
          <div class="row">. </div>
          <div class="row"> .</div>
        </div>
            
          <div class="col-md-6"> <h2 class="text-center">TVOC </h2>
            <div class="row">. </div>
            <div class="row">. </div>
            <div class="row"> <h3> <?php echo $tvoc ?> ppb </h3>  </div>
            <div class="row">. </div>
            <div class="row">. </div>
          </div>
        </div>

        
        <div class="row g-5">


          <div class="col-md-6"> <h2 class="text-center">Temperatura</h2>
            <div class="row">. </div>
            <div class="row">. </div>
            <div class="row"> <h3> <?php echo $temperatura ?> °C </h3> </div>
            <div class="row">. </div>
            <div class="row">. </div>
          </div>
          
          <div class="col-md-6"> <h2 class="text-center"> Wilgotność</h2>
            <div class="row">. </div>
            <div class="row">. </div>
            <div class="row"> <h3> <?php echo $wilgotnosc ?> % <h3> </div>
            <div class="row">. </div>
            <div class="row"> . </div>
          </div>
        </div>
      </div>



    </div>
     
<!--------------------------------------------------------------------------------->

  <div class= "container-lg my-5">
    <div class= "row g-5"> </div>
    
  </div>

  
  <h3 class="text-center">Jakość powietrza na zewnątrz</h3>
  <br>
 

  <div class= "container-lg ">
    <div class= "row g-5">

  <!--wprowadzenie adresu strony internetowej z której aplikacja pobiera informacje o jakości powietrza na zewnątrz-->

    <form action="index.php" method="post">
      <p> Adres strony </p>
      <p> <input type="text" name="link"/> 
      <input type="submit" value="Szukaj"/> </p>
      <br />

    
    <!--przyciski z miastami-->
       
       <input type = "submit" name="bialystok" value="Białystok" class="button"/>
       <input type = "submit" name="bielsko" value="Bielsko-Biała" class="button" />
       <input type = "submit" name="bydgoszcz" value="Bydgoszcz" class="button" />
       <input type = "submit" name="czestochowa" value="Czestochowa" class="button" />
       <input type = "submit" name="gdansk" value="Gdańsk" class="button" />
       <input type = "submit" name="gliwice" value="Gliwice" class="button" />
      
       <input type = "submit" name="katowice" value="Katowice" class="button" /> 
       <input type = "submit" name="kielce" value="Kielce"  class="button" />
       
       <input type = "submit" name="krakow" value="Kraków" class="button" /> 
       <input type = "submit" name="lublin" value="Lublin" class="button" /> 
       <input type = "submit" name="olsztyn" value="Olsztyn" class="button" />
       <input type = "submit" name="opole" value="Opole" class="button" />
       <input type = "submit" name="poznan" value="Poznań" class="button" />
       <input type = "submit" name="rzeszow" value="Rzeszów" class="button" />
       <input type = "submit" name="szczecin" value="Szczecin" class="button" />
       <input type = "submit" name="warszawa" value="Warszawa" class="button" />
       <input type = "submit" name="wroclaw" value="Wrocław" class="button" />
       <input type = "submit" name="zakopane" value="Zakopane" class="button" />
       <input type = "submit" name="zabrze" value="Zabrze" class="button" />

    </form>


  <?php

$url = "https://pogoda.onet.pl/smog/olkusz-325505";  


  if(isset($_POST['link']))
  {
    $url = $_POST['link'];
  }

  

  if(isset($_POST['bialystok']))
  {
    $url ="https://pogoda.onet.pl/smog/bialystok-270085";
  }

  if(isset($_POST['bielsko']))
  {
    $url ="https://pogoda.onet.pl/smog/bielsko-biala-270591";
  }

  if(isset($_POST['bydgoszcz']))
  {
    $url ="https://pogoda.onet.pl/smog/bydgoszcz-276560";
  }
  
  if(isset($_POST['czestochowa']))
  {
    $url ="https://pogoda.onet.pl/smog/czestochowa-280687";
  }

  if(isset($_POST['gdansk']))
  {
    $url ="https://pogoda.onet.pl/smog/gdansk-287788";
  }

  if(isset($_POST['gliwice']))
  {
    $url ="https://pogoda.onet.pl/smog/gliwice-288397";
  }

  if(isset($_POST['gorzow']))
  {
    $url ="https://pogoda.onet.pl/smog/gorzow-wielkopolski-289581";
  }

  if(isset($_POST['katowice']))
  {
    $url ="https://pogoda.onet.pl/smog/katowice-299998";
  }

  if(isset($_POST['kielce']))
  {
    $url ="https://pogoda.onet.pl/smog/kielce-300882";
  }

  if(isset($_POST['koszalin']))
  {
    $url ="https://pogoda.onet.pl/smog/koszalin-304806";
  }

  if(isset($_POST['krakow']))
  {
    $url ="https://pogoda.onet.pl/smog/krakow-306020";
  }


  if(isset($_POST['lublin']))
  {
    $url ="https://pogoda.onet.pl/smog/lublin-311624";
  }

  if(isset($_POST['lodz']))
  {
    $url ="https://pogoda.onet.pl/smog/lodz-313660";
  }

  if(isset($_POST['olsztyn']))
  {
    $url ="https://pogoda.onet.pl/smog/olsztyn-325715";
  }

  if(isset($_POST['opole']))
  {
    $url ="https://pogoda.onet.pl/smog/opole-325985";
  }

  if(isset($_POST['poznan']))
  {
    $url ="https://pogoda.onet.pl/smog/poznan-335979";
  }

  if(isset($_POST['rzeszow']))
  {
    $url ="https://pogoda.onet.pl/smog/rzeszow-342624";
  }

  if(isset($_POST['szczecin']))
  {
    $url ="https://pogoda.onet.pl/smog/szczecin-351892";
  }

  if(isset($_POST['warszawa']))
  {
    $url ="https://pogoda.onet.pl/smog/warszawa-357732";
  }

  if(isset($_POST['wroclaw']))
  {
    $url ="https://pogoda.onet.pl/smog/wroclaw-362450";
  }

  if(isset($_POST['zakopane']))
  {
    $url ="https://pogoda.onet.pl/smog/zakopane-365801";
  }

  if(isset($_POST['zabrze']))
  {
    $url ="https://pogoda.onet.pl/smog/zabrze-364610";
  }
  
    
  
//pobranie stanu jakosci powietrza na zewnatrz ze strony internetowej
  require ('simple_html_dom.php');
  $html = file_get_html($url);

 
  $brak = $html->find(" .mapLegend .desc",0)->innertext;
  $dobra = $html->find(" .mapLegend .desc",1)->innertext;
  $umiarkowana = $html->find(" .mapLegend .desc",2)->innertext;
  $zla = $html->find(" .mapLegend .desc",3)->innertext;
  $bzla = $html->find(" .mapLegend .desc",4)->innertext;
 
  //wyswitlenie pobranych danych

  $napis = "Jakość powietrza w tym mieście jest:";
echo '<span style= "color: black; font-size: 20px;"><strong> '.$napis.' </strong></span>' ;

 
  $klasa =  $html->find("#airQuality ",0)->class;

    if($klasa == "airQuality_4"){
      echo '<span style="color: #a00000; font-size: 25px;"><strong>' . $bzla. '</strong></span>';
    }

    if($klasa == "airQuality_3"){
      echo '<span style = "color: red; font-size: 25px;"><strong> ">'.$zla.'</strong></span>' ;
    }

    if($klasa == "airQuality_2"){
      echo '<span style = "color: #ffed00; font-size: 25px;"><strong> '.$umiarkowana.'</strong></span>' ;
    }
      
    if($klasa == "airQuality_1"){
      echo '<span style = "color: lime; font-size: 25px;"><strong> '.$dobra.' </strong></span>' ;
    }
    
   // pobranie wartości PM ze strony internetowej i wyswietlenie ich

  echo $html->find(".currentData span",0)->innertext;

  echo $html->find(".currentData span",1)->innertext;
  echo "  ";
  echo $html->find(".currentData span",2)->innertext;
  echo "<br>";
  echo $html->find(".currentData span",3)->innertext;

  echo $html->find(".currentData span",4)->innertext;
  echo "  ";
  echo $html->find(".currentData span",5)->innertext;

  
  

  ?>

<!-- wyswietlenie dodatowych informacji o TVOC-->
   </div>
   </div>

  <div class="bg-image" 
     style="background-image: url('https://images.pexels.com/photos/158163/clouds-cloudporn-weather-lookup-158163.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');
            height: 100vh">

<h4 class="text-center"></h4>

  <div class="container lg my-5">
   
    <div class="card-group">
      <div class="card" style="width: 20rem;">
        <img
        src="https://cdn.pixabay.com/photo/2017/08/25/21/46/upset-2681502_960_720.jpg" 
        class="card-img-top" 
        alt="">
        <div class="card-body">
          <h5 class="card-title">Co powoduje zbyt wysoki poziom TVOC oraz CO2?</h5>
            <p class="card-text">Wysokie stężenie lotnych związków organicznych i dwutlenku węgla, powoduje bóle i zawroty głowy, utratę koordynacji i nudności oraz zaburzenia pamięci i koncentracji. Substancje te przyczyniają się, także do zaburzeń w oddychaniu, a w skrajnych przypadkach odnotowano omdlenia. Pacjenci zgłaszali wiele dolegliwości takich jak: podrażnienie błon śluzowych, podrażnienia oczu, nosa oraz gardła (w tym krtani), wysypka, a także nadmierne zmęczenie. Mogą również powodować uszkodzenia wątroby, nerek oraz centralnego układu nerwowego. Niektóre lotne związki organiczne badane są pod względem możliwości wywołania nowotworów.
      </p>
        </div>
      </div>

      <div class="card" style="width: 20rem;">
        <img
        src="https://cdn.pixabay.com/photo/2020/03/08/23/23/coronavirus-4914026_960_720.jpg" 
        class="card-img-top" 
        alt="">
        <div class="card-body">
          <h5 class="card-title">Co robić, gdy poziom szkodliwych związków jest za wysoki?</h5>
            <p class="card-text">Przede wszyskim należy przewietrzyć pomieszczenie. Dobrym sposobem na zapobieganie takiej sytuacji jest oczyszczacz powietrza. Ma on wiele korzyści, m.in. pomoże zniwelować niepożądane zanieczyszczenia i poprawi cyrkulację powietrza. Jest to bardzo ważne, szczególnie dla osób cierpiących na alergie lub astmę.  Dzięki takiemu urządzeniu, z powietrza zostają odfiltrowane pyłki, kurz, wirusy i bakterie, a dodatkowo zapachy z pomieszczenia. Pozwala to na poprawę jakości powietrza i wyeliminowanie zarodników pleśni, a zatem na lepszą ochronę zdrowia. Należy również systematycznie wietrzyć pomieszczenia, najczęściej te, w których przebywa większa liczba osób przez dłuższy czas, a także unikać lub ograniczać użycie produktów na bazie aerozoli, które zawierają LZO. Oczyszczacze powietrza gwarantują długoterminowe korzyści, zapobiegając infekcjom, które przenoszone są drogą kropelkową oraz zmniejszając liczbę chorób układu oddechowego.
      </p>
        </div>
      </div>

      <div class="card" style="width: 20rem;">
        <img
        src="https://cdn.pixabay.com/photo/2019/10/25/18/01/paintbrush-4577578_960_720.jpg" 
        class="card-img-top" 
        alt="">
        <div class="card-body">
          <h5 class="card-title">Co może być źródłem zanieczyszczeń powietrza w twoim pomieszczeniu?</h5>
            <p class="card-text"> 
            <ul class="list-unstyled">
              <ul> 
                <li> farby, lakiery, kleje, meble, tapety i draperie, 
                <li> materiały z których zbudowany i ozdobiony jest budynek (tynk), 
                <li> materiały budowlane, materiały gipsowe, 
                <li> produkty impregnujące i wypełniające,
                <li> produkty czyszczące i nabłyszczające, 
                <li> odświeżacze powietrza, spraye,
                <li> środki owadobójcze,
                <li> urządzenia do palenia: kuchenki, kotły, otwarte kominki i przenośne grzejniki gazowe/parafinowe (bez komina),
                <li> pokrycia ochronne, linoleum, dywany,
                <li> urządzenia elektryczne, w tym televizory, skanery i kserokopiarki, tusze do drukarek,
                <li> spaliny samochodu (w przypadku domów z wbudowanymi garażami), 
                <li> produkty na bazie nafty.
  </ul>

              <p>
        </div>
      </div>

    </div>
  </div>
  </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>

        <script src="js/bootstrap.js"></script>

        <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>