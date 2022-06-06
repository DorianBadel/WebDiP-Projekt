<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Dokumentacija</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/dokumentacija.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <!--Globals-->
  <script src="../../globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../globals/template.css">

</head>
<body>

  <header id="header">
    <div class="sidebar">
    <div class="logo-details">
        <a href="../../index.php">
             <i class='bx bxs-news' id='btn'></i>
        </a>
    </div>
    <ul class="nav-list">
      <li class="profile">
        <div class="profile-details">
          <?php
            session_start();
            if(empty($_SESSION['username'])){
              echo "<a href='prijava.php'><i class='bx bx-log-in' id='log_out'></i></a>";
            }
            else{
              echo "<a href='../../globals/logout.php'><i class='bx bx-log-out' id='log_out'></i></a>";
            }
          ?>

        </div>
      </li>


     </ul>
   </div>


  </header>
  <section class='body' id="body">
    <div id="popup" class="popup">
      <?php
      if(empty($_SESSION['username'])){
        if(!isset($_COOKIE['uvjeti'])){
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'inherit';
          </script>";

          require_once('../../globals/smarty/smarty_main.php');
          include '../../globals/global.php';
          $dataB = new DB();

          $sql_uvjeti = $dataB->query("SELECT * FROM uvjeti_koristenja");

          $opcije = array();
          $i = 0;
          foreach($sql_uvjeti as &$row){
            $opcije[] = $row["opis_uvjeta"];
            $smarty->assign('opcije',$opcije);
            $i++;
          }
          $smarty->display("../../globals/smarty/components/index.tpl");
        } else{
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'none';
          </script>";
        }}else{
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'none';
          </script>";
        }
       ?>

    </div>

    <div class="section_header">
      <h1>Dokumentacija</h1>
    </div>

    <div class="section_body">
      <div class="documentation">
        <div class="docu__a-opis"> <!-- Opis projektnog zadatka -->
          <span>Opis projektnog zadatka: </span>
          <hr>
          <p>
                Projektni zadatka je izraditi stranicu za pisanje i recenziju vijesti prije same objave.
              Za funkcioniranje takvog sustava potrebna su 4 tipa korisnika: čitatelj, autor, recenzent i moderator/admin. <br>
              Čitatelj je neregistrirani korisnik -> svaki korisnik koji dođe na stranicu bez ikakve prijave ima pristup vijestima i nekim informativnim stranicama.<br>
              Autor je registrirani korisnik -> korisnik koji se registrirao i prijavio u sustav, ima opciju pisati vijesti i gledati informacije o svojim objavama.<br>
              Recenzent je korisnik koji odlučuje jeli vijest dovoljno spremna za javnost te kontrolira autore.<br>
              Admin kontrolira cijeli sustav i jedini ima prava na stvari poput otključavanja korisnickih racuna i konfiguriranje sustava.
          </p>
        </div>
        <div class="docu__b-opis"> <!-- Opis projektnog rjesenja -->
          <span>Opis projektnog rješenja: </span>
          <hr>
          <p>
              Moje riješenje pruža jednostavnu uniformnu navigaciju kroz sve uloge koja olakšava korištenje sustava. Svaka poveznica je uređena na oku ugodan i moderan način. Postoje različiti prikazi ovisno o sadržaju, često se koristi prikaz informacija u individualnim kvadratičima umjesto u tradicionalnim tablicama za lakše snalaženje.
            <strong>Neregistrirani korisnik</strong> mora prihvatiti uvjete korištenja koji se spremaju u kolacic na dva dana. Nakon toga ima pristup popisu objavljenih vijesti u obliku galerije. Galerija vijesti ima i html i css za sortiranje no samo sortiranje nije implementirano.
            Dalje može gledati rang listu vijesti koja služi kao više statistički pregled vijesti. Rang lista vijesti također ima vizualni dio sortiranja ali nema implementaciju.
            Dodatno se iz njegovog pogleda mogu pročitati dokumentaciju i informacije o autoru za lakšu navigaciju.
            Da bi autor mogao pristupiti svom radnom prostor mora prvo biti prijavljen u sustav. Registracija ne traži autentifikaciju mailom več se odmah pri pravilnom unosu podataka može i logirati.
            <strong>Registrirani korisnik </strong> kroz navigaciu može doći do početnog sučelja gdje može raditi sve što i neregistrirani korisnik ili do svog radnog prostora. U svom radnom prostoru može pogledati u kojim kategorijama je blokiran. Može pregledati svoje objave urediti ih ako su u statusu dorada ili napraviti novu.
            Može pregledati povratne informacije od recenzenata te urediti vijesst ako je u statusu dorada. Konačno može analizirati svoju statistiku o broju pregleda pojedine objave kroz tablicu i graf.
            <Strong>Moderator</strong> kroz navigaciju dolazi do uredničkog prostora gdje može pregledati blokirane korisnike, ažurirati i ukloniti im blokadu. U sekciji moje recenzije može pregledati vijesti
              koje treba ispraviti. Recenziranje samih vijesti nije ostvarena u ovoj verziji riješenja. Omogučen mu je i pregled odbijenih vijesti gdje može blokirati osobu koja ju je objavila. Dodatno ima pogled na broj odbijenih u odnosu na broj prihvačenih vijesti pojedinog registriranog korisnika.
            Konačno <strong> Administrator </strong> u administratorskom prostoru se nalazi par izbljeđenih gumbova koji inače preusmjeravaju na dijelove aplikacije koje nisu izvršene u ovoj verziji. Ono na što administrator može kliknuti su kategorije koje može, dodavati, pretraživati, uređivati, brisati te im dodjeliti moderatore.
            Može pristupiti zaključanim korisnicima (korisnici koji su neuspješno unjeli lozinku više puta) te ih može otključati. Može ispisati sve korisnike prijavljene u sustav te im vidjeti lozinku ulogu i korisnicko ime. Zadnja ostvarena funkcionalnost je pregled vijesti u statusu recenzije. Dodavanje recenzenata bije moguče.

         </p>
        </div>
        <div class="docu__c-ERA"> <!-- "Bitne odrednice projektnog rješenja" ERA -->
          <span>ERA dijagram:  </span>
          <hr>
          <p>Ispod se nalazi era dijagram. Datagrid mi nažalost nije dozvolio brisanje tablice sesija te ona nebi trebala postojati</p>
          <img src="../../media/era-dijagram.jpg" alt="ERA dijagram">
        </div>
        <div class="docu__d-skripte"> <!-- "popis i opis skripata, mapa mjesta, navigacijski dijagram" -->
          <span>Popis i opis skripata, mapa mjesta, navigacijski dijagram </span>
          <hr>
          <p>Navigacijski dijagrami. Odvojene su slike za svakog tipa korisnika. Crveno su oznacene promijene u odnosu na nižu ulogu.</p>
          <p>Neregistrirani korisnik</p>
          <img src="../../media/navigacijski-dijagram-1" alt="Navigacijski dijagram">
          <p>Autor</p>
          <img src="../../media/navigacijski-dijagram-2" alt="Navigacijski dijagram">
          <p>Recenzent</p>
          <img src="../../media/navigacijski-dijagram-3" alt="Navigacijski dijagram">
          <p>Administrator</p>
          <img src="../../media/navigacijski-dijagram-4" alt="Navigacijski dijagram">
        </div>
        <div class="docu__e-tehnologije"> <!-- "popis i opis korištenih tehnologija i alata" -->
          <span>Popis i opis korištenih tehnologija i alata</span>
          <hr>
          <p>Ovo je opis</p>
          <img src="" alt="ERA dijagram">
        </div>
        <div class="docu__f-tehnologije"> <!-- "popis i opis vanjskih (tuđih) modula/biblioteka i njihovo korištenje u skriptama i sl." -->
          <span>Popis i opis vanjskih (tuđih) modula/biblioteka i njihovo korištenje u skriptama i sl.</span>
          <hr>
          <ul class="element">
            <li> Korištenja online resursa za ikone > Boxiocon
              <ul>
                <li> Izvor: <a target="_blank" rel="noopener noreferrer" href="https://boxicons.com/"> poveznica </a></li>
                <li> Opis: Korišten je za sve ikone u aplikaciji. </li>
              </ul>
            </li>
          </ul><br>

          <ul class="element">
            <li> Korištenje tuđeg pristupa riješenju navigacije > Codinglabweb
              <ul>
                <li> Izvor: <a target="_blank" rel="noopener noreferrer" href="https://www.codinglabweb.com/2021/04/responsive-side-navigation-bar-in-html.html"> poveznica </a> </li>
                <li> Opis: Korišten je vizualni dio rješenja a za samo dinamično učitavanje i preusmjeravanje korišten je vlastiti kod. </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- If user has no JS -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">


  </footer>




</body>
</html>
