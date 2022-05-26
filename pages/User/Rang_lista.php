<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Rang lista vijesti</title>


  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="style/rang_lista.css">

  <!--Globals-->
  <script src="../../globals/template.js" type="text/javascript"></script>

  <link rel="stylesheet" href="../../globals/template.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>

  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
  <script src="script/ranglista.js" ></script>

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
        if(!isset($_COOKIE['uvjeti'])){
          echo "
          <script>
            var pu = document.getElementById('popup');
            pu.style.display = 'inherit';
          </script>";

          require_once('../../globals/smarty/smarty_main.php');
          include '../../globals/global.php';

          $sql = "SELECT * FROM uvjeti_koristenja";
          $izvrsi = mysqli_query($connection, $sql);
          $opcije = array();
          $i = 0;
          while($row = $izvrsi->fetch_array()){
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

          shell_exec('php script/rang_lista_xml.php');
        }
       ?>

    </div>


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
            <table id="java_table">
              <thead>
                <tr>
                  <!-- HEADER -->
                  <th>Pregledi</th>
                  <th>Naslov</th>
                  <th>Autori</th>
                  <th>Izvori</th>
                  <th>Datum objave</th>
                  <th>Verzija vijesti</th>
                </tr> <!-- HEADER -->
              </thead>

              <tbody id="java_tbody">

              </tbody>

              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>

            </table>
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
