<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Galerija vijesti</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/galerija.css">

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
          <option value="kategorija2">Uzlazno po kategoriji vijesti</option>
          <option value="kategorija2">Silazno po kategoriji vijesti</option>
          <option value="kategorija2">Uzlazno po broju pregleda</option>
          <option value="kategorija2">Silazno po broju pregleda</option>
        </select>

          <!-- https://www.w3schools.com/howto/howto_js_filter_elements.asp -->
        <div class="tags">
          <button class="tag active">Pokaži sve</button>
          <button class="tag">Tag 1</button>
          <button class="tag">Tag 2</button>
          <button class="tag">Tag 3</button>
          <button class="tag">Tag 4</button>
        </div>
      </div>
      <div class="section__news">
        <div class="news">
          <a href="">
            <figure>
              <img src="../../media/me-jpeg.jpeg" alt="vijest 1">
            </figure>
            <h3>Vijest 1</h3>
            <p>U ovoj vijesti se radi o...</p>
            <span>Dorian Badel</span>
            <p class="broj_pregleda">242</p>
          </a>
        </div>
        <div class="news">
          <a href="">
            <figure>
              <img src="../../media/me-jpeg.jpeg" alt="vijest 1">
            </figure>
            <h3>Vijest 1</h3>
            <p>U ovoj vijesti se radi o...</p>
            <span>Dorian Badel</span>
            <p class="broj_pregleda">242</p>
          </a>
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
