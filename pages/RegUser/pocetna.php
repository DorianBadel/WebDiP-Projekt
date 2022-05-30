<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Radni prostor</title>

  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/linker.css">

  <!--Globals-->
  <script src="../../globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../globals/template.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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
      <h1>Radni prostor</h1>
    </div>

    <div class="section_body">
      <div class="section__links">

         <div class="link">
           <a href="../User/Galerija_vijesti.php">
             <i class='bx bx-grid-alt'></i>
           <span class="title">Pregled Vijesti</span>
         </a>
         </div>
         <div class="link">
           <a href="../User/o_autoru.php">
             <i class='bx bx-user' ></i>
           <span class="title">O autoru</span>
         </a>
         </div>
         <div class="link">
           <a href="../User/dokumentacija.php">
             <i class='bx bxs-file-doc' ></i>
           <span class="title">Dokumentacija</span>
         </a>
         </div>
         <div class="link">
           <a href="../User/Rang_lista.php">
              <i class='bx bx-list-ol' ></i>
              <span class="title">Rang lista</span>
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
