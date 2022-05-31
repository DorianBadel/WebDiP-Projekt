<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Statistika autora</title>

  <link rel="stylesheet" href="../../../index.css">
  <link rel="stylesheet" href="../style/statistics.css">

  <!--Globals-->
  <script src="../../../globals/template.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../../globals/template.css">
  <script src="script/statistics.js" type="text/javascript"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

  <script src="script/auth_stat.js" type="text/javascript"></script>


</head>
<body>

  <header id="header">
    <div class="sidebar">
    <div class="logo-details">
        <a href="../../../index.php">
             <i class='bx bxs-news' id='btn'></i>
        </a>
    </div>
    <ul class="nav-list">
      <li class="profile">
        <div class="profile-details">
          <?php
            session_start();
            if(empty($_SESSION['username'])){
              echo "<a href='../../User/prijava.php'><i class='bx bx-log-in' id='log_out'></i></a>";
            }
            else{
              echo "<a href='../../../globals/logout.php'><i class='bx bx-log-out' id='log_out'></i></a>";
            }
          ?>

        </div>
      </li>

     </ul>
   </div>

  </header>
  <section class='body' id="body">

    <div class="section_header">
      <h1>Statistika autora</h1>
    </div>

    <div class="section_body" id="bod">
      <?php
      shell_exec('php ../../User/script/rang_lista_xml.php');
      ?>
      <table id="java_table">
        <thead>
          <tr>
            <!-- HEADER -->
            <th>Pregledi</th>
            <th>Naslov</th>
            <th>Datum objave</th>
            <th>Verzija vijesti</th>
          </tr> <!-- HEADER -->
        </thead>

        <tbody id="java_tbody">

        </tbody>

      </table>
      <div class="graph">
        <canvas id="canvas" width="400" height="300"></canvas>
      </div>

    </div>

    <noscript>Sorry, your browser does not support JavaScript!</noscript>

  </section>
  <footer id="footer">


  </footer>




</body>
</html>
