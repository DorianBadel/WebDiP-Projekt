<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Galerija vijesti</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/rang_lista.css">

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
    <div class="section_header">
      <h1>Galerija vijesti</h1>
    </div>

    <div class="section_body">
      <div class="section__sort">
        <span>Sortiranje</span>
        <select name="kategorije">
          <option value="kategorija1">Bez sortiranja</option>
          <option value="kategorija2">Uzlazno</option>
          <option value="kategorija2">Silazno</option>
        </select>

          <!-- https://www.w3schools.com/howto/howto_js_filter_elements.asp -->
        <div class="to-from">
          <span>Prikaži samo vijesti u rasponu</span>
          <label for="from">Od: </label>
          <input type="datetime-local">
          <label for="to">Do:</label>
          <input type="datetime-local">
        </div>
      </div>
      <div class="section__news">
        <div class="lista">
          <!-- prema broju pregleda. u razdoblju (od-do) -->
        </div>
    </div>

    <!-- If user has no JS -->
    <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">


  </footer>




</body>
</html>
